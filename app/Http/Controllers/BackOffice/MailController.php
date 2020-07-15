<?php

namespace App\Http\Controllers\BackOffice;

use App\CategoryMail;
use App\Client;
use App\Digital;
use App\Http\Controllers\Controller;
use App\Http\Requests\MailRequest;
use App\Item;
use App\Mail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{


    public function list()
    {
        $this->authorize('mail-list', Mail::class);

        $mails = Mail::where('trash',false)->orderBy('created_at','desc')->get();

        return view('BackOffice.pages.mail.mail-list',[
            "mails" => $mails,
        ]);
    }

    public function trashList()
    {
        $this->authorize('mail-list', Mail::class);

        $mails = Mail::where('trash',true)->orderBy('created_at','desc')->get();

        return view('BackOffice.pages.mail.mail-trash',[
            "mails" => $mails,
        ]);
    }

    public function createForm()
    {
        $this->authorize('mail-create', Mail::class);

        $clients = User::role('client')->get();
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
        $code = 'CT'.$now->format('dmy').'-'.$now->format('hms');
        $req['code'] = $code;
        $mail = Mail::create($req);

        $mail->refresh();

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

        $mail->delete();

        return back()->with('success','Votre Courrier à etait supprimer!');
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

        return back()->with('success','Votre Courrier à deplacer vers le courbiel!');
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

        return back()->with('success','Votre Courrier à etait restaurer!');
    }
}
