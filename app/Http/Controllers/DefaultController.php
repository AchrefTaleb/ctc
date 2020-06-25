<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
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
        return "done";
    }
}
