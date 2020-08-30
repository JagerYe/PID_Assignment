<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/orderDetail/OrderDetailDAO_Interface.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/config.php";
class OrderDetailDAO_PDO implements OrderDetailDAO
{

    private $_strInsert = "INSERT INTO `orderdetails`(`orderID`, `commodityID`, `orderCommodityPrice`, `orderCommodityQuantity`) VALUES (:orderID,:commodityID,:orderCommodityPrice,:orderCommodityQuantity);";
    private $_strUpdate = "UPDATE `orderdetails` SET `orderID`=:orderID,`commodityID`=:commodityID,`orderCommodityPrice`=:orderCommodityPrice,`orderCommodityQuantity`=:orderCommodityQuantity WHERE `orderID`=:oldOrderID and `commodityID`=:oldCommodityID;";
    private $_strDelete = "DELETE FROM `orderdetails` WHERE `orderID`=:orderID and `commodityID`=:commodityID;";
    private $_strCheckOrderDetailExist = "SELECT COUNT(*) FROM `orderdetails` WHERE `orderID`=:orderID and `commodityID`=:commodityID;";
    private $_strGetAll = "SELECT * FROM `orderdetails`;";
    private $_strGetOne = "SELECT * FROM `orderdetails` WHERE `orderID`=:orderID and `commodityID`=:commodityID;";

    //新增
    public function insertOrderDetail($orderID, $commodityID, $price, $quantity)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strInsert);
            $sth->bindParam("orderID", $orderID);
            $sth->bindParam("commodityID", $commodityID);
            $sth->bindParam("orderCommodityPrice", $price);
            $sth->bindParam("orderCommodityQuantity", $quantity);
            $sth->execute();
            $dbh->commit();
            $sth = null;
        } catch (PDOException $err) {
            $dbh->rollBack();
            return false;
        }
        $dbh = null;
        return true;
    }

    //新增會員 用物件
    public function insertOrderDetailByObj($orderDetail)
    {
        return $this->insertOrderDetail(
            $orderDetail->getOrderID(),
            $orderDetail->getCommodityID(),
            $orderDetail->getOrderCommodityPrice(),
            $orderDetail->getOrderCommodityQuantity()
        );
    }

    //更新
    public function updateOrderDetail($orderDetail, $oldOrderID, $oldCommodityID)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strUpdate);
            $sth->bindParam("orderID", $orderDetail->getOrderID());
            $sth->bindParam("commodityID", $orderDetail->getCommodityID());
            $sth->bindParam("orderCommodityPrice", $orderDetail->getOrderCommodityPrice());
            $sth->bindParam("orderCommodityQuantity", $orderDetail->getOrderCommodityQuantity());
            $sth->bindParam("oldOrderID", $oldOrderID);
            $sth->bindParam("oldCommodityID", $oldCommodityID);
            $sth->execute();
            $dbh->commit();
            $sth = null;
        } catch (PDOException $err) {
            $dbh->rollBack();
            return false;
        }
        $dbh = null;
        return true;
    }

    //之後需增加檢查是否有訂單
    public function deleteOrderDetailByID($orderID, $commodityID)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strCheckOrderDetailExist);
            $sth->bindParam("orderID", $orderID);
            $sth->bindParam("commodityID", $commodityID);
            $sth->execute();
            $request = $sth->fetch(PDO::FETCH_NUM);
            if ($request['0'] <= 0) {
                throw new Exception("找不到");
            }
            $sth = $dbh->prepare($this->_strDelete);
            $sth->bindParam("orderID", $orderID);
            $sth->bindParam("commodityID", $commodityID);
            $sth->execute();
            $dbh->commit();
            $sth = null;
        } catch (Exception $err) {
            $dbh->rollBack();
            return false;
        }
        $dbh = null;
        return true;
    }

    public function getAllOrderDetails()
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->query($this->_strGetAll);
            $request = $sth->fetchAll(PDO::FETCH_ASSOC);
            foreach ($request as $item) {
                $orderDetails[] = new OrderDetail(
                    $item['orderID'],
                    $item['commodityID'],
                    $item['orderCommodityPrice'],
                    $item['orderCommodityQuantity']
                );
            }
            $sth = null;
        } catch (PDOException $err) {
            $dbh->rollBack();
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $orderDetails;
    }
    public function getOneOrderDetailByID($orderID, $commodityID)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->prepare($this->_strGetOne);
            $sth->bindParam("orderID", $orderID);
            $sth->bindParam("commodityID", $commodityID);
            $sth->execute();
            $request = $sth->fetch(PDO::FETCH_ASSOC);
            echo ($request);

            $orderDetail = new OrderDetail(
                $request['orderID'],
                $request['commodityID'],
                $request['orderCommodityPrice'],
                $request['orderCommodityQuantity']
            );

            $sth = null;
        } catch (PDOException $err) {
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $orderDetail;
    }
}
