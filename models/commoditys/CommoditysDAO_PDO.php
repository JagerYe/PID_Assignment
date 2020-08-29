<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/commoditys/CommoditysDAO_Interface.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/config.php";
class CommoditysDAO_PDO implements CommoditysDAO
{

    private $_strInsert = "INSERT INTO `Commoditys`(`empID`, `empPassword`) VALUES (:empID,:empPassword);";
    private $_strUpdate = "UPDATE `Commoditys` SET `empID`=:empID,`empPassword`=:empPassword WHERE `empID` =:empID;";
    private $_strDelete = "DELETE FROM `Commoditys` WHERE `empID`=:empID;";
    private $_strCheckCommoditysExist = "SELECT COUNT(*) FROM `Commoditys` WHERE `empID`=:empID";
    private $_strGetAll = "SELECT `empID` FROM `Commoditys`;";
    private $_strGetOne = "SELECT `empID` FROM `Commoditys` WHERE `empID`=:empID;";
    private $_strDoLogin = "SELECT COUNT(*) FROM `Commoditys` WHERE `empID`=:empID AND `empPassword`=:empPassword";

    //新增會員
    public function insertCommoditys($id, $password)
    {
        echo (gettype($id));
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strInsert);
            $sth->bindParam("empID", $id);
            $sth->bindParam("empPassword", $password);
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
    public function insertCommoditysByObj($commoditys)
    {
        return $this->insertCommoditys($commoditys->getEmpID(), $commoditys->getempPassword());
    }

    //更新會員
    public function updateCommoditys($commoditys)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strUpdate);
            $sth->bindParam("empID", $commoditys->getEmpID());
            $sth->bindParam("empPassword", $commoditys->getEmpPassword());
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
    public function deleteCommoditysByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strCheckCommoditysExist);
            $sth->bindParam("empID", $id);
            $sth->execute();
            if (!$sth->fetch()) {
                throw new Exception("找不到");
            }
            $sth = $dbh->prepare($this->_strDelete);
            $sth->bindParam("empID", $id);
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

    public function getAllCommoditys()
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->query($this->_strGetAll);
            $request = $sth->fetchAll();
            foreach ($request as $item) {
                $commodityss[] = new Commoditys($item['empID']);
            }
            $sth = null;
        } catch (PDOException $err) {
            $dbh->rollBack();
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $commodityss;
    }
    public function getOneCommoditysByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->prepare($this->_strGetOne);
            $sth->bindParam("empID", $id);
            $sth->execute();
            $request = $sth->fetch();
            echo ($request);

            $commoditys = new Commoditys($request['empID']);

            $sth = null;
        } catch (PDOException $err) {
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $commoditys;
    }

    public function doLogin($id, $password)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->prepare($this->_strDoLogin);
            $sth->bindParam("empID", $id);
            $sth->bindParam("empPassword", $password);
            $sth->execute();
            $request = $sth->fetch();
            $sth = null;
        } catch (PDOException $err) {
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $request['0'];
    }
}
