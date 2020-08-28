<?php

require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/employees/EmployeesDAO_PDO.php";
class EmployeesService
{
    private $_dao;
    function __construct()
    {
        $this->_dao = new EmployeesDAO_PDO();
    }
    public function getDAO()
    {
        return $this->_dao;
    }
}
