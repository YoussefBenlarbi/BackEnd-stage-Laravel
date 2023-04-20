<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $dataChart = Reservation::selectRaw("MONTHNAME(date_reservation) as name,
        SUM(CASE WHEN total > 0 THEN total ELSE 0 END) as Income")
            ->where('status', '=', 2)
            ->groupBy(Reservation::raw('MONTH(date_reservation), MONTHNAME(date_reservation)'))
            ->get()
            ->toArray();
        $maleCount = UserDetail::where('sexe', 'male')->count();
        $femaleCount = UserDetail::where('sexe', 'female')->count();
        $reservations = Reservation::with('user', 'car')->get();
        $arraySexe = [
            ['name' => 'female', 'value' => $femaleCount],
            ['name' => 'male', 'value' => $maleCount]
        ];
        return response()->json([
            "reservations" => $reservations,
            "arraySexe" => $arraySexe,
            'dataChart' => $dataChart
        ]);
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
        try {

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
        } catch (\Exception $e) {
            // Handle the exception here
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
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
