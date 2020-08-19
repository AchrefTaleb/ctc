@extends('FrontOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Courrier</h4>
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
                                <th><div class="th-content">adresse</div></th>
                                <th><div class="th-content th-heading">Price(€)</div></th>
                                <th><div class="th-content">Status</div></th>
                                <th><div class="th-content">Facture</div></th>
                                <th><div class="th-content">Action</div></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($requests as $request) <tr>
                                <td>{{ $request->id }}</td>
                                <td><div class="td-content product-brand">{{ $request->mail->code }}</div></td>
                                <td><div class="td-content">{{ $request->adresse }}</div></td>
                                <td><div class="td-content pricing"><span class="">{{ $request->price ? '€'.$request->price : '----' }} </span></div></td>
                                <td><div class="td-content">
                                            @if($request->status == 'requested')
                                            <span class="badge outline-badge-primary">En attente</span>
                                            @elseif($request->status == 'approved')
                                            <span class="badge outline-badge-warning">Valider le paiement</span>
                                            @elseif($request->status == 'executed')
                                            <span class="badge outline-badge-success">Encours</span>
                                            @elseif($request->status == 'sent')
                                            <span class="badge outline-badge-info">Envoyer</span>
                                            @else
                                            <span class="badge outline-badge-danger">Annulé</span>
                                            @endif
                                        </div></td>
                                <td>
                                    @if($request->invoice != null)
                                        <a target="_blank" href="{{ $request->invoice }}">Voir facture</a>
                                    @else
                                        ---
                                    @endif
                                </td>
                                <td>
                                    @if($request->status == 'requested')
                                        <a href="{{ route('frontoffice.mail.request.canceling',$request->id) }}" class="button btn btn-danger">Annuler</a>
                                    @elseif($request->status == 'approved')
                                        <a href="{{ route('frontoffice.mail.request.checkout',$request->id) }}" class="btn btn-warning">procéder au paiement</a>
                                        <a href="{{ route('frontoffice.mail.request.canceling',$request->id) }}" class="button btn btn-danger">Annuler</a>
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


