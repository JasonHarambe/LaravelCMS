<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    use Sortable;

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public $sortable = ['company_name', 'company_address', 'company_contact', 'company_reg'];
}
