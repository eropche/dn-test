<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use App\Services\InvoiceService;
use App\Services\ManagerService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private $service;
    private $managerService;
    private $clientsService;
    private $productsService;

    public function __construct(
        InvoiceService $service,
        ManagerService $managerService,
        ClientService $clientsService,
        ProductService $productsService
    )
    {
        $this->service         = $service;
        $this->managerService  = $managerService;
        $this->clientsService  = $clientsService;
        $this->productsService = $productsService;
    }

    public function getList(Request $request)
    {
        $managerId = (int) $request->get('managerId', 0);
        $clientId  = (int) $request->get('clientId', 0);
        $paid      = $request->get('paid', null) === null ? null : (bool) $request->get('paid');
        $list      = $this->service->getListWithFilters($managerId, $clientId, $paid);

        return response()->json(['list' => $list]);
    }

    public function incomeStatistic(Request $request)
    {
        $startPaymantDate = $request->get('startPaymantDate', null);
        $endPaymantDate   = $request->get('endPaymantDate', null);
        $statistic        = $this->service->getStatisticIncome($startPaymantDate, $endPaymantDate);

        return response()->json(['statistic' => $statistic]);
    }

    public function create()
    {
        $manager    = $this->managerService->find(random_int(1, 3));
        $client     = $this->clientsService->find(random_int(1, 6));
        $productIds = [];
        for ($i = 1; $i <= random_int(1, 7); $i++) {
            $productIds[] = $this->productsService->find(random_int(1, 7))->id;
        }
        $productIds = array_unique($productIds);
        $this->service->addNew($manager, $client, $productIds);

        return response()->json(['result' => true]);
    }

    public function payment()
    {
        $clients = $this->clientsService->withInvoices();
        foreach ($clients as $client) {
            $this->service->payment($client->invoices()->first());
        }

        return response()->json(['result' => true]);
    }
}
