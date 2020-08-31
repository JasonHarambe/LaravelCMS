<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Order extends Model
{
    use SoftDeletes, Sortable;

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public $sortable = ['product_name', 'product_amount', 'product_unit_price'];
}
