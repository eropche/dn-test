<?php

namespace App\Repositories;

use App\Invoice;

class InvoiceRepository extends BaseRepository
{
    protected $model;

    public function __construct(Invoice $invoice)
    {
        $this->model = $invoice;
    }

    public function countByDate($date)
    {
        return $this->model
            ->whereDate('created_at', $date)
            ->get()
            ->count();
    }

    public function getWithFilters(
        int $managerId,
        int $clientId,
        ?bool $paid,
        ?\DateTime $startPaymantDate,
        ?\DateTime $endPaymantDate
    )
    {
        if ($managerId > 0) {
            $this->model->andWhere('manager_id', $managerId);
        }
        if ($clientId > 0) {
            $this->model->andWhere('client_id', $clientId);
        }
        if ($paid !== null) {
            $this->model->andWhere('paid', $paid);
        }
        if ($startPaymantDate !== null) {
            $this->model->andWhere('paymant_date', '>=', $startPaymantDate);
        }
        if ($endPaymantDate !== null) {
            $this->model->andWhere('paymant_date', '<=', $endPaymantDate);
        }

        return $this->model
            ->orderBy($this->sortBy, $this->sortOrder)
            ->get();
    }
}
