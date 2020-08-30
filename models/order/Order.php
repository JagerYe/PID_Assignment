<?php
class Order
{
    private $_orderID;
    private $_userID;
    private $_orderDate;

    public function __construct($orderID, $userID, $orderDate)
    {
        $this->setOrderID($orderID);
        $this->setUserID($userID);
        $this->setOrderDate($orderDate);
    }

    public function getorderID()
    {
        return $this->_orderID;
    }
    public function setorderID($orderID)
    {
        if ($orderID == null || $orderID == "") {
            throw new Exception("ID格式錯誤");
        }
        $this->_orderID = $orderID;
        return true;
    }

    public function getUserID()
    {
        return $this->_userID;
    }
    public function setUserID($userID)
    {
        if ($userID == null || $userID == "") {
            throw new Exception("名稱格式錯誤");
        }
        $this->_userID = $userID;
        return true;
    }

    public function getOrderDate()
    {
        return $this->_orderDate;
    }
    public function setOrderDate($orderDate)
    {
        if ($orderDate == null || $orderDate == "") {
            throw new Exception("價格格式錯誤");
        }
        $this->_orderDate = $orderDate;
        return true;
    }

    public function showData()
    {
        echo ("<br>");
        echo ("ID:" . $this->getorderID() . "<br>");
        echo ("Name:" . $this->getUserID() . "<br>");
        echo ("Price:" . $this->getOrderDate() . "<br>");
    }
}
