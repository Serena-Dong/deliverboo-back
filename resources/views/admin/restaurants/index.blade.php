@extends('layouts.app')

@section('content')
<section>
    <div class="text-center mt-5 @if(count($restaurants) == 1) d-none @endif">
        <a href="{{ route('admin.restaurants.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-2"></i> Aggiungi il tuo ristorante
        </a>
    </div>

    <div class="text-center mt-5">
        <h1 class="bg-white p-2 px-5 rounded d-inline">Il tuo ristorante</h1>
    </div>
    <div class="row p-5 d-flex flex-wrap justify-content-center">
        @foreach ($restaurants as $restaurant)
        <div class="col-6 h-100" style="height: 350px; min-width:350px">
            <a href="{{ route('admin.restaurants.show', $restaurant['id']) }}" style="text-decoration: none; color:black;">
                <div class="card p-4 rounded-3">
                    <div class="info text-center py-3">
                        <h1>{{$restaurant->name}}</h1>
                    </div>
                    <figure class="mx-auto">
                        <img src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{$restaurant->name}}" class="img-fluid rounded-1">
                    </figure>
                </div>
            </a>
            <div class="mt-3 d-flex justify-content-center align-items-center gap-3">
                <a href="{{ route('admin.restaurants.show', $restaurant->id) }}" class="btn btn-primary text-white"><i class="fa-solid fa-eye"></i> Visualizza</a>
                <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-warning text-white"><i class="fa-solid fa-pen"></i> Modifica</a>

            </div>
        </div>
        @endforeach

    </div>

    <div class="payment-test">
        <div id="dropin-wrapper">
            <div id="checkout-message"></div>
            <div id="dropin-container"></div>
            <button id="submit-button">Submit payment</button>
          </div>
    </div>
    
</section>
@endsection
@section('scripts')
<script>
    var button = document.querySelector('#submit-button');
  
    braintree.dropin.create({
      // Insert your tokenization key here
      authorization: 'sandbox_tv7bvk38_fzbw7r3fc9t6rn2y',
      container: '#dropin-container'
    }, function (createErr, instance) {
      button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
          // When the user clicks on the 'Submit payment' button this code will send the
          // encrypted payment information in a variable called a payment method nonce
          $.ajax({
            type: 'POST',
            url: '/checkout',
            data: {'paymentMethodNonce': payload.nonce}
          }).done(function(result) {
            // Tear down the Drop-in UI
            instance.teardown(function (teardownErr) {
              if (teardownErr) {
                console.error('Could not tear down Drop-in UI!');
              } else {
                console.info('Drop-in UI has been torn down!');
                // Remove the 'Submit payment' button
                $('#submit-button').remove();
              }
            });
  
            if (result.success) {
              $('#checkout-message').html('<h1>Success</h1><p>Your Drop-in UI is working! Check your <a href="https://sandbox.braintreegateway.com/login">sandbox Control Panel</a> for your test transactions.</p><p>Refresh to try another transaction.</p>');
            } else {
              console.log(result);
              $('#checkout-message').html('<h1>Error</h1><p>Check your console.</p>');
            }
          });
        });
      });
    });
  </script>
@endsection

