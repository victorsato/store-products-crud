<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'price', 'active', 'stores_id'];

    public function getPriceAttribute($value)
    {
        $mask = str_replace(',', '', $value);
        $mask = str_replace('.', ',', $mask);

        return 'R$ '.$mask;
    }
}
