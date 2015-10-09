<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Group;
use App\User;

class GroupUserController extends Controller {

    public function index($id) {
        $group = Group::findOrFail($id);
        $users = User::whereNotIn('id', $group->users()->get()->map(function ($item, $key) {return $item->id;}))->get();
        return view('groupUsers', compact('group', 'users'));
    }


    public function add($id, Request $request) {
        $group = Group::findOrFail($id);
        $user = User::findOrFail($request->input('userId'));
        $group->users()->attach($user,['role' => 'member']);
        $group->save();
        return redirect()->back();
    }
    

    public function remove($id, Request $request){
        $group = Group::findOrFail($id);
        $user = User::findOrFail($request->input('userId'));
        $group->users()->detach($user);
        $group->save();
        return redirect()->back();
    }

}
