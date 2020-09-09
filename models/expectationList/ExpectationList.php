<?php
class ExpectationList implements \JsonSerializable
{
    private $_userID;
    private $_commodityID;
    private $_creationDate;

    private $_commodityName;
    private $_commodityPrice;
    private $_commodityStatus;

    public static function jsonObjToModel($jsonObj)
    {
        return new ExpectationList(
            $jsonObj->_userID,
            $jsonObj->_commodityID
        );
    }

    public static function dbArrToModel($requestArr)
    {
        $checkObj = new ExpectationList("a00000", 11111);
        foreach ($requestArr as $item) {
            $checkObj->setUserID($item["userID"]);
            $checkObj->setCommodityID($item["commodityID"]);
            $checkObj->setCreationDate($item["creationDate"]);
            $checkObj->setCommodityName($item["commodityName"]);
            $checkObj->setCommodityPrice($item["commodityPrice"]);
            $checkObj->setCommodityStatus($item["commodityStatus"]);
            $expectationLists[] = (object)[
                "userID" => $checkObj->getUserID(),
                "commodityID" => $checkObj->getCommodityID(),
                "creationDate" => $checkObj->getCreationDate(),
                "commodityName" => $checkObj->getCommodityName(),
                "commodityPrice" => $checkObj->getCommodityPrice(),
                "commodityStatus" => $checkObj->getCommodityStatus()
            ];
        }
    }

    public function __construct(
        $userID,
        $commodityID,
        $creationDate = null,
        $commodityName = null,
        $commodityPrice = null,
        $commodityStatus = null
    ) {
        $this->setUserID($userID);
        $this->setCommodityID($commodityID);
        $this->setCreationDate($creationDate);
        $this->setCommodityName($commodityName);
        $this->setCommodityPrice($commodityPrice);
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
