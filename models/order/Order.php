<?php
class Order implements \JsonSerializable
{
    private $_orderID;
    private $_userID;
    private $_orderDate;
    private $_attention;

    public function __construct($orderID, $userID, $orderDate, $attention = false)
    {
        $this->setOrderID($orderID);
        $this->setUserID($userID);
        $this->setOrderDate($orderDate);
        $this->setOrderAttention($attention);
    }

    public function getOrderAttention()
    {
        return $this->_attention;
    }
    public function setOrderAttention($attention)
    {
        if (!is_bool($attention)) {
            throw new Exception("ID格式錯誤");
        }
        $this->_attention = $attention;
        return true;
    }

    public function getOrderID()
    {
        return $this->_orderID;
    }
    public function setOrderID($orderID)
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

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function showData()
    {
        echo ("<br>");
        echo ("ID:" . $this->getorderID() . "<br>");
        echo ("Name:" . $this->getUserID() . "<br>");
        echo ("Price:" . $this->getOrderDate() . "<br>");
    }
}
