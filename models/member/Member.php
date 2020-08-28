<?php
class Member
{
    private $_userID;
    private $_userPassword;
    private $_userName;
    private $_userEmail;
    private $_userPhone;

    public function __construct($userID, $userName, $userEmail, $userPhone, $userPassword = 0)
    {
        $this->setUserID($userID);
        $this->setUserPassword($userPassword);
        $this->setUserName($userName);
        $this->setUserEmail($userEmail);
        $this->setUserPhone($userPhone);
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
            throw new Exception("ID錯誤");
        }
        $this->_userPhone = $userPhone;
        return true;
    }

    public function showData()
    {
        echo ("<br>");
        echo ("ID:" . $this->getUserID());
        echo ("Password:" . $this->getUserPassword());
        echo ("Name:" . $this->getUserName());
        echo ("Email:" . $this->getUserEmail());
        echo ("Phone:" . $this->getUserPhone());
    }
}
