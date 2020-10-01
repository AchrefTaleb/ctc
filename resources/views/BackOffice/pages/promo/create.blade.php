@extends('BackOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Code promo - Ajout</h4>
                        </div>
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <form method="POST" action="{{ route('backoffice.promo.store') }}" novalidate>
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" class="form-control @error('code') is-invalid @enderror " name="code" placeholder="code promo.." required>

                                @error('code')

                                <small id="" class="form-text  text-danger"> {{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" class="form-control @error('reduction') is-invalid @enderror " name="reduction" placeholder="reduction" required>

                                @error('reduction')

                                <small id="" class="form-text  text-danger"> {{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" class="form-control @error('months') is-invalid @enderror" name="months" placeholder="durée (mois)">
                                @error('months')

                                <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary mt-3 float-right ">Valider</button>
                            <a class="btn btn-dark mt-3 mr-2 float-right " href="{{ route('backoffice.promo.list') }}">Fermer</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

