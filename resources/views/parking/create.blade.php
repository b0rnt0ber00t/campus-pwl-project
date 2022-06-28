@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Parking Create</h1>
  </div>

  <div class="card">
    <div class="card-body">

      <form action="{{ route('floor.parking.store', $floor->id) }}" method="post">
        @csrf

        <div class="mb-3">
          <label for="number" class="form-label">Number</label>
          <input type="number" class="form-control" id="number" placeholder="1000" name="number">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
      </form>

    </div>
  </div>
</section>
@endsection