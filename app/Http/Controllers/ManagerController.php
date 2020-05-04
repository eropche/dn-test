<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ManagerService;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    private $service;

    public function __construct(ManagerService $service)
    {
        $this->service = $service;
    }

    public function getList()
    {
        return response()->json(['managers' => $this->service->all()]);
    }

    public function getStatistic()
    {
        return response()->json(['managers' => $this->service->getRating()]);
    }
}
