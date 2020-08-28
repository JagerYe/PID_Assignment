<?php
interface EmployeesDAO
{
    public function insertEmployees($id,$password,$name,$email,$phone);
    public function updateEmployees($member);
    public function deleteEmployeesByID($id);
    public function getOneEmployeesByID($id);
    public function getAllEmployees();
    public function doLogin($id,$password);
}
