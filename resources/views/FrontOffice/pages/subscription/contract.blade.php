@extends('FrontOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="hd-tab-section">
                <div class="row">
                    <div class="col-md-12 mb-5 mt-5">

                        <div class="accordion" id="hd-statistics">

                            <div class="card">
                                <div class="card-header" id="hd-statistics-2">
                                    <div class="mb-0">
                                        <div class=" collapsed" data-toggle="collapse" role="navigation" data-target="#collapse-hd-statistics-2" aria-expanded="true" aria-controls="collapse-hd-statistics-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                                            Félicitation! Votre compte à été crée.
                                        </div>
                                    </div>
                                </div>
                                <div id="collapse-hd-statistics-2" class="collapse show" aria-labelledby="hd-statistics-2" data-parent="#hd-statistics">
                                    <div class="card-body">
                                        <p>Désolé l'application est encour de développement.</p>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            $('.new-control-input').on('change', function() {
                let price = $(this).data('val');
                let clas = $(this).data('form');
                $('.'+clas).text(price);
            });
        });
    </script>


@endsection
