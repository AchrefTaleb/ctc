<?php

namespace App\Http\Controllers\BackOffice;

use App\CategoryMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryMailRequest;
use Illuminate\Http\Request;

class CategoryMailController extends Controller
{

    public function list()
    {
        $this->authorize('categorymail-list', CategoryMail::class);

        $categories = CategoryMail::all();

        return view('BackOffice.pages.category-mail.index',[
            "categories" => $categories,
        ]);

    }

    public function create(CategoryMailRequest $request)
    {
        $this->authorize('categorymail-create', CategoryMail::class);

        $category = CategoryMail::create($request->all());

        return back()->with('success','Votre catégorie à été enregistrée!');


    }

    public function update(CategoryMailRequest $request)
    {
        $this->authorize('categorymail-update', CategoryMail::class);

        $cat = CategoryMail::findOrFail($request->post('id'));
        $cat->name = $request->post(('name'));


        $cat->save();

        return back()->with('success','Votre catégorie à été modifiée!');


    }


    public function delete(Request $request)
    {
        $this->authorize('categorymail-delete', CategoryMail::class);
        $this->validate($request,[
            "id" => 'required',
        ]);

        $cat = CategoryMail::findOrFail($request->post('id'));

        $cat->delete();

        return back()->with('success','Votre catégorie à été supprimée!');
    }
}
