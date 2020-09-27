@extends('BackOffice.layouts.layout')

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
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                            <p class="w-value">{{ $nb_clients }} <span class="float-right" style="font-weight: normal;"><a style="text-decoration: none;color: inherit" href="{{ route('backoffice.client.list') }}">Total clients</a></span></p>

                        </div>

                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 ">
                    <div class="widget widget-one_hybrid widget-blue">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>                            </div>
                            <p class="w-value">{{ $nb_mails }} <span class="float-right" style="font-weight: normal;"><a style="text-decoration: none;color: inherit" href="{{ route('backoffice.mail.list') }}">Total courriers</a></span></p>

                        </div>

                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 ">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-navigation"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>                            </div>
                            <p class="w-value">{{ $nb_requests }} <span class="float-right" style="font-weight: normal;">Total réexpéditions</span></p>

                        </div>

                    </div>
                </div>


            </div>

            <div class="row widget-statistic mt-3">


                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 ">
                    <div class="widget widget-one_hybrid widget-blue">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                            <p class="w-value">{{ $nb_clients_today }} <span class="float-right" style="font-weight: normal;">Nouveaux clients</span></p>

                        </div>

                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 ">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>                            </div>
                            <p class="w-value">{{ $nb_mails_today }} <span class="float-right" style="font-weight: normal;">Nouveaux courriers</span></p>

                        </div>

                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 ">
                    <div class="widget widget-one_hybrid widget-blue">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>                            </div>
                            <p class="w-value">{{ $nb_requested_today }} <span class="float-right" style="font-weight: normal;">Nouvelles réexpéditions</span></p>

                        </div>

                    </div>
                </div>


            </div>

            <hr/>
            <div class="col-md-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                                <h4 class="float-left">Liste des demandes de réexpédition</h4>
                            </div>
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><div class="th-content">Demande</div></th>
                                    <th><div class="th-content">Courriers</div></th>
                                    <th><div class="th-content">Client</div></th>
                                    <th><div class="th-content">adresse</div></th>
                                    <th><div class="th-content th-heading">Price(€)</div></th>
                                    <th><div class="th-content">Status</div></th>
                                    <th><div class="th-content">Action</div></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($requesteds as $request) <tr>
                                    <td>{{ $request->id }}</td>
                                    <td><div class="td-content product-brand"><ul>
                                                @foreach($request->mails as $mail)
                                                    <li>{{ $mail->code }}</li>
                                                @endforeach
                                            </ul></div></td>
                                    <td><div class="td-content product-brand">{{ $request->client->name ?? '' }} {{ $request->client->last_name ?? '' }}</div></td>
                                    <td><div class="td-content">{{ $request->adresse }}</div></td>
                                    <td><div class="td-content pricing"><span class="">{{ $request->price ? '€'.$request->price : '----' }} </span></div></td>
                                    <td><div class="td-content">
                                            @if($request->status == 'requested')
                                                <span class="badge outline-badge-primary">En attente</span>
                                            @elseif($request->status == 'approved')
                                                <span class="badge outline-badge-warning">Valider le paiement</span>
                                            @elseif($request->status == 'executed')
                                                <span class="badge outline-badge-success">En cours</span>
                                            @elseif($request->status == 'sent')
                                                <span class="badge outline-badge-info">Envoyer</span>
                                            @else
                                                <span class="badge outline-badge-danger">Annulé</span>
                                            @endif
                                        </div></td>
                                    <td>
                                        @if($request->status == 'requested')
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#client{{$request->id}}">Ajouter un coût</button>
                                            <a href="{{ route('backoffice.mail.request.canceling',$request->id) }}" class="button btn btn-danger">Annuler</a>
                                        @elseif($request->status == 'approved')
                                            <a href="#" class="button btn-warning">Procéder au paiement</a>
                                            <a href="#" class="button btn-danger">Annuler</a>
                                        @elseif($request->status == 'executed')

                                        @elseif($request->status == 'sent')

                                        @else

                                        @endif
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="client{{ $request->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Associer un prix : {{ $request->code}}</h5>
                                            </div>
                                            <form method="POST"  action="{{ route('backoffice.mail.request.approve') }}">
                                                <div class="modal-body">
                                                    <p>
                                                        Adresse:
                                                        {{ $request->adresse }}
                                                    </p>
                                                    <hr/>
                                                    <input class="form-control" type="number" step="0.01" name="price" placeholder="prix..." required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Fermer</button>

                                                    @csrf
                                                    <input type="hidden" name="request" value="{{ $request->id }}">
                                                    <button type="submit" class="btn btn-danger">Oui</button>


                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="col-md-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                                <h4 class="float-left">Liste des demandes payées</h4>
                            </div>
                            <div class="col-md-12">
                                <hr/>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><div class="th-content">Demande</div></th>
                                    <th><div class="th-content">Courrier</div></th>
                                    <th><div class="th-content">Client</div></th>
                                    <th><div class="th-content">Adresse</div></th>
                                    <th><div class="th-content th-heading">Prix(€)</div></th>
                                    <th><div class="th-content">Status</div></th>
                                    <th><div class="th-content">Action</div></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($executed as $request) <tr>
                                    <td>{{ $request->id }}</td>
                                    <td><div class="td-content product-brand"><ul>
                                                @foreach($request->mails as $mail)
                                                    <li>{{ $mail->code }}</li>
                                                @endforeach
                                            </ul></div></td>
                                    <td><div class="td-content product-brand">{{ $request->client->name ?? '' }} {{ $request->client->last_name ?? '' }}</div></td>
                                    <td><div class="td-content">{{ $request->adresse }}</div></td>
                                    <td><div class="td-content pricing"><span class="">{{ $request->price ? '€'.$request->price : '----' }} </span></div></td>
                                    <td><div class="td-content">
                                            @if($request->status == 'requested')
                                                <span class="badge outline-badge-primary">En attente</span>
                                            @elseif($request->status == 'approved')
                                                <span class="badge outline-badge-warning">Valider le paiement</span>
                                            @elseif($request->status == 'executed')
                                                <span class="badge outline-badge-success">En cours</sp
                                        @elseif($request->status == 'sent')
                                                        <span class="badge outline-badge-info">Envoyer</span>
                                                    @else
                                                        <span class="badge outline-badge-danger">Annuler</span>
                                            @endif
                                        </div></td>
                                    <td>
                                        @if($request->status == 'requested')
                                            <a href="{{ route('backoffice.mail.request.canceling',$request->id) }}" class="button btn btn-danger">Annuler</a>
                                        @elseif($request->status == 'approved')
                                            <a href="#" class="button btn-warning">procéder au paiement</a>
                                            <a href="#" class="button btn-danger">Annuler</a>
                                        @elseif($request->status == 'executed')
                                            <form method="post" action="{{ route('backoffice.mail.request.sent') }}">
                                                @csrf
                                                <input type="hidden" name="request" value="{{ $request->id }}">
                                                <button class="btn btn-success">Marquer comme envoyée</button>
                                            </form>
                                        @elseif($request->status == 'sent')

                                        @else

                                        @endif
                                    </td>
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
