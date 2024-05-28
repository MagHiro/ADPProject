<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Lot\StoreService;
use App\Services\Lot\UpdateService;
use App\Services\Lot\DeleteService;
use App\Services\Lot\LotServiceStrategy;

class LotServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->when(LotController::class)
            ->needs(LotServiceStrategy::class)
            ->give(function ($app) {
                $action = $app->request->route()->getActionMethod();
                switch ($action) {
                    case 'store':
                        return $app->make(StoreService::class);
                    case 'update':
                        return $app->make(UpdateService::class);
                    case 'destroy':
                        return $app->make(DeleteService::class);
                    default:
                        throw new \Exception("No strategy defined for action: $action");
                }
            });
    }
}
