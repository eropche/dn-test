<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $service;

    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    public function getList()
    {
        return response()->json(['clients' => $this->service->all()]);
    }
}
