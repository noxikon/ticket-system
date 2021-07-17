<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// modal's
use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->save();

        if(!$user){
            return "Error, the user can't created.";
        }else{
            return "The user has been created!";
        }
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->save();

        if(!$user){
            return "Error, can't update the user.";
        }else{
            return "The user has been updatet!";
        }
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        if(!$user){
            return "Error, the user can't get deletet.";
        }else{
            return "The user is deletet.";
        }
    }
}
