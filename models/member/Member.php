<?php
class Member implements \JsonSerializable
{
    private $_userID;
    private $_userPassword;
    private $_userName;
    private $_userEmail;
    private $_userPhone;
    private $_userStatus;

    public function __construct($userID, $userName, $userEmail, $userPhone,$userStatus, $userPassword = 0)
    {
        $this->setUserID($userID);
        $this->setUserPassword($userPassword);
        $this->setUserName($userName);
        $this->setUserEmail($userEmail);
        $this->setUserPhone($userPhone);
        $this->setUserStatus($userStatus);
    }

    public function getUserID()
    {
        return $this->_userID;
    }
    public function setUserID($userID)
    {
        if ($userID == null || $userID == "") {
            throw new Exception("ID格式錯誤");
        }
        $this->_userID = $userID;
        return true;
    }

    public function getUserPassword()
    {
        return $this->_userPassword;
    }
    public function setUserPassword($userPassword)
    {
        $this->_userPassword = $userPassword;
        return true;
    }

    public function getUserName()
    {
        return $this->_userName;
    }
    public function setUserName($userName)
    {
        if ($userName == null || $userName == "") {
            throw new Exception("名字格式錯誤");
        }
        $this->_userName = $userName;
        return true;
    }

    public function getUserEmail()
    {
        return $this->_userEmail;
    }
    public function setUserEmail($userEmail)
    {
        if ($userEmail == null || $userEmail == "") {
            throw new Exception("email格式錯誤");
        }
        $this->_userEmail = $userEmail;
        return true;
    }

    public function getUserPhone()
    {
        return $this->_userPhone;
    }
    public function setUserPhone($userPhone)
    {
        if ($userPhone == null || $userPhone == "") {
            throw new Exception("電話錯誤");
        }
        $this->_userPhone = $userPhone;
        return true;
    }

    public function getUserStatus()
    {
        return $this->_userStatus;
    }
    public function setUserStatus($userStatus)
    {
        if ($userStatus == null || $userStatus == "") {
            throw new Exception("狀態錯誤");
        }
        $this->_userStatus = $userStatus;
        return true;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }

    public function showData()
    {
        echo ("<br>");
        echo ("ID:" . $this->getUserID());
        echo ("Password:" . $this->getUserPassword());
        echo ("Name:" . $this->getUserName());
        echo ("Email:" . $this->getUserEmail());
        echo ("Phone:" . $this->getUserPhone());
        echo ("Phone:" . $this->getUserPhone());
    }
}
