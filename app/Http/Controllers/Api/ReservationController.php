<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // $cars = Reservation::all();
        $reservations = Reservation::with('user', 'car')->get();
        return response()->json($reservations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    // 'date_start' => $request->date_start,
    //  'date_end' => $request->date_end,
    //  'date_reservation' => $request->date_reservation,
    //  'status' => $status,
    //  'total' => $request->total,
    //   'user_id' => $request->user_id,
    //    'car_id' => $request->car_id,
    //    'note' => $request->note
    public function store(Request $request)
    {
        $request->validate([
            "date_start" => 'required|date',
            "date_end" => 'required|date',
            "user_id" => 'required',
            "car_id" => 'required',
        ]);
        $reservationData = [
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'date_reservation' => $request->date_reservation,
            'status' => 1,
            'total' => $request->total,
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'note' => $request->note,
        ];
        if ($request->has('status')) {
            $reservationData['status'] = $request->status;
        }
        $reservation = Reservation::create($reservationData);
        return response()->json([
            "status" => "reservation created successfully!",
            "reservation" => $reservation
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $reservation = Reservation::FindOrFail($id);
        return response()->json($reservation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // 'user_id',
        // 'car_id',
        // 'date_start',
        // 'date_end',
        // 'date_reservation',
        // 'status',
        // 'total',
        // 'note'
        $reservation = Reservation::FindOrFail($id);
        $status = isset($request->status) ? $request->status : $reservation->status;
        $reservation->update(['date_start' => $request->date_start, 'date_end' => $request->date_end, 'date_reservation' => $request->date_reservation, 'status' => $status, 'user_id' => $request->user_id, 'car_id' => $request->car_id, 'note' => $request->note]);
        return response()->json([
            "status" => "Reservation updated successfully!",
            "Updated_Reservation" => $reservation
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $reservation = Reservation::FindOrFail($id);
        $reservation->delete();
        return response()->json([
            "status" => "Working Fine",
            "message" => "reservation having the id : $reservation->id was deleted successfully!",
        ]);
    }

}
