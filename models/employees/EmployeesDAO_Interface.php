<?php
interface EmployeesDAO
{
    public function insertEmployees($id,$password);
    public function updateEmployees($employees);
    public function deleteEmployeesByID($id);
    public function getOneEmployeesByID($id);
    public function getAllEmployees();
    public function doLogin($id,$password);
}
