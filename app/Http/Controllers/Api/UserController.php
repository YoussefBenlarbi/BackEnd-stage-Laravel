<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // $user = User::FindOrFail($id);
        // $user = User::with('userDetails')->find($id);
        $user = User::with('detail')->find($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $user = User::FindOrFail($id);
        // return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    // public function update(Request $request, $id)
    // {
    //     $user = User::FindOrFail($id);
    //     $user->update(['name' => $request->name, 'email' => $request->email, 'password' => $request->password]);
    //     return response()->json([
    //         "status" => "user updated successfully!",
    //         "updated user" => $user
    //     ]);
    // }
    public function update(Request $request, $id)
    {
        $user = User::FindOrFail($id);
        $userDetails = UserDetail::FindOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $userDetails->update([
            'cin' => $request->cin,
            'address' => $request->address,
            'sexe' => $request->sexe
        ]);
        return response()->json([
            "status" => "user updated successfully!",
            "updated user" => $user,
            "updated details" => $userDetails
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function desactivate(Request $request, $id)
    {
        $user = User::FindOrFail($id);
        $user->update([
            'is_active' => 0,
        ]);
        return response()->json([
            "status" => "user desactivated successfully!",
            "updated user" => $user
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(Request $request, $id)
    {
        $user = User::FindOrFail($id);
        $user->update([
            'is_active' => 1,
        ]);
        return response()->json([
            "status" => "user Activated successfully!",
            "updated user" => $user
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
        $user = User::FindOrFail($id);

        $user->delete();
        return response()->json([
            "status" => "OK Deleted",
            "mesage" => "Can i have a Hoooyeaah"
        ]);
    }
}
