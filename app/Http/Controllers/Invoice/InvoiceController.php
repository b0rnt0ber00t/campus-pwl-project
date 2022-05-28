<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Option;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:invoice.index')->only('index');
        $this->middleware('permission:invoice.create')->only('create', 'store');
        $this->middleware('permission:invoice.edit')->only('edit', 'update');
        $this->middleware('permission:invoice.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices = Invoice::query()
            ->when(!blank($request->code), function ($queery) use ($request) {
                return $queery->where('code', 'like', '%' . $request->code . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        dd($invoices, Option::all());
        return view('invoice.index', compact('invoices'));
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
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Invoice::create([
            'code'  => str()->uuid()->toString(),
            'start' => microtime(true)
        ]);
        return redirect()->route('invoice.index')->with('success', 'Data Berhasil Ditambahkan');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoice.index')->with('success', $invoice->code . ' Berhasil Dihapus');
    }
}
