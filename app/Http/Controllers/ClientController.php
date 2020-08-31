<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    public function createClient()
    {
        return view('clients.create');
    }

    public function storeClient(Request $request)
    {

        $this->validate($request, [
            'company_name' => 'required',
            'company_address' => 'required',
            'company_reg' => 'required',
            'company_contact' => 'required',
        ]);

        $client = new Client;
        $client->company_name = $request->company_name;
        $client->company_address = $request->company_address;
        $client->company_reg = $request->company_reg;
        $client->company_contact = $request->company_contact;

        $client->save();
        
        return redirect()->route('clients.all');
    }   

    public function editClient($id)
    {
        $client = Client::findOrFail($id);

        return view('clients.edit', compact('client'));
    }

    public function updateClient($id, Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'company_address' => 'required',
            'company_contact' => 'required',
            'company_reg' => 'required',
        ]);

        $client = Client::findOrFail($id);
        $client->company_name = $request->company_name;
        $client->company_address = $request->company_address;
        $client->company_contact = $request->company_contact;
        $client->company_reg = $request->company_reg;

        $client->save();

        return back()->with('message', 'Details Updated');
    }

    // public function blockUser($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->blocked_at = Carbon::now();

    //     $user->save();
        
    //     return back()->with('message','User Deactivated');

    // }

    // public function unblockUser($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->blocked_at = null;

    //     $user->save();
        
    //     return back()->with('message', 'User Activated');

    // }

    // public function makeAdmin($id)
    // {
    //     $user = User::findOrFail($id);

    //     $role = Role::where('name', 'admin')->first();
    //     $user->assignRole($role);

    //     return back()->with('message', 'User made Admin');

    // }

    // public function unmakeAdmin($id)
    // {
    //     $user = User::findOrFail($id);

    //     $role = Role::where('name', 'admin')->first();
    //     $user->removeRole($role);

    //     return back()->with('message', 'Admin Role Detached');

    // }

    public function showAll()
    {
        $clients = Client::latest()->sortable()->paginate(30);

        return view('clients.all', compact('clients'));
    }

    public function deleteClient($id)
    {
        $order = Client::findOrFail($id);

        $order->delete();
        
        return redirect()->route('clients.all');
    }
}
