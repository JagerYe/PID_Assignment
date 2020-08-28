<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/MemberDAO_Interface.php";
require_once "/Applications/MAMP/htdocs/PID_Assignment/models/config.php";
class MemberDAO_PDO implements MemberDAO
{

    //新增會員
    public function insertMember($id, $password, $name, $email, $phone)
    {
        echo (gettype($id));
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare("INSERT INTO `Members`(`userID`, `userPassword`, `userName`, `userEmail`, `userPhone`) VALUES (?,?,?,?,?);");
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
    public function insertMemberByObj($member)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare("INSERT INTO `Members`(`userID`, `userPassword`, `userName`, `userEmail`, `userPhone`) VALUES (:userID,:userPassword,:userName,:userEmail,:userPhone);");
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

    //更新會員
    public function updateMember($member)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare("UPDATE `Members` SET `userID`=:userID,`userPassword`=:userPassword,`userName`=:userName,`userEmail`=:userEmail,`userPhone`=:userPhone WHERE `userID`=:userID;");
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
    public function deleteMemberByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare("SELECT `userID` FROM `Members` WHERE `userID` = :userID;");
            $sth->bindParam("userID", $id);
            $sth->execute();
            if (!$sth->fetch()) {
                throw new Exception("找不到");
            }
            $sth = $dbh->prepare("DELETE FROM `Members` WHERE `userID` = :userID;");
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

    public function getAllMember()
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->query("SELECT `userID`, `userName`, `userEmail`, `userPhone` FROM `Members`;");
            $request = $sth->fetchAll();
            foreach ($request as $item) {
                $members[] = new Member($item['userID'], $item['userName'], $item['userEmail'], $item['userPhone']);
            }
            foreach ($members as $item1) {
                $item1->showData();
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
    public function getOneMemberByID($id)
    {
    }

    public function doLogin($id, $password)
    {
    }
}
