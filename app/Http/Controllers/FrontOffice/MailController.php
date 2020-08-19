<?php

namespace App\Http\Controllers\FrontOffice;

use App\Client;
use App\Helpers\stripeHelper;
use App\Http\Controllers\Controller;
use App\Mail;
use App\Request as Req;
use Exception;
use Illuminate\Http\Request;

class MailController extends Controller
{


    public function list()
    {
        $this->authorize('mail-list', Mail::class);

        $mails = Client::find(auth()->user()->id)->mails()->where('trash',false)->orderBy('created_at','desc')->get();

        return view('FrontOffice.pages.mail.mail-list',[
            "mails" => $mails,
        ]);
    }


    public function show(Mail $mail)
    {


        return view('FrontOffice.pages.mail.mail-show',[
            'mail' => $mail,
        ]);

    }

    public function trash(Request $request)
    {


        $this->validate($request,[
            'id' => 'required'
        ]);

        $mail = Mail::findOrFail($request->post('id'));

        $mail->trash = true;

        $mail->save();

        return back()->with('success','Votre Courrier à deplacer vers le courbiel!');
    }

    public function trashList()
    {

        $mails = Client::find(auth()->user()->id)->mails()->where('trash',true)->orderBy('created_at','desc')->get();
       // $mails = Mail::where('trash',true)->orderBy('created_at','desc')->get();

        return view('FrontOffice.pages.mail.mail-trash',[
            "mails" => $mails,
        ]);
    }

    public function restore(Request $request)
    {


        $this->validate($request,[
            'id' => 'required'
        ]);

        $mail = Mail::findOrFail($request->post('id'));

        $mail->trash = false;

        $mail->save();

        return back()->with('success','Votre Courrier à etait restaurer!');
    }

    public function archive(Request $request)
    {


        $this->validate($request,[
            'id' => 'required'
        ]);

        $mail = Mail::findOrFail($request->post('id'));

        $mail->archive = true;

        $mail->save();

        return back()->with('success','Votre Courrier à deplacer vers l"archive!');
    }

    public function archiveList()
    {

        $mails = Client::find(auth()->user()->id)->mails()->where('archive',true)->orderBy('created_at','desc')->get();
        // $mails = Mail::where('trash',true)->orderBy('created_at','desc')->get();

        return view('FrontOffice.pages.mail.mail-archive',[
            "mails" => $mails,
        ]);
    }

    public function restore_archive(Request $request)
    {


        $this->validate($request,[
            'id' => 'required'
        ]);

        $mail = Mail::findOrFail($request->post('id'));

        $mail->archive = false;

        $mail->save();

        return back()->with('success','Votre Courrier à etait restaurer!');
    }


    public function requestList()
    {
        $requests = Req::where('user_id',auth()->user()->id)->get();


        return view('FrontOffice.pages.mail.request',[

            'requests' => $requests,
        ]);
    }
    public function requesting(Request $request)
    {
        $this->validate($request,[
            'mail' => 'required',
            'adresse' => 'required'
        ]);

        $mail = Mail::findOrFail($request->post('mail'));

        $req= new Req();

        $req->user_id  = auth()->user()->id;
        $req->mail_id = $mail->id;
        $req->adresse = $request->post('adresse');
        $req->save();

        return back()->with('success','Votre demande a etait sauvgarder!');

    }

    public function cancelRequest(Req $request)
    {

        $request->status = 'canceled';
        $request->save();

        return back()->with('success', 'votre demande à etait annuler');
    }

    public function requestCheckout(Req $request)
    {

        return view('FrontOffice.pages.mail.checkout',[
            "request" => $request,
        ]);
    }

    public function requestPayement(Request $request)
    {
        $this->validate($request,[
            'request' => 'required',
            'stripeToken' => "required",
        ]);

        $req = Req::findOrFail($request->post('request'));
        $user = auth()->user();

        $stripeHelper = new stripeHelper();

        $charge_id =$stripeHelper->charge($user, $req,$request->post('stripeToken'));

        if(!($charge_id instanceof Exception))
        {
            $req->stripe_charge_id = $charge_id->id;
            $req->invoice = $charge_id->receipt_url;
            $req->status = 'executed';
            $req->save();
        }

        return redirect()->route('frontoffice.mail.request.list')->with('success','Votre paiemenr de demande d"envoi a etait valider');
    }
}