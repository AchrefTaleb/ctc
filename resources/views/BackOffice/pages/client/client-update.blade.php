@extends('BackOffice.layouts.layout')

@section('content')

    <div class="row col-md-12 layout-top-spacing layout-spacing">
        @if(!$client->contract)
        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Activer le contract de: {{ $client->name.' '.$client->last_name }}</h4>
                        </div>
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <form method="POST" action="" novalidate>
                            @csrf
                            <input type="hidden" name="id" value="{{ $client->id }}">
                            <input type="hidden" name="type" value="contract">
                            <div class="form-group mb-3">
                               <button type="submit" class="btn btn-info"> Lancer l'activation de contrat</button>
                            </div>

                            <a class="btn btn-dark mt-3 mr-2 float-right " href="{{ route('backoffice.client.list') }}">Fermer</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Client - Modifier: {{ $client->name.' '.$client->last_name }}</h4>
                        </div>
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <form method="POST" action="{{ route('backoffice.client.update') }}" novalidate>
                            @csrf
                            <input type="hidden" name="id" value="{{ $client->id }}">
                            <div class="form-group mb-3">
                                <input type="text" value="{{ $client->code ?? '' }}" class="form-control  @error('code') is-invalid @enderror " name="code" placeholder="code" required>

                                @error('code')

                                <small id="" class="form-text  text-danger"> {{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" value="{{ $client->name }}" class="form-control  @error('name') is-invalid @enderror " name="name" placeholder="prenom" required>

                                @error('name')

                                    <small id="" class="form-text  text-danger"> {{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" value="{{ $client->last_name }}" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="nom">
                                @error('last_name')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <input type="email" value="{{ $client->email }}" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="email">
                                @error('email')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" value="{{ $client->phone ?? "" }}" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="téléphone">
                                @error('phone')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <textarea class="form-control @error('adresse') is-invalid @enderror" name="adresse" placeholder="Adresse">{{ $client->adresse ?? "" }}</textarea>                               </textarea>
                                @error('adresse')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 float-right ">Valider</button>
                            <a class="btn btn-dark mt-3 mr-2 float-right " href="{{ route('backoffice.client.list') }}">Fermer</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
