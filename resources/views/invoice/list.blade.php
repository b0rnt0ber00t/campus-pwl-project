@extends('layouts.app')

@section('content')
<!-- Main Content -->
<section class="section">
  <div class="section-header">
    <h1>Invoice List</h1>
  </div>
  <div class="section-body">

    <div class="card">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Code</th>
            <th scope="col">Start</th>
            <th scope="col">Finish</th>
            <th scope="col">Parking</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($invoices as $invoice)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $invoice->code }}</td>
            <td>{{ date("Y-m-d H:i:s", $invoice->start) }}</td>
            <td>{{ date("Y-m-d H:i:s", $invoice->finish) }}</td>
            <td>
              <span class="badge badge-{{ $invoice->parking->is_available ? 'success' : 'danger' }}">{{ 'Floor ' . $invoice->parking->parking_floor->floor . ' (Parking '. $invoice->parking->number .')' }}</span>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</section>
@endsection
@push('customScript')
@endpush

@push('customStyle')
@endpush