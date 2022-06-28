<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\Option;
use App\Models\Parking;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function __construct()
    {
        parent::__construct();

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
        $invoice = Invoice::with('parking')->where('code', $request->code)->firstOrFail();
        $time_count = Option::firstWhere('name', 'timer_count')->value;
        $price = Option::firstWhere('name', 'price')->value;
        $total = $invoice->{$time_count}($price);

        // dd($total);
        $params = array(
            'transaction_details' => array(
                'order_id' => $invoice->code,
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => auth()->user()->name,
                'last_name' => '',
                'email' => auth()->user()->email,
            ),
            'item_details' => array(
                [
                    'id' => $invoice->id,
                    'name' => 'Parking ' . $invoice->parking->number,
                    'price' => $total,
                    'quantity' => 1
                ]
            ),
        );

        $token = \Midtrans\Snap::getSnapToken($params);

        return view('invoice.index', compact('invoice', 'token', 'total'));
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
    public function store(Parking $parking)
    {
        $invoice = Invoice::create([
            'code'  => str()->uuid()->toString(),
            'start' => microtime(true),
            'parking_id' => $parking->id
        ]);
        $parking->update(['is_available' => false]);

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
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated());
        return back()->with('success', 'Data Berhasil Diperbarui');
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
        return back()->with('success', $invoice->code . ' Berhasil Dihapus');
    }
}
