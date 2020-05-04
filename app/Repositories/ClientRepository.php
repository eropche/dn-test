<?php

namespace App\Repositories;

use App\Client;

class ClientRepository extends BaseRepository
{
    protected $model;

    public function __construct(Client $client)
    {
        $this->model = $client;
    }

    public function withInvoices()
    {
        return $this->model
            ->with('invoices')
            ->get();
    }
}
