<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'product_name', 'amount', 'status'];

    public function users() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
