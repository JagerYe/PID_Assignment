<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/order/OrderDAO_Interface.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/config.php";
class OrderDAO_PDO implements OrderDAO
{

    private $_strInsert = "INSERT INTO `orders`(`userID`, `orderDate`) VALUES (:userID,:orderDate);";
    private $_strUpdate = "UPDATE `orders` SET `userID`=:userID,`orderDate`=:orderDate WHERE `orderID`=:orderID;";
    private $_strDelete = "DELETE FROM `orders` WHERE `orderID`=:orderID;";
    private $_strCheckCommodityExist = "SELECT COUNT(*) FROM `orders` WHERE `orderID`=:orderID;";
    private $_strGetAll = "SELECT * FROM `orders`;";
    private $_strGetOne = "SELECT * FROM `orders` WHERE `orderID`=:orderID;";

    //新增
    public function insertOrder($userID, $orderDate)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strInsert);
            $sth->bindParam("userID", $userID);
            $sth->bindParam("orderDate", $orderDate);
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

    public function insertBlankOrder($userID, $orderDate)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strInsert);
            $sth->bindParam("userID", $userID);
            $sth->bindParam("orderDate", $orderDate);
            $sth->execute();
            $dbh->commit();
            $id=$dbh->lastInsertId();
            $sth = null;
        } catch (PDOException $err) {
            $dbh->rollBack();
            return false;
        }
        $dbh = null;
        return $id;
    }

    //新增 用物件
    public function insertOrderByObj($order)
    {
        return $this->insertOrder(
            $order->getUserID(),
            $order->getOrderDate()
        );
    }

    public function insertBlankOrderByObj($order)
    {
        return $this->insertBlankOrder(
            $order->getUserID(),
            $order->getOrderDate()
        );
    }

    //更新會員
    public function updateOrder($order)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strUpdate);
            $sth->bindParam("orderID", $order->getorderID());
            $sth->bindParam("userID", $order->getUserID());
            $sth->bindParam("orderDate", $order->getOrderDate());
            $sth->execute();
            $id=$dbh->lastInsertId();
            $dbh->commit();
            $sth = null;
        } catch (PDOException $err) {
            $dbh->rollBack();
            return false;
        }
        $dbh = null;
        return $id;
    }

    //之後需增加檢查是否有訂單
    public function deleteOrderByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strCheckCommodityExist);
            $sth->bindParam("orderID", $id);
            $sth->execute();
            $request = $sth->fetch(PDO::FETCH_NUM);
            if ($request['0'] <= 0) {
                throw new Exception("找不到");
            }
            $sth = $dbh->prepare($this->_strDelete);
            $sth->bindParam("orderID", $id);
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

    public function getAllOrders()
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->query($this->_strGetAll);
            $request = $sth->fetchAll(PDO::FETCH_ASSOC);
            foreach ($request as $item) {
                $orders[] = new Order(
                    $item['orderID'],
                    $item['userID'],
                    $item['orderDate']
                );
            }
            $sth = null;
        } catch (PDOException $err) {
            $dbh->rollBack();
            return false;
        }
        $dbh = null;
        return $orders;
    }
    public function getOneOrderByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->prepare($this->_strGetOne);
            $sth->bindParam("orderID", $id);
            $sth->execute();
            $request = $sth->fetch(PDO::FETCH_ASSOC);
            echo ($request);

            $order = new Order(
                $request['orderID'],
                $request['userID'],
                $request['orderDate']
            );

            $sth = null;
        } catch (PDOException $err) {
            return false;
        }
        $dbh = null;
        return $order;
    }

}
