<?php

namespace App\Services;

use App\Repositories\ClientRepository;

class ClientService extends BaseService
{
    public $repository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->repository = $clientRepository;
    }

    public function withInvoices()
    {
        return $this->repository->withInvoices();
    }
}
