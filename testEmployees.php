<?php

require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/employees/Employees.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/employees/EmployeesService.php";

$employees01 = new Employees("b01", "123456");
$employees02 = new Employees("b02", "123456");
echo ($employees02->getEmpID() . "<br>");
$employeesDAO = (new EmployeesService())->getDAO();

//新增測試----------------------------------------
$employeesDAO->insertEmployees(
    $employees01->getEmpID(),
    $employees01->getEmpPassword()
);
$employeesDAO->insertEmployeesByObj($employees02);
echo ("<hr>");
//新增測試----------------------------------------

//更新測試----------------------------------------
$employees02->setEmpPassword("111222");
if ($employeesDAO->updateEmployees($employees02)) {
    echo ("OK");
} else {
    echo ("no");
}
echo ("<hr>");
//更新測試----------------------------------------

//刪除測試----------------------------------------
if ($employeesDAO->deleteEmployeesByID($employees02->getEmpID())) {
    echo ("OK");
} else {
    echo ("no");
}
echo ("<hr>");
//刪除測試----------------------------------------

//取得所有測試----------------------------------------
$employeess = $employeesDAO->getAllEmployees();
var_dump($employeess);

//此方法會讓$item得不到member的class
// foreach ($members as $item) {
//     var_dump($item);
//     $item->showDate();
// }

for ($i = 0; $i < count($employeess); $i++) {
    $employeess[$i]->showData();
}
echo ("<hr>");
//取得所有測試----------------------------------------

//取得指定會員測試----------------------------------------
$employees03 = $employeesDAO->getOneEmployeesByID("emp1");
echo ($employees03->showData());
echo ("<hr>");
//取得指定會員測試----------------------------------------

//登入----------------------------------------
echo ("失敗測試<br>");
$request = $employeesDAO->doLogin("a01", "123");
echo ($request);
if ($request == 1) {
    echo ("ok");
} else {
    echo ("no");
}
echo ("<hr>");
echo ("成功測試<br>");
$request = $employeesDAO->doLogin($employees01->getEmpID(), $employees01->getEmpPassword());
echo ($request);
if ($request == 1) {
    echo ("ok");
} else {
    echo ("no");
}
echo ("<hr>");
//登入----------------------------------------