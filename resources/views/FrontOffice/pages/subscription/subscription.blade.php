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

                        <div class="acc-total-info" style="border: none">
                            <h5>{{ $subscription->plan->name }}</h5>
                            <p class="text-center"> vous avez un engagemment de {{ $subscription->commitment }} mois </p>
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
                            <h5>Liste des factures</h5>

                        </div>

                        <table class="multi-table table table-striped style-3 table-bordered table-hover non-hover">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Date Creation</th>
                                <th>Date fin contrat</th>
                                <th>PDF</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->created)->format('Y-m-d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($invoice->created)->addMonths($subscription->commitment)->format('Y-m-d') }}</td>
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
