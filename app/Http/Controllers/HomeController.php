<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;
use App\Order;
use App\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users_count = User::count();
        $orders_count = Order::count();
        $clients_count = Client::count();

        $users = User::latest()->paginate(5, ['*'], 'user');
        $orders = Order::latest()->paginate(5, ['*'], 'order');
        $clients = Client::latest()->paginate(5, ['*'], 'client');

        $roles = Role::withCount('users')->first();

        return view('main', compact(['users', 'users_count', 'orders', 'orders_count', 'clients_count', 'clients','roles']));
    }
}
