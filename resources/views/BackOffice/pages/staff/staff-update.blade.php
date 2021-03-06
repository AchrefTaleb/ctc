@extends('BackOffice.layouts.layout')

@section('content')

    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Staff- Modifier: {{ $staff->name.' '.$staff->last_name }}</h4>
                        </div>
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <form method="POST" action="{{ route('backoffice.staff.update') }}" novalidate>
                            @csrf
                            <input type="hidden" name="id" value="{{ $staff->id }}">
                            <div class="form-group mb-3">
                                <input type="text" value="{{ $staff->name }}" class="form-control  @error('name') is-invalid @enderror " name="name" placeholder="Prénom" required>

                                @error('name')

                                    <small id="" class="form-text  text-danger"> {{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" value="{{ $staff->last_name }}" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="Nom">
                                @error('last_name')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <input type="email" value="{{ $staff->email }}" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
                                @error('email')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" value="{{ $staff->phone ?? "" }}" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Téléphone">
                                @error('phone')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 float-right ">Valider</button>
                            <a class="btn btn-dark mt-3 mr-2 float-right " href="{{ route('backoffice.staff.list') }}">Fermer</a>                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


