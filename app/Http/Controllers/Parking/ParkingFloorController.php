<?php

namespace App\Http\Controllers\Parking;

use App\Http\Controllers\Controller;
use App\Http\Requests\ParkingFloorRequest;
use App\Models\Invoice;
use App\Models\Parking;
use App\Models\ParkingFloor;
use Illuminate\Http\Request;

class ParkingFloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parking-floor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParkingFloorRequest $request)
    {
        ParkingFloor::create($request->validated());

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
    public function edit(ParkingFloor $floor)
    {
        return view('parking-floor.edit', compact('floor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParkingFloorRequest $request, ParkingFloor $floor)
    {
        $floor->update($request->validated());

        return to_route('parking.index')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParkingFloor $floor)
    {
        Invoice::whereIn('parking_id', Parking::where('parking_floor_id', $floor->id)->pluck('id'))->delete();
        Parking::where('parking_floor_id', $floor->id)->delete();
        $floor->delete();

        return to_route('parking.index')->with('success', 'Data Berhasil Dihapus');
    }
}
