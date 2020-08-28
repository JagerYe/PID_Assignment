<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/employees/EmployeesDAO_Interface.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/config.php";
class EmployeesDAO_PDO implements EmployeesDAO
{

    private $_strInsert = "INSERT INTO `Employees`(`empID`, `empPassword`) VALUES (:empID,:empPassword);";
    private $_strUpdate = "UPDATE `Employees` SET `empID`=:empID,`empPassword`=:empPassword WHERE `empID` =:empID;";
    private $_strDelete = "DELETE FROM `Employees` WHERE `empID`=:empID;";
    private $_strCheckEmployeesExist = "SELECT COUNT(*) FROM `Employees` WHERE `empID`=:empID";
    private $_strGetAll = "SELECT `empID` FROM `Employees`;";
    private $_strGetOne = "SELECT `empID` FROM `Employees` WHERE `empID`=:empID;";
    private $_strDoLogin = "SELECT COUNT(*) FROM `Employees` WHERE `empID`=:empID AND `empPassword`=:empPassword";

    //新增會員
    public function insertEmployees($id, $password, $name, $email, $phone)
    {
        echo (gettype($id));
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strInsert);
            $sth->bindParam("userID", $id);
            $sth->bindParam("userPassword", $password);
            $sth->bindParam("userName", $name);
            $sth->bindParam("userEmail", $email);
            $sth->bindParam("userPhone", $phone);
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
    public function insertEmployeesByObj($member)
    {
        return $this->insertEmployees($member->getUserID(), $member->getUserPassword(), $member->getUserName(), $member->getUserEmail(), $member->getUserPhone());
    }

    //更新會員
    public function updateEmployees($member)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strUpdate);
            $sth->bindParam("userID", $member->getUserID());
            $sth->bindParam("userPassword", $member->getUserPassword());
            $sth->bindParam("userName", $member->getUserName());
            $sth->bindParam("userEmail", $member->getUserEmail());
            $sth->bindParam("userPhone", $member->getUserPhone());
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
    public function deleteEmployeesByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strCheckEmployeesExist);
            $sth->bindParam("userID", $id);
            $sth->execute();
            if (!$sth->fetch()) {
                throw new Exception("找不到");
            }
            $sth = $dbh->prepare($this->_strDelete);
            $sth->bindParam("userID", $id);
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

    public function getAllEmployees()
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->query($this->_strGetAll);
            $request = $sth->fetchAll();
            foreach ($request as $item) {
                $members[] = new Member($item['userID'], $item['userName'], $item['userEmail'], $item['userPhone']);
            }
            $sth = null;
        } catch (PDOException $err) {
            $dbh->rollBack();
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $members;
    }
    public function getOneEmployeesByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->prepare($this->_strGetOne);
            $sth->bindParam("userID", $id);
            $sth->execute();
            $request = $sth->fetch();
            echo ($request);

            $member = new Member($request['userID'], $request['userName'], $request['userEmail'], $request['userPhone']);

            $sth = null;
        } catch (PDOException $err) {
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $member;
    }

    public function doLogin($id, $password)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->prepare($this->_strDoLogin);
            $sth->bindParam("userID", $id);
            $sth->bindParam("userPassword", $password);
            $sth->execute();
            $request = $sth->fetch();
            $sth = null;
        } catch (PDOException $err) {
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $request;
    }
}
