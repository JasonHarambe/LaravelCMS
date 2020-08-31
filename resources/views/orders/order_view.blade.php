<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Print Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <div class="card">
      <div class="card-body">
      <h3 class="bg-info">Order Detail</h3>
        <p>Order ID: {{$order->id}}</p>
        <p>Client ID: {{$order->client_id}}</p>
        <p>Product ID: {{$order->product_id}}</p>
        <p>Product Name: {{$order->product_name}}</p>
        <p>Product Amount: {{$order->product_amount}}</p>
        <p>Product Unit Price: {{$order->product_unit_price}}</p>
        <p>Total: {{number_format($order->product_unit_price * $order->product_amount, 2)}}</p>
        <p>Created At: {{$order->created_at}}</p>
      <h3 class="bg-info">Client Detail</h3>
        <p>Client Name: {{$order->client->company_name}}</p>
        <p>Client Address: {{$order->client->company_address}}</p>
        <p>Client Contact Number: {{$order->client->company_contact}}</p>
        <p>Client Registration ID: {{$order->client->company_reg}}</p>
      </div>
    </div>
  </body>
</html>