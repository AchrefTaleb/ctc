@extends('FrontOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
    <div class="row">
        <div class="col-lg-12">
            <section class="pricing-section bg-7 mt-5">
                <div class="pricing pricing--norbu">
                    @foreach($plans as $plan)
                    <div class="pricing__item">
                        <h3 class="pricing__title">{{ $plan->name }}</h3>
                        <p class="pricing__sentence">{{ $plan->description }}</p>
                        <div class="pricing__price"><span class="pricing__currency">€</span><a class="plan{{ $plan->id }}">{{ $plan->m3_price }}</a><span class="pricing__period">/ mois</span></div>
                        <ul class="pricing__feature-list text-center">
                            <li class="pricing__feature"><svg> ... </svg> {{ $plan->note }}</li>

                        </ul>
                        <form method="post" action="{{ route('frontoffice.subscription.checkout') }}">
                            @csrf
                            <input type="hidden" name="plan" value="{{ $plan->id }}">
                            <div class="n-chk mb-3">
                                <label class="new-control new-radio radio-primary">
                                    <input type="radio" class="new-control-input" value="m3" data-form="plan{{ $plan->id }}" data-val="{{ $plan->m3_price }}" name="option" checked>
                                    <span class="new-control-indicator"></span>3 mois
                                </label>
                                <label class="new-control new-radio radio-primary">
                                    <input type="radio" class="new-control-input" value="m6" data-form="plan{{ $plan->id }}"  data-val="{{ $plan->m6_price }}" name="option" >
                                    <span class="new-control-indicator"></span>6 mois
                                </label>
                                <label class="new-control new-radio radio-primary">
                                    <input type="radio" class="new-control-input" value="m9" data-form="plan{{ $plan->id }}"  data-val="{{ $plan->m9_price }}" name="option">
                                    <span class="new-control-indicator"></span>9 mois
                                </label>
                                <label class="new-control new-radio radio-primary">
                                    <input type="radio" class="new-control-input" value="m12" data-form="plan{{ $plan->id }}"  data-val="{{ $plan->m12_price }}" name="option">
                                    <span class="new-control-indicator"></span>12 mois
                                </label>
                            </div>
                            <button type="submit" class="pricing__action mx-auto mb-4">Je souscris</button>
                        </form>
                    </div>
                    @endforeach

                </div>
            </section>
        </div>
    </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            $('.new-control-input').on('change', function() {
                let price = $(this).data('val');
                let clas = $(this).data('form');
                $('.'+clas).text(price);
            });
        });
    </script>


@endsection
