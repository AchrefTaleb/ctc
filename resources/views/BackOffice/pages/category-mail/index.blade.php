@extends('BackOffice.layouts.layout')

@section('content')

    <div class="col-md-12 mt-3">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Catégories</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <div class='parent ex-1'>
                    <div class="row">
                        <div class="col-md-4 ">
                            <p> Vous avez {{ count($categories) }} catégories.</p>
                        </div>
                        <div class="col-md-8 ">
                            <form class="form-inline float-right" method="POST" action="{{ route('backoffice.categorymail.create') }}" novalidate>
                                @csrf
                                <div class="form-group mr-2">
                                    <label class="mr-2">Ajouter nouvelle catégorie de courrier</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror " name="name" placeholder="Nom de catégorie" required>

                                    @error('name')

                                    <small id="" class="form-text  text-danger"> {{ $message }}</small>

                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary  ">Ajouter</button>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <hr/>
                        </div>
                        <div class="col-md-12">
                            <form class="form-inline float-left" novalidate>
                                @csrf
                                <div class="form-group mr-2">
                                    <label class="mr-2">Recherche: </label>
                                    <input type="text" class="form-control " id="Search" name="search" placeholder="taper pour chercher" onkeyup="categoriesSearch()">
                                </div>

                            </form>
                        </div>
                        @foreach($categories as $category)
                            <div class="col-md-4 target">
                                <div id='left-defaults' class='dragula'>
                                    <div class="media  d-md-flex d-block text-sm-left text-center">
                                        <div class="media-body">
                                            <div class="d-xl-flex d-block justify-content-between">
                                                <div class="">
                                                    <h6 class="">{{ $category->name }}</h6>
                                                    <p class="">{{ $category->created_at->format('d-m-Y') }}</p>
                                                </div>
                                                <div>
                                                    <table class="style-3 categories">
                                                        <tr>
                                                            <td>
                                                                <ul class="table-controls">
                                                                    <li class="warning"><a href="javascript:void(0);" class="bs-tooltip"  data-toggle="modal" data-target="#categoryupdate{{ $category->id }}" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                                                    <li><a href="javascript:void(0);" class="bs-tooltip" data-toggle="modal" data-target="#category{{ $category->id }}" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal delete -->
                            <div class="modal fade" id="category{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Suprimer {{ $category->name}}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p class="modal-text">voulez-vous vraiment supprimer cette catégorie ? </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Fermer</button>
                                            <form method="POST"  action="{{ route('backoffice.categorymail.delete') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $category->id }}">
                                                <button type="submit" class="btn btn-danger">Oui</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal update -->
                            <div class="modal fade" id="categoryupdate{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modifer {{ $category->name}}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-inline justify-content-center" method="POST" action="{{ route('backoffice.categorymail.update') }}" novalidate>
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $category->id }}">
                                                <div class="form-group mr-2">

                                                    <input type="text" value="{{ $category->name }}" class="form-control @error('name') is-invalid @enderror " name="name" placeholder="nom de catéforie" required>

                                                    @error('name')

                                                    <small id="" class="form-text  text-danger"> {{ $message }}</small>

                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary  ">Appliquer</button>
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-dark" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>



            </div>
        </div>

    </div>




@endsection

@section('script')
<script>
    function categoriesSearch() {
        var input = document.getElementById("Search");
        var filter = input.value.toLowerCase();
        var nodes = document.getElementsByClassName('target');

        for (i = 0; i < nodes.length; i++) {
            if (nodes[i].innerText.toLowerCase().includes(filter)) {
                nodes[i].style.display = "block";
            } else {
                nodes[i].style.display = "none";
            }
        }
    };


</script>
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



