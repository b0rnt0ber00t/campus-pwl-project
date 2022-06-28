@extends('layouts.app')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>Parking</h1>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="card-title">Floor #parking_floor.floor</div>
      <div class="row">
        <div class="col-lg-2">
          <div class="card bg-primary">
            <div class="card-header">Parking #parking_floor.parking.number</div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card bg-danger">
            <div class="card-header">Parking #parking_floor.parking.number</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  </div>
</section>
@endsection