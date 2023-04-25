<?php

namespace App\Http\Controllers\API;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cars = Car::all();
        return response()->json($cars);
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
    // public function store(Request $request)
    // {
    //     // 'name',
    //     // 'pricePerDay',
    //     // 'pricePerMonth',
    //     // 'mileage',
    //     // 'gearType',
    //     // 'gasType',
    //     // 'description',
    //     // 'status',
    //     // 'thumbnailUrl'
    //     $request->validate([
    //         "name" => 'required',
    //         "mileage" => 'required',
    //         "description" => 'required|min:8',
    //         "gearType" => 'required',
    //     ]);
    //     $carData = [
    //         'name' => $request->name,
    //         'mileage' => $request->mileage,
    //         'description' => $request->description,
    //         'gearType' => $request->gearType,
    //         'gasType' => $request->gasType,
    //         'status' => 0,
    //         'dailyPrice' => $request->dailyPrice,
    //         'monthlyPrice' => $request->monthlyPrice,
    //     ];
    //     if ($request->has('status')) {
    //         $carData['status'] = $request->status;
    //     }
    //     $car = Car::create($carData);

    //     return response()->json([
    //         "status" => "Car created successfully!",
    //         "car" => $car
    //     ]);
    // }
    public function store(Request $request)
    {
        // Log the request data
        // Log::info('Request data:', $request->all());
        // dd($request);
        $request->validate([
            "name" => 'required',
            "mileage" => 'required',
            "description" => 'required|min:8',
            "gearType" => 'required',
        ]);
        $carData = [
            'name' => $request->name,
            'mileage' => $request->mileage,
            'description' => $request->description,
            'gearType' => $request->gearType,
            'gasType' => $request->gasType,
            'status' => 0,
            'dailyPrice' => $request->dailyPrice,
            'monthlyPrice' => $request->monthlyPrice,
        ];
        if ($request->has('status')) {
            $carData['status'] = $request->status;
        }
        if ($request->hasFile('thumbnailUrl')) {
            // Log that a file with key 'thumbnailUrl' is present in the request
            Log::info('File with key \'thumbnailUrl\' is present in the request');
            $image = $request->file('thumbnailUrl');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('images', $imageName, 'public');
            $carData['thumbnailUrl'] = $imagePath;

            // Log the image path
            // Log::info('Image path:', $imagePath);

            $car = Car::create($carData);
            return response()->json([
                "status" => "Car created successfully!",
                "car" => $car
            ]);
        }

        // Log that no file with key 'thumbnailUrl' is present in the request
        // Log::warning('No file with key \'thumbnailUrl\' is present in the request');

        return response()->json([
            "message" => "it doenst' have a thumbnailUrl",
            "request" => $request->all()
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
        $car = Car::FindOrFail($id);
        return response()->json($car);
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
        // Log::info('Request data:', $request->all());
        $car = Car::FindOrFail($id);
        $status = isset($request->status) ? $request->status : $car->status;
        if ($request->hasFile('thumbnailUrl')) {
            // Log that a file with key 'thumbnailUrl' is present in the request
            Log::info('File with key \'thumbnailUrl\' is present in the request');
            $image = $request->file('thumbnailUrl');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('images', $imageName, 'public');
            $newThumbnailUrl = $imagePath;
        }
        $thumbnailUrl = $request->hasFile('thumbnailUrl') ? $newThumbnailUrl : $car->thumbnailUrl;
        $car->update([
            'name' => $request->name,
            'mileage' => $request->mileage,
            'description' => $request->description,
            'gearType' => $request->gearType,
            'gasType' => $request->gasType,
            'status' => $status,
            'dailyPrice' => $request->dailyPrice,
            'monthlyPrice' => $request->monthlyPrice,
            "thumbnailUrl" => $thumbnailUrl,
        ]);
        return response()->json([
            "status" => "Car updated successfully!",
            "updated Car" => $car
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    function destroy($id)
    {
        $car = Car::FindOrFail($id);
        $car->delete();
        return response()->json([
            "status" => "Working Fine",
            "message" => "Car having the id : $car->id was deleted successfully!",
        ]);
    }
    function carsInfo()
    {
        $cars = Car::all();
        return response()->json($cars);
    }
}
