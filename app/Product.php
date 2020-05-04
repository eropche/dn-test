<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $guarded = ['id'];

    protected $table = 'products';

    protected $fillable = ['name', 'price'];

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }
}
