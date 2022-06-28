@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Parking Edit</h1>
  </div>

  <div class="card">
    <div class="card-body">

      <form action="{{ route('floor.parking.update', [$floor->id, $parking->id]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="number" class="form-label">Number</label>
          <input type="number" class="form-control" id="number" placeholder="1000" name="number" value="{{ $parking->number }}">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
      </form>

    </div>
  </div>
</section>
@endsection