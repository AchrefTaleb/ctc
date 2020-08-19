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
                        <div class="pricing__price"><span class="pricing__currency">€</span>{{ $plan->price }}<span class="pricing__period">/ mois</span></div>
                        <ul class="pricing__feature-list text-center">
                            <li class="pricing__feature"><svg> ... </svg> {{ $plan->note }}</li>

                        </ul>
                        <form method="post" action="{{ route('frontoffice.subscription.checkout') }}">
                            @csrf
                            <input type="hidden" name="plan" value="{{ $plan->id }}">
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
@endsection