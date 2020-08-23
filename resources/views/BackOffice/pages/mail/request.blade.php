@extends('BackOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">

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
                                <th><div class="th-content">Courrier</div></th>
                                <th><div class="th-content">Client</div></th>
                                <th><div class="th-content">adresse</div></th>
                                <th><div class="th-content th-heading">Price(€)</div></th>
                                <th><div class="th-content">Status</div></th>
                                <th><div class="th-content">Action</div></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($requested as $request) <tr>
                                <td>{{ $request->id }}</td>
                                <td><div class="td-content product-brand">{{ $request->mail->code }}</div></td>
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

    </div>

    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Liste des demandes en cours</h4>
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

                            @foreach($approved as $request) <tr>
                                <td>{{ $request->id }}</td>
                                <td><div class="td-content product-brand">{{ $request->mail->code }}</div></td>
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
                                        <a href="{{ route('backoffice.mail.request.canceling',$request->id) }}" class="button btn btn-danger">Annuler</a>
                                    @elseif($request->status == 'approved')
                                        <a href="#" class="btn btn-danger">Annuler</a>
                                    @elseif($request->status == 'executed')

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

    <div class="row col-md-12 layout-top-spacing layout-spacing">

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
                                <td><div class="td-content product-brand">{{ $request->mail->code }}</div></td>
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

    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Liste des courriers envoyés</h4>
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

                            @foreach($sent as $request) <tr>
                                <td>{{ $request->id }}</td>
                                <td><div class="td-content product-brand">{{ $request->mail->code }}</div></td>
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

    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Liste des demandes annulées</h4>
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

                            @foreach($canceled as $request)
                                <tr>
                                <td>{{ $request->id }}</td>
                                <td><div class="td-content product-brand">{{ $request->mail->code }}</div></td>
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

