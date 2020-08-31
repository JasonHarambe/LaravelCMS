<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function createUser()
    {
        return view('users.create');
    }

    public function storeUser(Request $request)
    {
        $user = new User;

        $this->validate($request, [
            'user_name' => 'required',
            'user_email' => 'required',
            'user_password' => 'required',
        ]);

        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->password = Hash::make($request->user_password);

        $user->save();

        return redirect()->route('users.all');
    }
    
    public function editUser($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function updateUser($id, Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required',
            'user_email' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        
        $user->save();

        return back()->with('message', 'Updated');
    }

    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $user->blocked_at = Carbon::now();

        $user->save();
        
        return back()->with('message','User Deactivated');

    }

    public function unblockUser($id)
    {
        $user = User::findOrFail($id);
        $user->blocked_at = null;

        $user->save();
        
        return back()->with('message', 'User Activated');

    }

    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);

        $role = Role::where('name', 'admin')->first();
        $user->assignRole($role);

        return back()->with('message', 'Admin Role Attached');

    }

    public function unmakeAdmin($id)
    {
        $user = User::findOrFail($id);

        $role = Role::where('name', 'admin')->first();
        $user->removeRole($role);

        return back()->with('message', 'Admin Role Detached');

    }

    public function showAll()
    {
        $users = User::latest()->sortable()->paginate(30);

        return view('users.all', compact('users'));
    }
}
