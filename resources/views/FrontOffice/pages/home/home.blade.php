@extends('FrontOffice.layouts.layout')

@section('content')

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="row widget-statistic">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                    <div class="widget widget-one_hybrid widget-yellow">
                        <div class="widget-heading">

                            Bienvenue

                            <p class="w-value" style="text-align: center;color:#fff">{{ auth()->user()->name.' '.auth()->user()->last_name }}</p>
                            <h5 class=""></h5>
                        </div>

                    </div>
                </div>

            </div>
            <hr/>
            <div class="row widget-statistic">


                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 ">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-icon2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                            <p class="w-value">{{ $nb_mails_today }} <span class="float-right" style="font-weight: normal;">Nouveau courrier</span></p>

                        </div>

                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 ">
                    <div class="widget widget-one_hybrid widget-blue">
                        <div class="widget-heading">
                            <div >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>                            </div>
                            <p class="w-value">{{ $nb_mails }} <span class="float-right" style="font-weight: normal;"><a style="text-decoration: none;color: inherit" href="{{ route('frontoffice.mail.list') }}">Total courriers</a></span></p>

                        </div>

                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 ">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-icon2" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-navigation"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>                            </div>
                            <p class="w-value">{{ $nb_requests }} <span class="float-right" style="font-weight: normal;"><a href="{{ route('frontoffice.mail.request.list') }}">Réexpidition à payer</a></span></p>

                        </div>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mt-3 ">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-icon2" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-navigation"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
                            </div>
                            <p class="w-value">{{ $nb_notseen }} <span class="float-right" style="font-weight: normal;"><a href="{{ route('frontoffice.mail.list') }}">Courriers non lus</a></span></p>

                        </div>

                    </div>
                </div>
                @if($ends)
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mt-3 "></div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mt-3 ">
                    <div class="widget widget-one_hybrid widget-blue">
                        <div class="widget-heading">
                            <div >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-watch"><circle cx="12" cy="12" r="7"></circle><polyline points="12 9 12 12 13.5 13.5"></polyline><path d="M16.51 17.35l-.35 3.83a2 2 0 0 1-2 1.82H9.83a2 2 0 0 1-2-1.82l-.35-3.83m.01-10.7l.35-3.83A2 2 0 0 1 9.83 1h4.35a2 2 0 0 1 2 1.82l.35 3.83"></path></svg></div>
                                <p class="w-value">{{ $ends}} <span class="float-right" style="font-weight: normal;"><a style="text-decoration: none;color: inherit" href="#">Fin de contract</a></span></p>

                        </div>

                    </div>
                </div>
                @endif


            </div>



            <hr/>

        </div>
@endsection
