@extends('FrontOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">
        <form method="post" action="{{ route('frontoffice.mail.request.send') }}" style="width:100%">
            @csrf
        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Demande de réexpédition des courriers</h4>
                            <button type="submit" class="btn  mr-3 btn-warning float-right mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg> Ajouter</button>
                        </div>
                        <div class="col-md-12">
                            <hr/>
                            <label>Saisir l'adresse de réexpédition</label>
                            <textarea class="form-control" name="adresse" placeholder="Saisir votre adresse..." required></textarea>
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
                                <th>Description</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mails as $mail)
                                <tr>
                                    <td>
                                        <input class="form-control" type="checkbox" name="mails[]" value="{{ $mail->id }}">
                                    </td>
                                    <td>{{ $mail->code }}</td>
                                    <td>{{ $mail->from ?? "-----" }}</td>
                                    <td>{{ $mail->client->name.' '.$mail->client->last_name }}</td>
                                    <td>{{ $mail->type ?? "-----" }}</td>
                                    <td>{{ $mail->category->name ?? "-----" }}</td>
                                    <td>{{ $mail->created_at->format('d-m-Y') ?? "-----" }}</td>
                                    <td><p>{{Str::limit($mail->description , 20, ' (...)')?? "-----" }}</p></td>

                                </tr>





                            @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
