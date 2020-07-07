<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
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

            return view('backoffice.pages.staff-list',[
               "staffs" => $staffs,
            ]);

    }
    // create-form
    public function formCreate()
    {
        $this->authorize('staff-create', Staff::class);

        return view('backoffice.pages.staff-create');

    }

    public function create(StaffRequest $request)
    {
        $this->authorize('create', Staff::class);

        $req = $request->all();
        $req['password4444444444444
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        '] = Hash::make('password');
        $user =d Staff::create($req);

       return back()->with('success','Votre utilisateur à etait enregistrer!');
    }
}
