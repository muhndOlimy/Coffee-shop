<?php

use Configs\DBConfigs;
use Configs\Env;
use DI\Container;
use Managers\UserManager;
use Models\Entities\Country;
use Models\Entities\Drink;
use Models\Entities\DrinkCategory;
use Models\Entities\DrinkSize;
use Models\Entities\Feedback;
use Models\Entities\Order;
use Models\Entities\OrderItem;
use Models\Entities\State;
use Models\Entities\User;
use Models\Entities\UserFavouriteCategory;
use Repositories\Repository;
use Services\AuthService;
use Services\CategoryService;
use Services\CountryService;
use Services\DrinkService;
use Services\FeedbackService;
use Services\OrderService;


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
            UserManager::class => DI\autowire(),
            AuthService::class => function (Container $container) {
                $dbDataSource = $container->get(DBDataSource::class);
                return new AuthService(
                    $container->get(UserManager::class),
                    new Repository($dbDataSource, User::class),
                    new Repository($dbDataSource, State::class),
                    new Repository($dbDataSource, DrinkCategory::class),
                    new Repository($dbDataSource, UserFavouriteCategory::class),
                );
            },
            FeedbackService::class => function (Container $container) {
                $dbDataSource = $container->get(DBDataSource::class);
                return new FeedbackService(
                    new Repository($dbDataSource, Feedback::class),
                );
            },
            OrderService::class => function (Container $container) {
                $dbDataSource = $container->get(DBDataSource::class);
                return new OrderService(
                    $container->get(UserManager::class),
                    new Repository($dbDataSource, Order::class),
                    new Repository($dbDataSource, OrderItem::class),
                    new Repository($dbDataSource, Drink::class),
                    new Repository($dbDataSource, DrinkSize::class),
                );
            },
            DrinkService::class => function (Container $container) {
                $dbDataSource = $container->get(DBDataSource::class);
                return new DrinkService(
                    new Repository($dbDataSource, Drink::class),
                    new Repository($dbDataSource, DrinkSize::class),
                );
            },
            CategoryService::class => function (Container $container) {
                $dbDataSource = $container->get(DBDataSource::class);
                return new CategoryService(
                    new Repository($dbDataSource, DrinkCategory::class)
                );
            },
            CountryService::class => function (Container $container) {
                $dbDataSource = $container->get(DBDataSource::class);
                return new CountryService(
                    new Repository($dbDataSource, Country::class),
                    new Repository($dbDataSource, State::class)
                );
            },
        ]);
        $this->container = $builder->build();
    }
}
