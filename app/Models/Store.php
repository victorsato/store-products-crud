<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'email'];

    public function products()
    {
        return $this->hasMany(Product::class, 'stores_id', 'id')->select(['id', 'name', 'price', 'active']);
    }
}
