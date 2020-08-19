@extends('FrontOffice.layouts.layout')
@section('add_head')
<script src="https://js.stripe.com/v3/"></script>
@endsection
@section('content')


    <div class="row sales col-md-12">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">

            <div class="widget widget-account-invoice-one">

                <div class="widget-heading">
                    <h5 class="">Paiement</h5>
                </div>

                <div class="widget-content">
                    <div class="invoice-box">

                        <div class="acc-total-info">
                            <h5>Card information</h5>
                        </div>
                        <form id="payment-form" method="post" action="{{route('frontoffice.subscription.charge')}}">
                            @csrf
                            <input type="hidden" name="plan" value="{{ $plan->id }}">
                        <div class="inv-detail">

                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display Element errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>

                        <div class="inv-action">

                            <button type="submit" class="btn btn-danger">Acheter</button>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">

            <div class="widget widget-account-invoice-one">

                <div class="widget-heading">
                    <h5 class=""></h5>
                </div>

                <div class="widget-content">
                    <div class="invoice-box">

                        <div class="acc-total-info">
                            <h5>{{ $plan->name }}</h5>
                            <p class="text-center">{{ $plan->description }}</p>
                            <p class="text-center"><span class="small ">{{ $plan->note }}</span></p>
                        </div>

                        <div class="inv-detail">
                            <div class="info-detail-1">
                                <p>Plan mensuel</p>
                                <p>{{ $plan->price }} €</p>
                            </div>

                        </div>


                    </div>
                </div>

            </div>
        </div>


    </div>

@endsection

@section('script')
<script>
    var stripe = Stripe('pk_test_51HGpAqEWB4pgk6TU37er7K0ygwEGjbOGnm0BO7iSW7y6yf4cpXMuA7ZKf0P2ASLItYkZcAryOdQfzz97BWmYVhRn009UznytLw');
    var elements = stripe.elements();

    var style = {
        base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            color: '#32325d',
        },
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});
    card.mount('#card-element');

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the customer that there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);

            }
        });
    });


    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>
@endsection
