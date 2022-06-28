@extends('layouts.app')

@section('content')
<!-- Main Content -->
<section class="section">
  <div class="section-header">
    <h1>Pay Invoice</h1>
  </div>
  <div class="section-body">
    <div class="card">
      <div class="card-body h5">
        <table>
          <tr>
            <td>code</td>
            <td>:</td>
            <td>{{ $invoice->code }}</td>
          </tr>
          <tr>
            <td>start</td>
            <td>:</td>
            <td>{{ date("Y-m-d H:i:s", $invoice->start) }}</td>
          </tr>
          <tr>
            <td>finish</td>
            <td>:</td>
            <td>{{ date("Y-m-d H:i:s") }}</td>
          </tr>
          <tr>
            <td>Total</td>
            <td>:</td>
            <td>Rp. {{ number_format($total, 0, '', ',') }}</td>
          </tr>
        </table>

        <button type="button" id="pay-button" class="btn btn-primary mt-3">Pay!</button>
      </div>
    </div>
  </div>
</section>
@endsection
@push('customScript')
<script type="text/javascript">
  $(document).ready(() => {
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay("{{ $token }}", {
        onSuccess: function(result) {
          /* You may add your own implementation here */
          // alert("payment success!");
          fetch("{{ route('parking.parking', $invoice->parking->id) }}")
        },
        onPending: function(result) {
          /* You may add your own implementation here */
          // alert("wating your payment!");
          fetch("{{ route('parking.parking', $invoice->parking->id) }}")
        },
        onError: function(result) {
          /* You may add your own implementation here */
          // alert("payment failed!");
          fetch("{{ route('parking.parking', $invoice->parking->id) }}")
        },
        onClose: function() {
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
    });
  })
</script>
@endpush

@push('customStyle')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
@endpush