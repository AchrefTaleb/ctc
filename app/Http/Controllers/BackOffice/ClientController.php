<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Client;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function list()
    {
        $this->authorize('client-list', Client::class);

        $clients = User::role('client')->get();

        return view('BackOffice.pages.client.client-list',[
            "clients" => $clients,
        ]);

    }

    public function formCreate()
    {
        $this->authorize('client-create', Client::class);

        return view('BackOffice.pages.client.client-create');

    }

    public function create(ClientRequest $request)
    {
        $this->authorize('create', Client::class);

        $req = $request->all();
        $req['password'] = Hash::make('password');
        $user = Client::create($req);
        $user->refresh();
        $user = User::find($user->id);
        $user->assignRole('client');
        $user->assignRole('frontoffice');


        return back()->with('success','Votre utilisateur à etait enregistrer!');
    }


    public function FormUpdate(Client $user)
    {


        return view('BackOffice.pages.client.client-update',[
            'client' => $user
        ]);
    }

    public function update(ClientUpdateRequest $request)
    {
        $staff = Client::findOrFail($request->post('id'));

        $staff->update($request->only(['name','last_name','email','phone']));

        return back()->with('success','Votre utilisateur à etait modifier!');
    }

    public function delete(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
        ]);

        $user = User::findOrFail($request->post('id'));
        $user->roles()->detach();
        $user->delete();

        return back()->with('success','Votre utilisateur à etait supprimer!');

    }
}

