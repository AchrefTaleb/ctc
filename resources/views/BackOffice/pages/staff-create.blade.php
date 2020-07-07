@extends('BackOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">
        @if ($message = Session::get('success'))

            <div class="alert alert-success alert-block">

                <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ $message }}</strong>

            </div>

        @endif
        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Staff- Ajout</h4>
                        </div>
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <form method="post" action="{{ route('backoffice.staff.store') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="name" placeholder="prenom">
                                <small id="emailHelp1" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="last_name" placeholder="nom">
                                <small id="" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group mb-3">
                                <input type="email" class="form-control" name="email" placeholder="email">
                                <small id="" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="phone" placeholder="téléphone">
                                <small id="" class="form-text text-muted"></small>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
