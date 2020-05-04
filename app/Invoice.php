<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $guarded = ['id'];

    protected $table = 'invoices';

    protected $fillable = ['paid', 'paymant_date'];

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
