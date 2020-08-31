@extends('FrontOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

            <div class="user-profile layout-spacing">
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-between">
                        <h3 class="">Profile</h3>
                        <a href="user_account_setting.html" class="mt-2 edit-profile">
                        </a>
                    </div>
                    <div class="text-center user-info">

                        <p class="">{{ $me->name ?? '' }}  {{ $me->last_name ?? "" }}</p>
                    </div>
                    <div class="user-info-list">

                        <div class="">
                            <ul class="contacts-block list-unstyled">

                                @if($me->adresse)
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>{{ $me->adresse }}
                                </li>
                                @endif
                                <li class="contacts-block__item">
                                    <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>{{ $me->email }}</a>
                                </li>
                                    @if($me->phone)

                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>{{ $me->phone }}
                                </li>
                                    @endif
                                    <li class="contacts-block__item">
                                        <p class="text-warning">Fin de contract: {{ \Carbon\Carbon::parse($ends)->format('d-m-Y') }}</p>
                                    </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="education layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">Mots de passe</h3>
                    <div class="table-responsive mb-1">
                        <form method="post" action="{{ route('frontoffice.password') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="password"  class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="Mot de passe actuel">
                                @error('old_password')

                                <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password"  class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Nouveau mot de passe">
                                @error('password')

                                <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password"  class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirmer votre mot de passe">
                                @error('password_confirmation')

                                <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 float-right ">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>



        </div>

        <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

            <div class="skills layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">Modifier vore profie</h3>
                    <div class="table-responsive mb-1">
                    <form method="POST" action="{{ route('frontoffice.profile.update') }}" novalidate>
                        @csrf
                        <input type="hidden" name="id" value="{{ $me->id }}">
                        <div class="form-group mb-3">
                            <input type="text" value="{{ $me->name }}" class="form-control  @error('name') is-invalid @enderror " name="name" placeholder="Prénom" required>

                            @error('name')

                            <small id="" class="form-text  text-danger"> {{ $message }}</small>

                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" value="{{ $me->last_name }}" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="Nom">
                            @error('last_name')

                            <small id="" class="form-text  text-danger">{{ $message }}</small>

                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <input type="email" value="{{ $me->email }}" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
                            @error('email')

                            <small id="" class="form-text  text-danger">{{ $message }}</small>

                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" value="{{ $me->phone ?? "" }}" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Téléphone">
                            @error('phone')

                            <small id="" class="form-text  text-danger">{{ $message }}</small>

                            @enderror
                        </div>
                        <div class="form-group mb-3">
                                <textarea type="text" value="{{ $me->adresse ?? "" }}" class="form-control @error('adresse') is-invalid @enderror" name="adresse" placeholder="Adresse">@if($me->adresse){{ $me->adresse }}@endif</textarea>
                            @error('adresse')

                            <small id="" class="form-text  text-danger">{{ $message }}</small>

                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 float-right ">Enregistrer</button>

                    </form>
                </div>
                </div>

                </div>
            </div>



        </div>
    </div>
@endsection
