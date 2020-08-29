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
    public function insertEmployees($id, $password)
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
    public function insertEmployeesByObj($employees)
    {
        return $this->insertEmployees($employees->getEmpID(), $employees->getempPassword());
    }

    //更新會員
    public function updateEmployees($employees)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strUpdate);
            $sth->bindParam("empID", $employees->getEmpID());
            $sth->bindParam("empPassword", $employees->getEmpPassword());
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

    public function getAllEmployees()
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->query($this->_strGetAll);
            $request = $sth->fetchAll();
            foreach ($request as $item) {
                $employeess[] = new Employees($item['empID']);
            }
            $sth = null;
        } catch (PDOException $err) {
            $dbh->rollBack();
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $employeess;
    }
    public function getOneEmployeesByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->prepare($this->_strGetOne);
            $sth->bindParam("empID", $id);
            $sth->execute();
            $request = $sth->fetch();
            echo ($request);

            $employees = new Employees($request['empID']);

            $sth = null;
        } catch (PDOException $err) {
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $employees;
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
