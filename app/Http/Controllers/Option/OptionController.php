<?php

namespace App\Http\Controllers\Option;

use App\Http\Controllers\Controller;
use App\Http\Requests\Option\StoreOptionRequest;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:option.index')->only('index');
        $this->middleware('permission:option.create')->only('create', 'store');
        $this->middleware('permission:option.edit')->only('edit', 'update');
        $this->middleware('permission:option.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $price = Option::where('name', 'price')->first();
        $timer_count = Option::where('name', 'timer_count')->first();

        return view('option.index', compact('timer_count', 'price'));
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
    public function store(StoreOptionRequest $request)
    {
        Option::create($request->validated());
        return back()->with('success', 'Data Berhasil Ditambahkan');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOptionRequest $request, Option $option)
    {
        // dd($request->validated());
        $option->update($request->validated());
        return back()->with('success', $option->name . ' Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        $option->delete();
        return back()->with('success', $option->name . ' Data Berhasil Dihapus');
    }
}
