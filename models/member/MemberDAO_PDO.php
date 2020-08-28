<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/member/MemberDAO_Interface.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/config.php";
class MemberDAO_PDO implements MemberDAO
{

    private $_strInsert = "INSERT INTO `Members`(`userID`, `userPassword`, `userName`, `userEmail`, `userPhone`) VALUES (:userID,:userPassword,:userName,:userEmail,:userPhone);";
    private $_strUpdate = "UPDATE `Members` SET `userID`=:userID,`userPassword`=:userPassword,`userName`=:userName,`userEmail`=:userEmail,`userPhone`=:userPhone WHERE `userID`=:userID;";
    private $_strDelete = "DELETE FROM `Members` WHERE `userID` = :userID;";
    private $_strCheckMemberExist = "SELECT `userID` FROM `Members` WHERE `userID` = :userID;";
    private $_strGetAll = "SELECT `userID`, `userName`, `userEmail`, `userPhone` FROM `Members`;";
    private $_strGetOne = "SELECT `userID`, `userName`, `userEmail`, `userPhone` FROM `Members` WHERE `userID` = :userID;";
    private $_strDoLogin = "SELECT `userID` FROM `Members` WHERE `userID` = :userID AND `userPassword` = :userPassword;";

    //新增會員
    public function insertMember($id, $password, $name, $email, $phone)
    {
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
    public function insertMemberByObj($member)
    {
        return $this->insertMember($member->getUserID(), $member->getUserPassword(), $member->getUserName(), $member->getUserEmail(), $member->getUserPhone());
    }

    //更新會員
    public function updateMember($member)
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
    public function deleteMemberByID($id)
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $dbh->beginTransaction();
            $sth = $dbh->prepare($this->_strCheckMemberExist);
            $sth->bindParam("userID", $id);
            $sth->execute();
            if ($sth->fetch()) {
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

    public function getAllMember()
    {
        try {
            $dbh = (new Config)->getDBConnect();
            $sth = $dbh->query($this->_strGetAll);
            $request = $sth->fetchAll();
            foreach ($request as $item) {
                $members[] = new Member($item['userID'], $item['userName'], $item['userEmail'], $item['userPhone'], $item['userPassword']);
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
        return $request['0'];
    }
}
