<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Http\Requests\StaffUpdateRequest;
use App\Staff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{

    public function list()
    {
        $this->authorize('staff-list', Staff::class);

            $staffs = User::role('staff')->get();

            return view('BackOffice.pages.staff.staff-list',[
               "staffs" => $staffs,
            ]);

    }
    // create-form
    public function formCreate()
    {
        $this->authorize('staff-create', Staff::class);

        return view('BackOffice.pages.staff.staff-create');

    }

    public function create(StaffRequest $request)
    {
        $this->authorize('create', Staff::class);

        $req = $request->all();
        $req['password'] = Hash::make('password');
        $user = Staff::create($req);
        $user->refresh();
        $user = User::find($user->id);

        $user->assignRole('backoffice');
        $user->assignRole('staff');


       return back()->with('success','Votre membre de staff à été enregistré avec succés!');
    }


    public function FormUpdate(Staff $user)
    {


        return view('BackOffice.pages.staff.staff-update',[
            'staff' => $user
        ]);
    }

    public function update(StaffUpdateRequest $request)
    {
        $staff = Staff::findOrFail($request->post('id'));

        $staff->update($request->only(['name','last_name','email','phone','adresse']));

        return back()->with('success','Votre Membre de staff à été modifié avec succés!');
    }

    public function delete(Request $request)
    {

        $this->validate($request,[
            'id' => 'required',
        ]);

        $user = User::findOrFail($request->post('id'));
        $user->roles()->detach();
        $user->delete();

        return back()->with('success','Votre Membre de staff à été supprimé avec succés!');

    }
}
