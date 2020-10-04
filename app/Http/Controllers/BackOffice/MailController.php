<?php

namespace App\Http\Controllers\BackOffice;

use App\CategoryMail;
use App\Client;
use App\Digital;
use App\Http\Controllers\Controller;
use App\Http\Requests\MailRequest;
use App\Item;
use App\Mail;
use App\Mail\expeditionPriceMail;
use App\Mail\expeditionSentMail;
use App\Mail\newMailMail;
use App\Mail\newPackageMail;
use Illuminate\Support\Facades\Mail as Maill;
use App\User;
use App\Request as Req;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{


    public function list()
    {
        // add filter
        $this->authorize('mail-list', Mail::class);

        $mails = Mail::where('trash',false)->where('code','like',auth()->user()->id.'-%')->orderBy('created_at','desc')->get();

        return view('BackOffice.pages.mail.mail-list',[
            "mails" => $mails,
        ]);
    }

    public function trashList()
    {
        $this->authorize('mail-list', Mail::class);

        $mails = Mail::where('trash',true)->where('code','like',auth()->user()->id.'-%')->orderBy('created_at','desc')->get();

        return view('BackOffice.pages.mail.mail-trash',[
            "mails" => $mails,
        ]);
    }

    public function archiveList()
    {
        $this->authorize('mail-list', Mail::class);

        $mails = Mail::where('archive',true)->where('code','like',auth()->user()->id.'-%')->orderBy('created_at','desc')->get();

        return view('BackOffice.pages.mail.mail-archive',[
            "mails" => $mails,
        ]);
    }

    public function createForm()
    {
        $this->authorize('mail-create', Mail::class);

        $clients = User::role('client')->where('code','like',auth()->user()->id.'-%')->get();
        $categories = CategoryMail::all();

        return view('BackOffice.pages.mail.mail-create',[
            "clients" => $clients,
            "categories" => $categories,
        ]);

    }


    public function create(MailRequest $request)
    {

        $this->authorize('mail-create', Mail::class);

        $req = $request->all();
        $now = Carbon::now();
      //  $code = 'CT'.$now->format('dmy').'-'.$now->format('hms');
        $client = Client::findOrFail($request->user_id);
        if(!$client->code){
            return back()->with('error','Contrat de client pas encore signé');
        }
        $code_staff = explode('-',$client->code)[0];
        $code = $code_staff.'-'.$request->user_id.'-'.(Mail::last()->id+1);
        $req['code'] = $code;
        $mail = Mail::create($req);

        $mail->refresh();
        $user = User::find($request->user_id);
        if($request->post('type') == "mail" ){
            Maill::to($user->email)->send(new newMailMail($user));
        }else{
            Maill::to($user->email)->send(new newPackageMail($user));
        }

        // send email of new courrier
       return view('BackOffice.pages.mail.item-add',[
           "mail" => $mail
       ]);
    }

    public function updateForm(Mail $mail)
    {
        $this->authorize('mail-update', Mail::class);


        return view('BackOffice.pages.mail.mail-update',[
            'mail' => $mail,
        ]);
    }

    public function delete(Request $request)
    {
        $this->authorize('mail-create', Mail::class);

        $this->validate($request,[
            'id' => "required",
        ]);

        $mail = Mail::findOrFail($request->post('id'));
        $items = $mail->items;

        foreach ($items as $item){
            $digitals = $item->digitals;
            foreach ($digitals as $dig)
            {
                $dig->delete();
            }
            $item->delete();
        }
        $mail->delete();

        return back()->with('success','Votre courrier à été supprimé!');
    }

    public function itemsStore(Request $request)
    {
        $this->authorize('mail-create', Mail::class);

        $this->validate($request, [
            "mail" => "required",
        ]);

        $mail = json_decode($request->post('mail'),false);
        DB::transaction(function () use ($mail) {

            foreach ($mail->items as $item)
            {
                $itm = new Item();

                $itm->title = $item->title;
                $itm->description = $item->description;
                $itm->mail_id = $mail->id;

                $itm->save();

                $itm->refresh();

                foreach ($item->files as $file)
                {
                   // dd($file);
                    $dest = 'media';
                    $data = substr($file->src, strpos($file->src, ',') + 1);

                    $data = base64_decode($data);
                    $ext = explode('.',$file->uri);
                    $ext = end($ext);
                    //$elem = date('Ymdhis'). "." . $file->file->getClientOriginalExtension();
                    $elem = date('Ymdhis'). "." . $ext;
                   // $file->move($dest,$elem);
                    Storage::disk('uploads')->put($elem,$data);
                    $digital = new Digital();

                    $digital->item_id = $itm->id;
                    $digital->type = $file->type;
                    $digital->uri = $elem;
                    $digital->save();

                }
            }
        }, 1);


        return response()->json('ok',200);
    }

    public function show(Mail $mail)
    {
        $this->authorize('mail-view', Mail::class);


        return view('BackOffice.pages.mail.mail-show',[
            'mail' => $mail,
        ]);

    }

    public function trash(Request $request)
    {
        $this->authorize('mail-trash', Mail::class);

        $this->validate($request,[
           'id' => 'required'
        ]);

        $mail = Mail::findOrFail($request->post('id'));

        $mail->trash = true;

        $mail->save();

        return back()->with('success','Votre Courrier à été déplacé vers la courbielle!');
    }

    public function restore(Request $request)
    {
        $this->authorize('mail-trash', Mail::class);

        $this->validate($request,[
           'id' => 'required'
        ]);

        $mail = Mail::findOrFail($request->post('id'));

        $mail->trash = false;

        $mail->save();

        return back()->with('success','Votre Courrier à été restauré!');
    }

    public function archive(Request $request)
    {
        $this->authorize('mail-archive', Mail::class);

        $this->validate($request,[
            'id' => 'required'
        ]);

        $mail = Mail::findOrFail($request->post('id'));

        $mail->archive = true;

        $mail->save();

        return back()->with('success','Votre Courrier à été déplacé vers l"archive!');
    }

    public function restore_archive(Request $request)
    {
        $this->authorize('mail-trash', Mail::class);

        $this->validate($request,[
            'id' => 'required'
        ]);

        $mail = Mail::findOrFail($request->post('id'));

        $mail->archive = false;

        $mail->save();

        return back()->with('success','Votre Courrier à été restauré!');
    }


    public function requestList()
    {
        $this->authorize('request-list', Req::class);

        $requested = Req::where('status','requested')->get();
        $approved = Req::where('status','approved')->get();
        $executed= Req::where('status','executed')->get();
        $sent= Req::where('status','sent')->get();
        $canceled= Req::where('status','canceled')->get();

        return view('BackOffice.pages.mail.request',[
         "requested" => $requested,
         "approved" => $approved,
         "executed" => $executed,
         "sent" => $sent,
         "canceled" => $canceled
        ]);
    }

    public function cancelRequest(Req $request)
    {
        $this->authorize('request-update', Req::class);

        $request->status = 'canceled';
        $request->save();

        return back()->with('success', 'Votre demande à été annulée');
    }

    public function approveRequest(Request $request)
    {
        $this->authorize('request-update', Req::class);

        $this->validate($request,[
            'request' => 'required',
            'price' => 'required'
        ]);

        $req = Req::findOrFail($request->post('request'));
        $req->price = $request->post('price');
        $req->status = 'approved';
        $req->save();

        Maill::to($req->client->email)->send(new expeditionPriceMail($req->client, $req));

        return back()->with('success','Prix associé à la demande avec succès');

    }


    public function sentRequest(Request $request)
    {
        $this->authorize('request-update', Req::class);
        $this->validate($request,[
            'request' => 'required',
        ]);

        $req = Req::findOrFail($request->post('request'));

        $req->status = 'sent';
        $req->save();

        Maill::to($req->client->email)->send(new expeditionSentMail($req->client, $req));

        return back()->with('success','Demande marquée comme envoyée');
    }
}
