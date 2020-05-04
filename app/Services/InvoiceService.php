<?php

namespace App\Services;

use App\Client;
use App\Invoice;
use App\Manager;
use App\Repositories\InvoiceRepository;
use App\Repositories\ProductRepository;

class InvoiceService extends BaseService
{
    public $repository;
    public $productRepository;

    public function __construct(InvoiceRepository $invoiceRepository, ProductRepository $productRepository)
    {
        $this->repository        = $invoiceRepository;
        $this->productRepository = $productRepository;
    }

    public function addNew(Manager $manager, Client $client, array $productIds)
    {
        $invoice = $this->repository->create([]);
        $invoice->client()->associate($client);
        $invoice->manager()->associate($manager);
        $invoice->save();
        $this->setProducts($invoice, $productIds);

        return $invoice;
    }

    public function payment(?Invoice $invoice)
    {
        if ($invoice) {
            return $this->repository->update($invoice->id, ['paid' => true, 'paymant_date' => new \DateTime()]);
        }
        return null;
    }

    public function getListWithFilters(int $managerId = 0, int $clientId = 0, ?bool $paid = null)
    {
        $invoices      = $this->repository->getWithFilters($managerId, $clientId, $paid, null, null);
        $invoicesArray = [];
        foreach ($invoices as $invoice) {
            $invoicesArray[$invoice->id]['number']  = $invoice->id;
            $invoicesArray[$invoice->id]['client']  = $invoice->client->name;
            $invoicesArray[$invoice->id]['paid']    = $invoice->paid;
            $invoicesArray[$invoice->id]['price']   = $this->getInvoicePrice($invoice);
            $invoicesArray[$invoice->id]['manager'] =
                $invoice->manager->surname.' '.$invoice->manager->name.' '.$invoice->manager->patronymic;
        }

        return $invoicesArray;
    }

    public function getStatisticIncome(?\DateTime $startPaymantDate, ?\DateTime $endPaymantDate)
    {
        $startPaymantDate = $startPaymantDate === null ? null : new \DateTime($startPaymantDate);
        $endPaymantDate   = $endPaymantDate === null ? null : new \DateTime($endPaymantDate);
        $invoices = $this->repository->getWithFilters(0,0,null, $startPaymantDate, $endPaymantDate);
        $result   = [];
        foreach ($invoices as $paidInvoice) {
            if (!$paidInvoice->paid) {
                continue;
            }
            $paymantDate = (new \DateTime($paidInvoice->paymant_date))->format('Y-m-d');
            $result[$paymantDate]['paymantDate'] = $paymantDate;
            isset($result[$paymantDate]['paymantCount']) ?
                $result[$paymantDate]['paymantCount'] += 1 : $result[$paymantDate]['paymantCount'] = 0;
            isset($result[$paymantDate]['income']) ?
                $result[$paymantDate]['income'] += $this->getInvoicePrice($paidInvoice) : $result[$paymantDate]['income'] = 0;
            if (!isset($result[$paymantDate]['invoicesCount'])) {
                $result[$paymantDate]['invoicesCount'] = $this->repository->countByDate($paymantDate);
            }
            if (isset($result[$paymantDate]['invoicesCount']) && $result[$paymantDate]['invoicesCount'] > 0) {
                $result[$paymantDate]['conversion'] =
                    $result[$paymantDate]['paymantCount'] * 100 / $result[$paymantDate]['invoicesCount'];
            } else {
                $result[$paymantDate]['conversion'] = 0;
            }
        }

        return $result;
    }

    private function setProducts(Invoice $invoice, array $productIds)
    {
        $invoice->products()->detach();
        foreach ($productIds as $productId) {
            $product = $this->productRepository->find($productId);
            $invoice->products()->save($product);
        }
    }

    private function getInvoicePrice(Invoice $invoice)
    {
        $price = 0;
        foreach ($invoice->products as $product) {
            $price += $product->price;
        }

        return $price;
    }
}
