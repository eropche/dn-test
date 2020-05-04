<?php

namespace App\Repositories;

use App\Manager;

class ManagerRepository extends BaseRepository
{
    protected $model;

    public function __construct(Manager $manager)
    {
        $this->model = $manager;
    }
}
