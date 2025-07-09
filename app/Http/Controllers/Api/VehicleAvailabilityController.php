<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use App\Models\Rental;
use App\Models\Vehicle;
use App\Models\VehicleMaintenanceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleAvailabilityController extends Controller
{
        public function available(Request $request){
            $validator = Validator::make($request->all(),[
                'start_date' => 'required|date|after_or_equal:today',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
            if ($validator->fails()) {
                    return response()->json([
                        'message' => 'Datos inválidos',
                        'errors' => $validator->errors()
                    ], 422);
                }
            $start = $request->start_date;
            $end = $request->end_date;
            $rentedVehicleIds = Rental::where(function ($query) use ($start, $end) {
                    $query->whereBetween('rentalDate', [$start, $end])
                        ->orWhereBetween('returnDate', [$start, $end])
                        ->orWhere(function ($q) use ($start, $end) {
                            $q->where('rentalDate', '<=', $start)
                                ->where('returnDate', '>=', $end);
                        });
                })->pluck('VehicleID');

                $availableVehicles = Vehicle::whereNotIn('id', $rentedVehicleIds)->get();

                return response()->json($availableVehicles);
        }
        public function reserve(Request $request, $id)
    {
         $id = (int) $id;
        $validator = Validator::make($request->all(), [
            'CustomerID' => 'required|exists:customers,CustomerID',
            'EmployeeID' => 'required|exists:employees,EmployeeID',
            'BranchID'   => 'required|exists:branches,BranchID',
            'start_date'  => 'required|date|after_or_equal:today',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'dailyRate'   => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Datos inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        $exists = Rental::where('VehicleID', $id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('rentalDate', [$request->start_date, $request->end_date])
                      ->orWhereBetween('returnDate', [$request->start_date, $request->end_date])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('rentalDate', '<=', $request->start_date)
                            ->where('returnDate', '>=', $request->end_date);
                      });
            })->exists();

        if ($exists) {
            return response()->json([
                'message' => 'El vehículo ya está reservado en ese rango de fechas.'
            ], 409);
        }

        $days = (new \DateTime($request->start_date))->diff(new \DateTime($request->end_date))->days + 1;
        $total = $days * $request->dailyRate;
        $rental = Rental::create([
            'VehicleID'       => $id,
            'CustomerID'      => $request->CustomerID,
            'EmployeeID'      => $request->EmployeeID,
            'BranchID'        => $request->BranchID,
            'RentalDate'       => $request->start_date,
            'ReturnDate'       => $request->end_date,
            'dailyRate'        => $request->dailyRate,
            'totalAmountPaid'  => $total,
        ]);

        return response()->json([
            'message' => 'Reserva realizada con éxito',
            'data' => $rental
        ], 201);
    }
    public function recommendedRate(Request $request, $id)
{
    $start = Carbon::parse($request->start_date);
    $end = Carbon::parse($request->end_date);

    $vehicle = Vehicle::findOrFail($id);
    $baseRate = $vehicle->dailyRate;

    // 1. Verificar demanda
    $totalVehicles = Vehicle::count();
    $rentedCount = Rental::where(function ($query) use ($start, $end) {
        $query->whereBetween('RentalDate', [$start, $end])
              ->orWhereBetween('ReturnDate', [$start, $end])
              ->orWhere(function ($q) use ($start, $end) {
                  $q->where('RentalDate', '<=', $start)
                    ->where('ReturnDate', '>=', $end);
              });
    })->distinct('VehicleID')->count();

    $demandRatio = $rentedCount / max(1, $totalVehicles); // Evita división por cero
    if ($demandRatio > 0.8) {
        $baseRate *= 1.15; // Aumenta 15%
    }

    // 2. Antigüedad
    $age = Carbon::now()->year - $vehicle->year;
    if ($age > 3) {
        $baseRate *= 0.90; // Descuento del 10%
    }

    // 3. Kilometraje
    if ($vehicle->mileage > 100000) {
        $baseRate *= 0.95; // Descuento del 5%
    }

    // 4. Mantenimiento pendiente
    $hasUpcomingMaintenance = VehicleMaintenanceLog::where('VehicleID', $id)
        ->whereBetween('nextServiceDueDate', [Carbon::now(), Carbon::now()->addDays(7)])
        ->exists();

    if ($hasUpcomingMaintenance) {
        $baseRate *= 0.93; // Descuento del 7%
    }

    return response()->json([
        'recommended_daily_rate' => round($baseRate, 2),
        'original_rate' => $vehicle->dailyRate,
    ]);
}
public function suggestAlternativeVehicle(Request $request)
{
    $validated = $request->validate([
        'vehicle_type' => 'required|string',
        'features' => 'array',
        'features.*' => 'string',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $start = Carbon::parse($request->start_date);
    $end = Carbon::parse($request->end_date);
    $requestedType = $request->vehicle_type;
    $requestedFeatures = $request->features ?? [];

    // 1. Obtener vehículos ocupados en ese rango de fechas
    $rentedVehicles = Rental::where(function ($query) use ($start, $end) {
        $query->whereBetween('RentalDate', [$start, $end])
              ->orWhereBetween('ReturnDate', [$start, $end])
              ->orWhere(function ($q) use ($start, $end) {
                  $q->where('RentalDate', '<=', $start)
                    ->where('ReturnDate', '>=', $end);
              });
    })->pluck('VehicleID');

    // 2. Definir orden de tipos de vehículos (de menor a mayor categoría)
    $typeHierarchy = ['compact', 'sedan', 'SUV', 'luxury'];

    // Si el tipo no existe, retornar error
    if (!in_array($requestedType, $typeHierarchy)) {
        return response()->json(['message' => 'Tipo de vehiculo no valido.'], 422);
    }

    // 3. Buscar vehículos de categoría igual o superior, disponibles
    $requestedIndex = array_search($requestedType, $typeHierarchy);
    $acceptableTypes = array_slice($typeHierarchy, $requestedIndex); // incluye tipos superiores

    $candidates = Vehicle::whereNotIn('VehicleID', $rentedVehicles)
        ->whereIn('make', $acceptableTypes)
        ->get();

    if ($candidates->isEmpty()) {
        return response()->json(['suggested_vehicle_id' => null, 'message' => 'No hay vehiculos alternativos disponibles.']);
    }

    // 4. Filtrar por características similares
    $filtered = $candidates->filter(function ($vehicle) use ($requestedFeatures) {
        $vehicleFeatures = $vehicle->features()->pluck('FeatureID')->toArray(); // relación con features
        $matchCount = count(array_intersect($vehicleFeatures, $requestedFeatures));
        return $matchCount >= count($requestedFeatures) * 0.6; // al menos 60% de match
    });

    // 5. Elegir el de menor uso en el mes actual
    $finalVehicle = $filtered->sortBy(function ($v) {
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();
        return Rental::where('VehicleID', $v->VehicleID)
            ->whereBetween('RentalDate', [$monthStart, $monthEnd])
            ->count();
    })->first();

    return response()->json([
        'suggested_vehicle_id' => $finalVehicle->VehicleID ?? null,
        'message' => $finalVehicle ? 'Se sugiere un vehiculo alternativo.' : 'No se encontró un vehiculo alternativo adecuado.'
    ]);
}

}
