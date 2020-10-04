@extends('FrontOffice.layouts.layout')
@section('add_head')
<script src="https://js.stripe.com/v3/"></script>
@endsection
@section('content')


    <div class="row sales col-md-12">
        <form class="row" id="payment-form" method="post" action="{{route('frontoffice.subscription.charge')}}">
            @csrf
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 layout-spacing">

            <div class="widget widget-account-invoice-one">

                <div class="widget-heading">
                    <h5 class="">Paiement</h5>
                </div>

                <div class="widget-content">
                    <div class="invoice-box">

                        <div class="acc-total-info">
                            <h5>information de la carte</h5>
                        </div>

                            <input type="hidden" name="plan" value="{{ $plan->id }}">
                            <input type="hidden" name="option" value="{{ $option }}">

                            <hr/>
                        <div class="inv-detail">

                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display Element errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <div class="inv-action">


                        </div>
                            <div class="form-group mb-3" style="display: flex;">
                                <input type="checkbox" style="width: 55px;height: calc(1.0em + 0.75rem + 2px);" class="form-control @error('cgvu') is-invalid @enderror " name="cgvu" required>
                                <span class="wpcf7-list-item-label">En cochant cette case vous déclarez avoir pris connaissance et accepté les <a href="https://transfertdecourrier.com/informations/" target="_blank">Conditions Générales de Vente et d'Utilisation</a>.</span>


                                @error('cgvu')

                                <small id="" class="form-text  text-danger"> {{ $message }}</small>

                                @enderror
                            </div>


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
                    <div id="appcheckout" class="invoice-box">

                        <div class="acc-total-info">
                            <h5>{{ $plan->name }}</h5>
                            <p class="text-center">{{ $plan->description }}</p>
                            <p class="text-center"><span class="small ">{{ $plan->note }}</span></p>
                            <hr>
                            <div class="form-group mb-3">
                                <input type="text" v-model="codePromo" @change="getReduction" class="form-control @error('promo') is-invalid @enderror " name="promo" placeholder="code promo..">

                                @error('promo')

                                <small id="" class="form-text  text-danger"> {{ $message }}</small>

                                @enderror
                            </div>
                        </div>

                        <div  class="inv-detail">
                            <div class="info-detail-1">
                                <p>Plan mensuel</p>
                                @if($option == 'm3')
                                    <p>{{ $plan->m3_price }} €</p>
                                @elseif($option == 'm6')
                                    <p>{{ $plan->m6_price }} €</p>
                                @elseif($option == 'm9')
                                    <p>{{ $plan->m9_price }} €</p>
                                @elseif($option == 'm12')
                                    <p>{{ $plan->m12_price }} €</p>
                                @endif

                            </div>
                            <div v-if="reduction" class="info-detail-2">
                                <p>Reduction mensuel</p>
                                <p>@{{ reduction }} %</p>

                            </div>

                        </div>


                    </div>
                </div>

            </div>
        </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-danger" style="width: 90%;margin-left: 5%">Acheter</button>
            </div>

        </form>

    </div>

@endsection

@section('script')
<script>
    var stripe = Stripe('{{env("STRIPE_PUBLIC_KEY","pk_test_zx1MGcQV6DrzQZNOI2nqSGNt00sTteKMoU")}}');
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
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const app = new Vue({
                el: '#appcheckout',
                data: {
                    codePromo:'',
                    reduction:0,
                    price: {{ $plan->m3_price  }},
                },
                created() {

                },
                mounted() {

                },
                methods: {
                    getReduction(){

                        let formData = new  FormData();

                        formData.append('code',this.codePromo);

                        axios.post('{{ route('getreduction') }}',
                            formData,
                            {
                                errorHandle: false,
                                headers:{
                                    'Content-Type': 'multipart/form-data'
                                }
                            }).then( response => {

                            this.reduction = response.data;
                        }).catch(error => {
                            console.log(error.data);
                        });
                    }
                },

                watch: {},

            });
        });
    </script>

@endsection
