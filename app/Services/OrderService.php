<?php

declare(strict_types=1);

namespace Services;

use Managers\UserManager;
use Models\Entities\Drink;
use Models\Entities\DrinkSize;
use Models\Entities\Order;
use Models\Entities\OrderItem;
use Models\Requests\OrderRequest;
use Repositories\Repository;

readonly class OrderService
{
    /**
     * @param UserManager $userManager
     * @param Repository<Order> $orderRepo
     * @param Repository<OrderItem> $itemRepo
     * @param Repository<Drink> $drinkRepo
     * @param Repository<DrinkSize> $sizeRepo
     */
    public function __construct(private UserManager $userManager,
                                private Repository  $orderRepo,
                                private Repository  $itemRepo,
                                private Repository  $drinkRepo,
                                private Repository  $sizeRepo)
    {
    }

    public function submit(OrderRequest $request): Order
    {
        $this->userManager->ensureAuthentication();
        $drinkSize = $this->sizeRepo->findById(['drink_id' => $request->drinkId, 'size' => $request->size]);
        $user = $this->userManager->getUser();

        $orderItem = new OrderItem();
        $orderItem->drinkId = $drinkSize->drinkId;
        $orderItem->size = $drinkSize->size;
        $orderItem->quantity = $request->quantity;
        $orderItem->price = $drinkSize->pricePromo ?? $drinkSize->price;

        $order = new Order();
        $order->userId = $user->id;
        $order->totalPrice = $orderItem->quantity * $orderItem->price;
        $order->id = $this->orderRepo->insert([$order]);

        $orderItem->orderId = $order->id;
        $orderItem->id = $this->itemRepo->insert([$orderItem]);

        return $order;
    }
}
