@extends('FrontOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Courrier</h4>
                            <div style="margin-bottom: 0;margin-top: 5px;" class="float-right alert alert-warning mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> Il vous reste {{ $opening  }} overtures durant ce mois !</div>

                        <!-- <a href="{{ route('backoffice.mail.createform') }}" class="btn  mr-3 btn-warning float-right mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg> Ajouter</a>-->
                        </div>
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="staff-table" class="multi-table table table-striped style-3 table-bordered table-hover non-hover" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Expéditeur</th>
                                <th>Destinataire</th>
                                <th>type</th>
                                <th>Catégorie</th>
                                <th>Date</th>
                                <th>description</th>
                                <th class="no-content">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mails as $mail)
                                <tr @if(!$mail->open) style="background-color: #f1f2f3 !important;" @endif>
                                    <td>
                                        #
                                    </td>
                                    <td>{{ $mail->code }}</td>
                                    <td>{{ $mail->from ?? "-----" }}</td>
                                    <td><span class="badge-primary">{{ $mail->client->id }}</span>{{ $mail->client->name.' '.$mail->client->last_name }}</td>
                                    <td>{{ $mail->type ?? "-----" }}</td>
                                    <td>{{ $mail->category->name ?? "-----" }}</td>
                                    <td>{{ $mail->created_at->format('d-m-Y') ?? "-----" }}</td>
                                    <td><p>{{Str::limit($mail->description , 20, ' (...)')?? "-----" }}</p></td>
                                    <td class="text-center">
                                        @if($opening == 'illimited' || $opening >= 1)
                                        <ul class="table-controls">


                                            <li class="warning"><a href="{{ route('frontoffice.mail.show',[$mail->id]) }}" class="bs-tooltip"  data-placement="top" title="" data-original-title="Show">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>                                       </a></li>


                                        </ul>
                                        @endif
                                    </td>
                                </tr>


                                <!-- Modal -->
                                <div class="modal fade" id="client{{ $mail->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Réexpédier le courrier : {{ $mail->code}}</h5>
                                            </div>
                                            <form method="POST"  action="{{ route('frontoffice.mail.request.send') }}">
                                            <div class="modal-body">
                                                <textarea class="form-control" name="adresse" placeholder="Saisir l'adresse de destinataire..." required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Fermer</button>

                                                    @csrf
                                                    <input type="hidden" name="mail" value="{{ $mail->id }}">
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
@endsection
