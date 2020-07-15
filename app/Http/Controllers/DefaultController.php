<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DefaultController extends Controller
{
    public function roles()
    {
        /*  $role = Role::create(['name' => 'backoffice']);
       /*   $role = Role::create(['name' => 'staff']);
           $role = Role::create(['name' => 'client']);

      $admin = User::find(1);

      $admin->assignRole('backoffice');

      $admin->refresh();

      return response()->json($admin->getRoleNames(),200);
        //$permission = Permission::create(['name' => 'edit articles']);
        */

        $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken(auth()->user());
        $link = \route('password.reset',['token',$token]);
        dd($link);

        return "done";
    }
}
