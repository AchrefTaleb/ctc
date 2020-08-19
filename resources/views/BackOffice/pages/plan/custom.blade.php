
@extends('BackOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Nouveau plan</h4>
                        </div>
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <form method="POST" action="{{ route('backoffice.plan.custom.store') }}" novalidate>
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror " name="name" placeholder="tittre de plan" required>

                                @error('name')

                                <small id="" class="form-text  text-danger"> {{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" class="form-control @error('opening_limit') is-invalid @enderror" name="opening_limit" placeholder="Nombre d'overtures">
                                @error('opening_limit')

                                <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" class="form-control @error('pages') is-invalid @enderror" name="pages" placeholder="pages par mois">
                                @error('pages')

                                <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <input type="number" class="form-control @error('family_name') is-invalid @enderror" name="family_name" placeholder="nombre des noms de famille">
                                @error('family_name')

                                <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="prix">
                                @error('price')

                                <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>

                            <div class="form-group mb-3">
                            <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                                <option disabled selected hidden>Choissiser un type</option>
                                <option value="standard">Standard</option>
                                <option value="professional">Professional</option>
                            </select>
                            @error('type')

                            <small id="" class="form-text  text-danger">{{ $message }}</small>

                        @enderror
                        </div>
                            <div class="form-group mb-3">
                                <select name="user" class="form-control @error('user') is-invalid @enderror">
                                    <option disabled selected hidden >choisissez un utilisateur</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name ?? '' }} {{ $client->last_name ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error('type')

                                <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="description..."></textarea>

                                @error('description')

                                <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <textarea type="text" class="form-control @error('note') is-invalid @enderror" name="note" placeholder="note..."></textarea>

                                @error('description')

                                <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>

                    <button type="submit" class="btn btn-primary mt-3 float-right ">Submit</button>
                    <a class="btn btn-dark mt-3 mr-2 float-right " href="{{ route('backoffice.client.list') }}">Fermer</a>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

