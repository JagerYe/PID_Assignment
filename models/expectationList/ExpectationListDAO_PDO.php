<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/expectationList/ExpectationListDAO_Interface.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/config.php";
class ExpectationListDAO_PDO implements ExpectationListDAO
{

    private $_strInsert = "INSERT INTO `ExpectationList`(`userID`, `commodityID`, `creationDate`)
                            VALUES (:userID,:commodityID,NOW());";
    private $_strDelete = "DELETE FROM `ExpectationList` WHERE `userID`=:userID AND `commodityID`=:commodityID;";
    private $_strCheckExpectationListExist = "SELECT COUNT(*) FROM `ExpectationLists` WHERE `userID`=:userID AND `commodityID`=:commodityID;";
    private $_strGetMemberAll = "SELECT `userID`, e.`commodityID`, `creationDate`, `commodityName`, `commodityPrice`, `commodityStatus` FROM `ExpectationList` AS e
                                    INNER JOIN `Commoditys` AS c ON e.`commodityID` = c.`commodityID`
                                    WHERE `userID`='a00001' AND `commodityStatus`='open';";

    //新增會員
    public function insertExpectationList($userID, $commodityID)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strInsert);
            $sth->bindParam("userID", $userID);
            $sth->bindParam("commodityID", $commodityID);
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
    public function insertExpectationListByObj($expectationList)
    {
        return $this->insertExpectationList(
            $expectationList->getUserID(),
            $expectationList->getCommodityID()
        );
    }

    //之後需增加檢查是否有訂單
    public function deleteExpectationListByID($userID, $commodityID)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strDelete);
            $sth->bindParam("userID", $userID);
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

    public function getMemberAllExpectationList($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->query($this->_strGetMemberAll);
            $request = $sth->fetchAll(PDO::FETCH_ASSOC);

            $sth = null;
        } catch (PDOException $err) {
            $dbh->rollBack();
            return false;
        }
        $dbh = null;
        return ExpectationList::dbArrToModel($request);
    }

    public function checkExpectationListExist($userID, $commodityID)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->prepare($this->_strCheckExpectationListExist);
            $sth->bindParam("userID", $userID);
            $sth->bindParam("commodityID", $commodityID);
            $sth->execute();
            $request = $sth->fetch(PDO::FETCH_NUM);
        } catch (Exception $err) {
            return false;
        }
        return $request['0'];
    }
}
