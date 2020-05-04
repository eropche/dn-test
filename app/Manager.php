<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $guarded = ['id'];

    protected $table = 'managers';

    protected $fillable = ['name', 'surname', 'patronymic'];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
