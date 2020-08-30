<?php
interface OrderDetailDAO
{
    public function insertOrderDetail($orderID, $commodityID, $price, $quantity);
    public function updateOrderDetail($orderDetail, $oldOrderID, $oldCommodityID);
    public function deleteOrderDetailByID($orderID, $commodityID);
    public function getOneOrderDetailByID($orderID, $commodityID);
    public function getAllOrderDetails();
}
