<?php

namespace App\Http\Controllers\Parking;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParkingRequest;
use App\Models\Parking;
use App\Models\ParkingFloor;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parking_floors = ParkingFloor::with([
            'parking.invoice' => function ($query) {
                return $query->orderBy('id', 'desc');
            }
        ])
            ->orderBy('floor', 'asc')
            ->get();

        // dd($parking_floors);

        return view('parking.index', compact('parking_floors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ParkingFloor $floor)
    {
        return view('parking.create', compact('floor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParkingRequest $request, ParkingFloor $floor)
    {
        Parking::create(array_merge($request->validated(), [
            'is_available' => true,
            'parking_floor_id' => $floor->id
        ]));

        return to_route('parking.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ParkingFloor $floor, Parking $parking)
    {
        return view('parking.edit', compact('floor', 'parking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParkingRequest $request, ParkingFloor $floor, Parking $parking)
    {
        $parking->update($request->validated());

        return to_route('parking.index')->with('success', 'Data Berhasil Diupdate');
    }

    public function parking(Parking $parking)
    {
        $parking->update(['is_available' => true]);

        return response()->json(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParkingFloor $floor, Parking $parking)
    {
        $parking->delete();

        return to_route('parking.index')->with('success', 'Data Berhasil Dihapus');
    }
}
