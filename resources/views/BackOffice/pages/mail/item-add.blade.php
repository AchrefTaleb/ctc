@extends('BackOffice.layouts.layout')

@section('content')
    <div  class="row col-md-12 layout-top-spacing layout-spacing">

        <div class="col-md-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 inline">
                            <h4 class="float-left">Courrier @{{ mail.code }} elements <span v-if="!show" class="badge outline-badge-success">Enregistrée</span> </h4>
                            <button v-if="show" class="btn btn-info mt-2 float-right" @click="save()">Enregister</button>
                            <a v-else class="btn btn-info mt-2 float-right" href="{{ route('backoffice.mail.list') }}">Retourner vers la liste</a>
                        </div>
                        <div v-if="show" class="col-md-12">
                            <hr/>
                        </div>
                    </div>
                </div>
                <div v-if="show" class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <div class="col-md-12">
                            <p>Ajouter les éléments de courrier et leurs photos ou documents</p>
                        </div>
                         <div class="col-md-12">
                              <div class="form-inline">
                                @csrf
                                <div class="form-group mr-2">
                                    <label class="mr-2">Ajouter element</label>
                                    <input type="text" class="form-control " v-model="item.name" placeholder="titre" required>

                                </div>
                                <div class="form-group mr-2">
                                    <label class="mr-2">Description</label>
                                    <input type="text" class="form-control " v-model="item.description" placeholder="Description..." required>

                                </div>
                                <button  class="btn btn-primary" @click="addItem()">Ajouter</button>
                             </div>
                         </div>

                        <div class=" row col-md-12" v-for="itm in mail.items">
                            <div class="col-md-12"><hr/></div>
                            <div class="col-md-6">
                                <div class="infobox-3">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                    </div>
                                    <h5 class="info-heading">@{{ itm.title }}</h5>
                                    <p class="info-text">@{{ itm.description }}.</p>
                                    <div class="form-check-inline">
                                       <input type="file" multiple @change="upload($event,itm.files)">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 widget-content widget-content-area image-style-content text-center">
                                <div class="avatar avatar-xl mr-2" v-for="(dig,index) in itm.files">
                                    <label @click="remove_file(index,itm.files)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></label>
                                    <img v-if="dig.type == 'photo'" alt="avatar" :src="dig.src" class="rounded" />
                                    <img v-else alt="avatar" src="/media/document.png" class="rounded" />
                                    <label>@{{ dig.file.name }}</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')


    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const app = new Vue({
                el: '#appV',
                data: {
                    show: true,
                    item:{
                        name:'',
                        description:'',
                    },
                    mail:{
                        id: '{{ $mail->id }}',
                        code: '{{ $mail->code }}',
                        items:[],
                    },
                },
                created() {

                },
                mounted() {

                },
                methods: {
                    addItem: function () {
                        let tmp = {
                            title: this.item.name,
                            description: this.item.description,
                            files:[],
                        };
                        this.mail.items.unshift(tmp);
                        console.log(this.mail);
                    },
                    upload: function (e,bucket) {
                        var selectedFiles = e.target.files;
                        for (let i = 0; i < selectedFiles.length; i++) {
                            let reader = new FileReader();
                            reader.readAsDataURL(selectedFiles[i]);
                            reader.onload = (ee) => {
                                console.log(reader);
                                let itm = {
                                    file: selectedFiles[i],
                                    type: reader.result.includes('application') ? 'document' : 'photo',
                                    src: reader.result,
                                    uri: selectedFiles[i].name
                                };
                                bucket.push(itm);
                            }
                        }
                        console.log(this.mail);
                    },
                    remove_file: function(i,bucket)
                    {
                        bucket.splice(i,1);
                    },

                    save: function () {

                        let formData = new  FormData();

                        formData.append('mail',JSON.stringify(this.mail));

                        axios.post('{{ route('backoffice.mail.items.store') }}',
                            formData,
                            {
                                errorHandle: false,
                                headers:{
                                    'Content-Type': 'multipart/form-data'
                                }
                            }).then( response => {
                            Snackbar.show({
                                text: 'Les element de coirrier sauvgarder !',
                                actionTextColor: '#fff',
                                backgroundColor: '#8dbf42',
                                pos: 'top-right'
                            });
                            this.show =false;

                        }).catch(error => {
                            console.log(error.data);
                        });
                    }
                },

                watch: {},

            });
        });
    </script>
@endsection
