<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller
{
    public function profile( /* Request $request */)
    {
        $user = auth()->user();

        return view('BackOffice.pages.settings.profile',[
            "me" => $user,
        ]);
    }

    public function password(Request $request)
    {
        $this->validate($request,[
           'old_password' => 'required',
           'password' => 'required|confirmed'
        ]);

        $user = auth()->user();
        $oldpass = $user->getAuthPassword();

    //    if($oldpass == Hash::make($request->post('old_password'))){
          if(Hash::check($request->post('old_password'),$user->getAuthPassword())){
            $request->user()->fill([
                'password' => Hash::make($request->post('password'))
            ])->save();

            return back()->with('success','Votre mot de passe a été changé');
        }

        throw ValidationException::withMessages(['old_password' => 'Mot de passe incorrect']);


    }


}
