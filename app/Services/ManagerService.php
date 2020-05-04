<?php

namespace App\Services;

use App\Manager;
use App\Repositories\ManagerRepository;

class ManagerService extends BaseService
{
    public $repository;

    public function __construct(ManagerRepository $managerRepository)
    {
        $this->repository = $managerRepository;
    }

    public function getRating()
    {
        $managers      = $this->repository->all();
        $managersArray = [];
        foreach ($managers as $manager) {
            $invocesCount = $manager->invoices()->count();
            $paymentCount = $manager->invoices()->where('paid', true)->count();
            if ($invocesCount > 0) {
                $conversion = ($paymentCount * 100) / $invocesCount;
            } else {
                $conversion = 0;
            }
            $managersArray[$manager->id]['fullName']     = $manager->surname.' '.$manager->name.' '.$manager->patronymic;
            $managersArray[$manager->id]['invocesCount'] = $invocesCount;
            $managersArray[$manager->id]['paymantCount'] = $paymentCount;
            $managersArray[$manager->id]['conversion']   = $conversion;
        }

        return $managersArray;
    }
}
