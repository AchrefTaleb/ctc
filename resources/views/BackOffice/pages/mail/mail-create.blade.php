@extends('BackOffice.layouts.layout')

@section('content')
    <div  class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Nouveau courrier</h4>
                        </div>
                        <div class="col-md-12">
                            <hr/>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <form method="POST" action="{{ route('backoffice.mail.store') }}" novalidate>
                            @csrf
                            <div class="form-group mb-3">
                                <label>Expéditeur:</label>
                                <input type="text" class="form-control @error('from') is-invalid @enderror " name="from" placeholder="Expéditeur" required>

                                @error('from')

                                    <small id="" class="form-text  text-danger"> {{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>Client:</label>
                                <select  class="form-control sclient @error('user_id') is-invalid @enderror" name="user_id" >
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}"> {{ $client->name.' '.$client->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Types:</label>
                                <select  class="form-control @error('type') is-invalid @enderror" name="type" >
                                    <option value="mail">Courrier</option>
                                    <option value="package">Colis</option>
                                </select>
                                @error('type')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>Catégorie:</label>
                                <select class="form-control scategory @error('category_mail_id') is-invalid @enderror" name="category_mail_id" >
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_mail_id')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>
                            <div class="form-group mb-3">
                            <label>Description:</label>
                                <textarea rows="3" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description"></textarea>
                                    @error('description')

                                    <small id="" class="form-text  text-danger">{{ $message }}</small>

                                @enderror
                            </div>

                    <button type="submit" class="btn btn-primary mt-3 float-right ">Submit</button>
                    <a class="btn btn-dark mt-3 mr-2 float-right " href="{{ route('backoffice.mail.list') }}">Fermer</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var sclient = $(".sclient").select2({
                tags: true,
            });
            var sctegory = $(".scategory").select2({
                tags: true,
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const app = new Vue({
                el: '#app',
                data: {

                },
                created() {

                },
                mounted() {

                },
                methods: {},

                watch: {},

            });
        });
    </script>
@endsection
