<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $guarded = ['id'];

    protected $table = 'clients';

    protected $fillable = ['name'];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
