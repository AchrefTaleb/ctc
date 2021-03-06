<?php

namespace App\Http\Controllers\BackOffice;

use App\Helpers\stripeHelper;
use App\Http\Controllers\Controller;
use App\Client;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Mail\newUserMail;
use App\Mail\SignupMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

        $stripe = new stripeHelper();

        $user = $stripe->addCustomer($user);

       // $user->notify();
        Mail::to($user->email)->send(new SignupMail($user));

        return back()->with('success','Votre client à été enregistré!');
    }


    public function FormUpdate(Client $user)
    {


        return view('BackOffice.pages.client.client-update',[
            'client' => $user
        ]);
    }

    public function update(ClientUpdateRequest $request)
    {
        $this->authorize('update-client', Client::class);

        $staff = Client::findOrFail($request->post('id'));

        $staff->update($request->only(['name','last_name','email','phone','code','adresse']));

        return back()->with('success','Votre client à été modifié! ');
    }

    public function delete(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
        ]);

        $user = User::findOrFail($request->post('id'));
        $user->roles()->detach();
        $user->delete();

        return back()->with('success','Votre client à été supprimé!');

    }

    public function activateContract(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'type' => 'required'
        ]);

        $user = User::findOrFail($request->post('id'));

        $user->status = 0;

        $user->save();

        return back()->with('success','Validation de contrat enrigistreé !');
    }
}

