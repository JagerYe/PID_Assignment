<?php
// echo(__DIR__);
// var_dump($_SERVER);
// echo ($_SERVER["DOCUMENT_ROOT"]);
// echo("{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/Member.php");
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/Member.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/MemberDAO_PDO.php";

// $member01 = new Member();
// var_dump($member01);
$member02 = new Member("b01", "123456", "啾啾丸", "JoJoPlay@gmail.com", "0911213456");
echo ($member02->getUserID() . "<br>");
$memberDAO = new MemberDAO_PDO();

//新增測試
// $memberDAO->insertMember(
//     $member02->getUserID(),
//     $member02->getUserPassword(),
//     $member02->getUserName(),
//     $member02->getUserEmail(),
//     $member02->getUserPhone()
// );

//更新測試
// if ($memberDAO->updateMember($member02)) {
//     echo ("OK");
// } else {
//     echo ("ON");
// }

//刪除測試
// if ($memberDAO->deleteMemberByID("b03")) {
//     echo ("OK");
// } else {
//     echo ("ON");
// }

//取得所有測試
$members = $memberDAO->getAllMember();
var_dump($members);
foreach ($members as $item) {
    $item->showDate();
}
