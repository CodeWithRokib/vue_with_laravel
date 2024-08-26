<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
            'date' => 'required|string',
            'time' => 'required|string',
            'people' => 'required|integer|min=1',
            'message' => 'nullable|string',
            'status' => 'in:pending,accepted,rejected',
        ]);

        $reservation = Reservation::create($request->all());

        return response()->json(['message' => 'Reservation created successfully!', 'reservation' => $reservation], 201);
    }

    // Get all reservations
    public function index()
    {
        $reservations = Reservation::all();
        return response()->json($reservations);
    }

    // Get a single reservation by ID
    public function show($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }

        return response()->json($reservation);
    }

    // Update a reservation by ID
    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }

        $reservation->update($request->all());

        return response()->json(['message' => 'Reservation updated successfully', 'reservation' => $reservation]);
    }

    // Delete a reservation by ID
    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }

        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted successfully']);
    }
}