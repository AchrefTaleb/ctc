@extends('FrontOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Courrier</h4>
                            <a href="{{ route('backoffice.mail.createform') }}" class="btn  mr-3 btn-warning float-right mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg> Ajouter</a>
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
                                <th>De</th>
                                <th>Pour</th>
                                <th>type</th>
                                <th>Catégorie</th>
                                <th>le</th>
                                <th>description</th>
                                <th class="no-content">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mails as $mail)
                                <tr>
                                    <td>
                                        #
                                    </td>
                                    <td>{{ $mail->code }}</td>
                                    <td>{{ $mail->from ?? "-----" }}</td>
                                    <td>{{ $mail->client->name.' '.$mail->client->last_name }}</td>
                                    <td>{{ $mail->type ?? "-----" }}</td>
                                    <td>{{ $mail->category->name ?? "-----" }}</td>
                                    <td>{{ $mail->created_at->format('d-m-Y') ?? "-----" }}</td>
                                    <td><p>{{Str::limit($mail->description , 20, ' (...)')?? "-----" }}</p></td>
                                    <td class="text-center">
                                        <ul class="table-controls">


                                            <li class="warning"><a href="{{ route('frontoffice.mail.show',[$mail->id]) }}" class="bs-tooltip"  data-placement="top" title="" data-original-title="Show">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>                                       </a></li>
                                            <li><a href="javascript:void(0);" class="bs-tooltip" data-toggle="modal" data-target="#client{{$mail->id}}" data-placement="top" title="" data-original-title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>                                                </a></li>

                                        </ul>
                                    </td>
                                </tr>


                                <!-- Modal -->
                                <div class="modal fade" id="client{{ $mail->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Demander l'envoi de courrier : {{ $mail->code}}</h5>
                                            </div>
                                            <form method="POST"  action="{{ route('frontoffice.mail.request.send') }}">
                                            <div class="modal-body">
                                                <textarea class="form-control" name="adresse" placeholder="Ssir l'adresse de réception..." required></textarea>
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