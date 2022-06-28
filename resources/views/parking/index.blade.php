@extends('layouts.app')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>Parking</h1>
  </div>

  @include('layouts.alert')

  <a href="{{ route('parking-floor.create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus mr-1"></i>
    Add Floor
  </a>

  @foreach ($parking_floors as $parking_floor)
  <div class="card">
    <div class="card-header">
      <span>Floor {{ $parking_floor->floor }}</span>
      <a href="#" class="btn btn-sm rounded btn-danger ml-2" onclick="event.preventDefault(); document.getElementById('form-delete-floor-{{ $parking_floor->id }}').submit()">
        Delete</a>
      <form action="{{ route('parking-floor.destroy', $parking_floor->id) }}" method="post" id="form-delete-floor-{{ $parking_floor->id }}">
        @csrf
        @method('DELETE')
      </form>
    </div>
    <div class="card-body">
      <a href="{{ route('floor.parking.create', $parking_floor->id) }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus mr-1"></i>
        Add Park
      </a>
      <div class="row">
        @foreach ($parking_floor->parking as $parking)
        @if ($parking->is_available)
        <div class="col-lg-2">
          <div class="card shadow">
            <div class="card-header">
              Parking {{ $parking->number }}
              <span class="ml-3 badge bg-success text-white">Available</span>
            </div>
            <div class="card-body">
              <a href="{{ route('floor.parking.edit', [$parking_floor->id, $parking->id]) }}" class="btn btn-warning">Edit</a>
              <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('form-delete-{{ $parking->id }}').submit()">
                Delete</a>
              <br>
              <a class="mt-3 btn btn-icon icon-left btn-primary" href="#" onclick="event.preventDefault(); document.getElementById('form-create-invoice-{{ $parking->id }}').submit()">
                New Invoice</a>

              <form action="{{ route('floor.parking.destroy', [$parking_floor->id, $parking->id]) }}" method="post" id="form-delete-{{ $parking->id }}">
                @csrf
                @method('DELETE')
              </form>
              <form action="{{ route('parking.invoice.store', $parking->id) }}" method="post" id="form-create-invoice-{{ $parking->id }}">
                @csrf
              </form>
            </div>
          </div>
        </div>
        @else
        <div class="col-lg-2">
          <div class="card shadow">
            <div class="card-header">
              Parking {{ $parking->number }}
              <span class="ml-3 badge bg-danger text-white">Not Available</span>
            </div>
            <div class="card-body">
              <a href="{{ route('floor.parking.edit', [$parking_floor->id, $parking->id]) }}" class="btn btn-warning">Edit</a>
              <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('form-delete-{{ $parking->id }}').submit()">
                Delete</a>
              <br>
              <a class="mt-3 btn btn-icon icon-left btn-primary" href="{{ route('invoice.index', ['code' => $parking->invoice[0]->code]) }}">
                Pay</a>

              <form action="{{ route('floor.parking.destroy', [$parking_floor->id, $parking->id]) }}" method="post" id="form-delete-{{ $parking->id }}">
                @csrf
                @method('DELETE')
              </form>
            </div>
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
  @endforeach

  </div>
</section>
@endsection