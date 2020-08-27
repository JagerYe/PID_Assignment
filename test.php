<?php
require_once "/Applications/MAMP/htdocs/PID_Assignment/models/Member.php";
$member01 = new Member();
var_dump($member01);
$member02 = new Member("b01", "123456", "啾啾丸", "JoJoPlay@gmail.com", "0911213456");
echo ($member02->getUserID());


try {
    $dbh = new PDO("mysql:host=localhost;dbname=PID_Assignment;port=3306", "root", "root");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->exec("SET CHARACTER SET utf8");
    $dbh->beginTransaction();
    $sth = $dbh->prepare("INSERT INTO `Members`(`userID`, `userPassword`, `userName`, `userEmail`, `userPhone`) VALUES (?,?,?,?,?);");
    $sth->bindParam(1, $member02->getUserID());
    $sth->bindParam(2, $member02->getUserPassword());
    $sth->bindParam(3, $member02->getUserName());
    $sth->bindParam(4, $member02->getUserEmail());
    $sth->bindParam(5, $member02->getUserPhone());
    $sth->execute();
    $dbh->commit();
} catch (PDOException $err) {
    $dbh->rollBack();
}
