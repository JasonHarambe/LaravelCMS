<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Client;
use DB;
use PDF;

class OrderController extends Controller
{
    
    public function showAll()
    {
        $orders = Order::withTrashed()->sortable()->orderBy('created_at', 'desc')->paginate(30);
        return view('orders.all', compact('orders'));
    }

    public function createOrder()
    {
        $clients = Client::orderBy('company_name')->get();

        return view('orders.create', compact('clients'));
    }

    public function showOrder($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.show', compact('order'));
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();
        
        return redirect()->route('orders.all');
    }

    public function editOrder($id)
    {   
        $order = Order::findOrFail($id);
        $clients = Client::orderBy('company_name')->get();

        return view('orders.edit', compact('order', 'clients'));
    }

    public function updateOrder($id, Request $request)
    {
        $order = Order::findOrFail($id);
        $client = Client::where('company_name', $request->client_company)->first();

        $order->client_id = $client->id;
        $order->product_id = $request->product_id;
        $order->product_name = $request->product_name;
        $order->product_amount = $request->product_amount;
        $order->product_unit_price = $request->product_unit_price;

        $order->save();

        return back()->with('message','Order Updated');
    }

    public function storeOrder(Request $request)
    {
        $order = new Order;

        $this->validate($request, [
            'product_id' => 'required',
            'product_name' => 'required',
            'product_amount' => 'required',
            'product_unit_price' => 'required',
        ]);

        $name = $request->client_name;
        $client = DB::table('clients')->where('company_name', $name)->first();
        $id = $client->id;

        $order->client_id = $id;
        $order->product_id = $request->product_id;
        $order->product_name = $request->product_name;
        $order->product_amount = $request->product_amount;
        $order->product_unit_price = $request->product_unit_price;

        $order->save();

        return redirect()->route('orders.all');
    }

    public function restoreOrder($id)
    {
        $order = Order::withTrashed()->find($id)->restore();

        return back();

    }

    public function createPDF($id)
    {
        $order = Order::findOrFail($id);
        // $order->printed = 'yes';
        // $order->save();

        view()->share('order', $order);
        $pdf = PDF::loadView('/orders/order_view', $order);

        return $pdf->download('order_'.$order->id.'.pdf');
    }

}
