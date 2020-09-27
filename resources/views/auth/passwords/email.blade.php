@extends('layouts.auth')

@section('content')
    <body class="form">
    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap" style="max-width:inherit">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">{{ __("Vérifer") }} <a><span class="brand-name">votre email</span></a></h1>
                        <form method="POST" class="text-left" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Adresse e-mail" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-warning">
                                        {{ __("Evoyer l'e-mail de récupération") }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>
    </body>
@endsection


