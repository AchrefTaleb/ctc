@extends('layouts.auth')

@section('content')
    <body class="form">
    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap" style="max-width:inherit">
                <div class="form-container">
                    <div class="form-content">

                        <h3 class="">{{ __("Vérifer votre email") }} <a><span class="brand-name"></span></a></h3>
                        <form method="POST" class="text-left" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-12 col-form-label text-md-right">{{ __('adresse email') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
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


