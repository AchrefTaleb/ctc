@extends('FrontOffice.layouts.layout')

@section('content')
    <div class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Courrier {{ $mail->code }}</h4>
                            <a href="https://dev.transfertdecourrier.com/frontoffice/mail" class="btn btn-info mt-2 float-right">Retourner vers la liste</a>
                        </div>
                        <div class="col-md-12">
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <div class="row col-md-12">
                            <div class="row col-md-6">
                                <div class="col-md-6">
                                    <label>code:</label>
                                    <p>  {{ $mail->code }}</p>
                                </div>
                                <div class="col-md-16">
                                    <label>Description:</label>
                                    <p>{{ $mail->description }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Expéditeur,:</label>
                                    <p>{{ $mail->from }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Date:</label>
                                    <p>{{ $mail->created_at->format('d-m-Y') ?? "-----"  }}</p>
                                </div>
                            </div>
                            <div class=" row col-md-3"></div>
                            <div class=" row col-md-3">
                                <div class="col-md-12 text-right">
                                    @if(!$mail->trash)
                                        <form action="{{ route('frontoffice.mail.trash') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $mail->id }}">
                                            <button type="submit" class="btn btn-block btn-danger">Placer dans la corbeille</button>
                                        </form>
                                    @else
                                        <form action="{{ route('frontoffice.mail.restore') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $mail->id }}">
                                            <button type="submit" class="btn btn-block btn-success">Restaurer</button>
                                        </form>
                                    @endif

                                </div>
                                <div class="col-md-12 text-right">
                                    @if(!$mail->archive)
                                        <form action="{{ route('frontoffice.mail.archive') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $mail->id }}">
                                            <button type="submit" class="btn btn-block btn-warning">Placer dans l'archive</button>
                                        </form>
                                    @else
                                        <form action="{{ route('frontoffice.mail.restore_archive') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $mail->id }}">
                                            <button type="submit" class="btn btn-block btn-success">Restaurer</button>
                                        </form>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr/>
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-12">
                                    <h3>Contenus</h3>
                                </div>
                                @foreach($mail->items as $item)
                                <div class="row col-md-12 mt-2">
                                    <div class="row col-md-6">
                                       <div class="col-md-6">
                                           <label>Titre:</label>
                                           <p>{{ $item->title }}</p>
                                       </div>
                                        <div class="col-md-6">
                                            <label>Description:</label>
                                            <p>{{ $item->description }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 widget-content widget-content-area image-style-content text-center">
                                       @foreach($item->digitals as $elm)
                                        <div class="avatar avatar-xl mr-2">
                                            @if($elm->type == 'photo')
                                                <a href="{{ asset('media/'.$elm->uri) }}" target="_blank"><img  alt="avatar" src="{{ asset('media/'.$elm->uri) }}" class="rounded" /></a>

                                            @else
                                                <a href="{{ asset('media/'.$elm->uri) }}" target="_blank"><img v-else alt="avatar" src="/media/document.png" class="rounded" /></a>

                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-12">
                                        <hr/>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

