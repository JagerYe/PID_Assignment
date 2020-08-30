<?php
interface OrderDAO
{
    public function insertOrder($userID, $orderDate);
    public function insertBlankOrder($userID, $orderDate);
    public function updateOrder($order);
    public function deleteOrderByID($id);
    public function getOneOrderByID($id);
    public function getAllOrders();
}
