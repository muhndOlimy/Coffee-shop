<?php

use Configs\DBConfigs;
use Configs\Env;
use DI\Container;
use Models\Entities\DrinkCategory;
use Models\Entities\State;
use Models\Entities\User;
use Models\Entities\UserFavouriteCategory;
use Repositories\Repository;
use Services\AuthService;


class DI
{
    public Container $container;

    public function __construct()
    {
        Env::loadEnvFile();
        $builder = new DI\ContainerBuilder();
        $builder->addDefinitions([
            DBConfigs::class => DI\factory([DBConfigs::class, 'fromEnv']),
            DBDataSource::class => DI\autowire()->method('connect'),
            AuthService::class => function (Container $container) {
                $dbDataSource = $container->get(DBDataSource::class);
                return new AuthService(
                    new Repository($dbDataSource, User::class),
                    new Repository($dbDataSource, State::class),
                    new Repository($dbDataSource, DrinkCategory::class),
                    new Repository($dbDataSource, UserFavouriteCategory::class),
                );
            }
        ]);
        $this->container = $builder->build();
    }
}
