<?php
class ExpectationList implements \JsonSerializable
{
    private $_userID;
    private $_commodityID;
    private $_creationDate;

    private $_commodityName;
    private $_commodityPrice;
    private $_commodityQuantity;
    private $_commodityStatus;

    public static function jsonObjToModel($str)
    {
        return new ExpectationList(
            $_SESSION['userID'],
            $str
        );
    }

    public static function dbArrToModel($requestArr)
    {
        foreach ($requestArr as $item) {
            $expectationLists[] = new ExpectationList(
                $item["userID"],
                $item["commodityID"],
                $item["creationDate"],
                $item["commodityName"],
                $item["commodityPrice"],
                $item["commodityQuantity"],
                $item["commodityStatus"]
            );
        }
        return $expectationLists;
    }

    public function __construct(
        $userID,
        $commodityID,
        $creationDate = null,
        $commodityName = null,
        $commodityPrice = null,
        $commodityQuantity = null,
        $commodityStatus = null
    ) {
        $this->setUserID($userID);
        $this->setCommodityID($commodityID);
        $this->setCreationDate($creationDate);
        $this->setCommodityName($commodityName);
        $this->setCommodityPrice($commodityPrice);
        $this->setCommodityQuantity($commodityQuantity);
        $this->setCommodityStatus($commodityStatus);
    }

    public function getUserID()
    {
        return $this->_userID;
    }
    public function setUserID($userID)
    {
        if (!preg_match("/\w{6,30}/", $userID)) {
            throw new Exception("ID格式錯誤");
        }
        $this->_userID = $userID;
        return true;
    }

    public function getCommodityID()
    {
        return $this->_commodityID;
    }
    public function setCommodityID($commodityID)
    {
        if ($commodityID == null) {
            throw new Exception("商品格式錯誤");
        }
        $this->_commodityID = $commodityID;
        return true;
    }

    public function getCreationDate()
    {
        return $this->_creationDate;
    }
    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;
        return true;
    }

    public function getCommodityName()
    {
        return $this->_commodityName;
    }
    public function setCommodityName($commodityName)
    {
        $this->_commodityName = $commodityName;
        return true;
    }

    public function getCommodityPrice()
    {
        return $this->_commodityPrice;
    }
    public function setCommodityPrice($commodityPrice)
    {
        $this->_commodityPrice = $commodityPrice;
        return true;
    }

    public function getCommodityQuantity()
    {
        return $this->_commodityQuantity;
    }
    public function setCommodityQuantity($commodityQuantity)
    {
        $this->_commodityQuantity = $commodityQuantity;
        return true;
    }

    public function getCommodityStatus()
    {
        return $this->_commodityStatus;
    }
    public function setCommodityStatus($commodityStatus)
    {
        $this->_commodityStatus = $commodityStatus;
        return true;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}
