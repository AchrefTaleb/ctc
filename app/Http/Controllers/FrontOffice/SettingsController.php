<?php

namespace App\Http\Controllers\FrontOffice;

use App\Client;
use App\Helpers\stripeHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientUpdateRequest;
use App\Subscription;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller
{
    public function profile( /* Request $request */)
    {
        $user = auth()->user();
        $ends = false;
        $stripeHelper = new stripeHelper();
        $sub = Subscription::where('user_id',auth()->user()->id)->first();


        if($sub)
        {
            $res = $stripeHelper->getSubscription($sub->stripe_id);
            if(!($res instanceof Exception))
            {
                $ends = $res->current_period_end;
            }


        }

        return view('FrontOffice.pages.settings.profile',[
            "me" => $user,
            "ends" => $ends,
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


    public function profileUpdate(ClientUpdateRequest $request)
    {
        $staff = Client::findOrFail($request->post('id'));


        $staff->update($request->only(['name','last_name','email','phone','adresse']));

        return back()->with('success','Votre client à été modifié!');
    }


}
