<?php

namespace Order;

use Repository\OrderRepository;

class OrderManager
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function save(Order $order)
    {
        if ($order->getId()) {
            $this->orderRepository->update($order);
        } else {
            $this->orderRepository->insert($order);

            $order = $this->orderRepository->getByOrderId($order->getOrderID());
        }

        return $order;
    }
}