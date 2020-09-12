@extends('FrontOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Corbielle</h4>
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
                        <th>Description</th>
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
                               @if(false)
                               <li class="warning"><a href="@{{ route('frontoffice.client.updateform',['user' => $mail->id]) }}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                              @endif
                                   @if(($opening > 0) or ($opening === 'illimited') or ($mail->open))
                                   <li class="warning"><a href="{{ route('frontoffice.mail.show',[$mail->id]) }}" class="bs-tooltip"  data-placement="top" title="" data-original-title="Show">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>                                       </a></li>
                                    @endif
                                   <li><a href="javascript:void(0);" class="bs-tooltip" data-toggle="modal" data-target="#client{{$mail->id}}" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                           </ul>
                       </td>
                    </tr>


                    <!-- Modal -->
                    <div class="modal fade" id="client{{ $mail->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Supprimer {{ $mail->name.' '.$mail->last_name }}</h5>
                                </div>
                                <div class="modal-body">
                                    <p class="modal-text">voulez-vous vraiment supprimer ce courrier ? </p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Fermer</button>
                                    <form method="POST"  action="{{ route('frontoffice.mail.delete') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $mail->id }}">
                                        <button type="submit" class="btn btn-danger">Oui</button>

                                    </form>
                                </div>
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

