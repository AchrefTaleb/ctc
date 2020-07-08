@extends('BackOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">

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
                        <form method="POST" action="{{ route('backoffice.staff.store') }}" novalidate>
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror " name="name" placeholder="prenom" required>

                                @error('name')

                                    <small id="" class="form-text  text-danger"> {{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="nom">
                                @error('last_name')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="email">
                                @error('email')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="téléphone">
                                @error('phone')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 float-right ">Submit</button>
                            <a class="btn btn-dark mt-3 mr-2 float-right " href="{{ route('backoffice.staff.list') }}">Fermer</a>                        </form>
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
