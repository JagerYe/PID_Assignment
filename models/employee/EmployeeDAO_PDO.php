<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/employee/EmployeeDAO_Interface.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/config.php";
class EmployeeDAO_PDO implements EmployeeDAO
{

    private $_strInsert = "INSERT INTO `Employees`(`empID`, `empPassword`) VALUES (:empID,:empPassword);";
    private $_strUpdate = "UPDATE `Employees` SET `empPassword`=:empPassword WHERE `empID` =:empID;";
    private $_strDelete = "DELETE FROM `Employees` WHERE `empID`=:empID;";
    private $_strCheckEmployeesExist = "SELECT COUNT(*) FROM `Employees` WHERE `empID`=:empID";
    private $_strGetAll = "SELECT `empID` FROM `Employees`;";
    private $_strGetOne = "SELECT `empID` FROM `Employees` WHERE `empID`=:empID;";
    private $_strDoLogin = "SELECT COUNT(*) FROM `Employees` WHERE `empID`=:empID AND `empPassword`=:empPassword";

    //新增會員
    public function insertEmployee($id, $password)
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
    public function insertEmployeeByObj($employees)
    {
        return $this->insertEmployee($employees->getEmpID(), $employees->getempPassword());
    }

    //更新會員
    public function updateEmployee($employee)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strUpdate);
            $sth->bindParam("empID", $employee->getEmpID());
            $sth->bindParam("empPassword", $employee->getEmpPassword());
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

    public function deleteEmployeeByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strCheckEmployeesExist);
            $sth->bindParam("empID", $id);
            $sth->execute();
            $request = $sth->fetch(PDO::FETCH_NUM);
            if ($request['0'] <= 0) {
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
            $request = $sth->fetchAll(PDO::FETCH_ASSOC);
            foreach ($request as $item) {
                $employeess[] = new Employee($item['empID']);
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
    public function getOneEmployeeByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->prepare($this->_strGetOne);
            $sth->bindParam("empID", $id);
            $sth->execute();
            $request = $sth->fetch(PDO::FETCH_ASSOC);

            $employees = new Employee($request['empID']);

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
            $request = $sth->fetch(PDO::FETCH_NUM);
            $sth = null;
        } catch (PDOException $err) {
            echo ($err->__toString());
            return false;
        }
        $dbh = null;
        return $request['0'];
    }
}
