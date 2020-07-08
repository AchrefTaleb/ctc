@extends('BackOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Staff</h4>
                            <a href="{{ route('backoffice.staff.createform') }}" class="btn  mr-3 btn-warning float-right mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg> Ajouter</a>
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
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Etat</th>
                        <th class="no-content">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($staffs as $staff)
                    <tr>
                        <td>
                            <span><img  src="{{ asset('media/BackOffice/img').'/'.$staff->photo }}" class="profile-img" alt="avatar"></span>
                        </td>
                        <td>{{ $staff->name }}</td>
                        <td>{{ $staff->last_name ?? "-----" }}</td>
                        <td>{{ $staff->email ?? "-----" }}</td>
                        <td>{{ $staff->phone ?? "-----" }}</td>
                        <td>@if($staff->status) <span class="shadow-none badge badge-primary">Active</span> @else <span class="shadow-none badge badge-danger">Suspendu</span> @endif</td>
                       <td class="text-center">
                           <ul class="table-controls">
                               <li class="warning"><a href="{{ route('backoffice.staff.updateform',['user' => $staff->id]) }}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                               <li><a href="javascript:void(0);" class="bs-tooltip" data-toggle="modal" data-target="#staff{{$staff->id}}" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                           </ul>
                       </td>
                    </tr>


                    <!-- Modal -->
                    <div class="modal fade" id="staff{{ $staff->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Suprimer {{ $staff->name.' '.$staff->last_name }}</h5>
                                </div>
                                <div class="modal-body">
                                    <p class="modal-text">voulez-vous vraiment supprimer cet utilisateur ? </p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Fermer</button>
                                    <form method="POST"  action="{{ route('backoffice.staff.delete') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $staff->id }}">
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

@section('script')

    @if ($message = Session::get('success'))

        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                swal.fire({
                    title: 'Good job!',
                    text: "{{ $message }}",
                    type: 'success',
                    padding: '2em'
                });
            });
        </script>

    @endif
@endsection


