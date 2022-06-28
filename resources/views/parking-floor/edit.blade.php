@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Parking Floor Create</h1>
  </div>

  <div class="card">
    <div class="card-body">

      <form action="{{ route('parking-floor.update', $floor->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="floor" class="form-label">Floor</label>
          <input type="number" class="form-control" id="floor" placeholder="1000" name="floor" value="{{ $floor->floor }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
      </form>

    </div>
  </div>
</section>
@endsection