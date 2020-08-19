@extends('FrontOffice.layouts.layout')

@section('content')
    <div class="row sales col-md-12">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

            <div class="widget widget-account-invoice-one">

                <div class="widget-heading">
                    <h5 class=""></h5>
                </div>

                <div class="widget-content">
                    <div class="invoice-box">

                        <div class="acc-total-info">
                            <h5>{{ $subscription->plan->name }}</h5>
                            <p class="text-center">{{ $subscription->plan->description }}</p>
                            <p class="text-center"><span class="small ">{{ $subscription->plan->note }}</span></p>
                        </div>

                        <div class="inv-detail">
                            <div class="info-detail-1">
                                <p>Plan mensuel</p>
                                <p>{{ $subscription->plan->price }} €</p>
                            </div>

                        </div>


                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

            <div class="widget widget-account-invoice-one">

                <div class="widget-heading">
                    <h5 class=""></h5>
                </div>

                <div class="widget-content">
                    <div class="invoice-box">

                        <div class="acc-total-info">
                            <h5>Liste des facture</h5>

                        </div>

                        <table class="multi-table table table-striped style-3 table-bordered table-hover non-hover">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Date</th>
                                <th>PDF</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ new \Carbon\Carbon($invoice->created) }}</td>
                                <td><a href="{{ $invoice->invoice_pdf }}">Télécharger pdf</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>

            </div>
        </div>


    </div>

@endsection
