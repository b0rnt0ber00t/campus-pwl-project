@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Options</h1>
  </div>

  @include('layouts.alert')

  <div class="card">
    <div class="card-body">

      <form action="{{ route('option.update', $price->id) }}" method="post" class="mb-3">
        @csrf
        @method('PUT')

        <input type="hidden" name="name" value="price">

        <div class="mb-3">
          <label for="price" class="form-label">Time Count</label>
          <input type="numeric" class="form-control" id="price" name="value" value="{{ $price->value }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>

      </form>

      <form action="{{ route('option.update', $timer_count->id) }}" method="post">
        @csrf
        @method('PUT')

        <input type="hidden" name="name" value="timer_count">

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Time Count</label>
          <select class="custom-select" name="value">
            <option @selected($timer_count->value == 'second') value="second">second</option>
            <option @selected($timer_count->value == 'minute') value="minute">minute</option>
            <option @selected($timer_count->value == 'hour') value="hour">hour</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>

      </form>

    </div>
  </div>
</section>
@endsection