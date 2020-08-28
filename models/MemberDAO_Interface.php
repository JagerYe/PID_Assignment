<?php
interface MemberDAO
{
    public function insertMember($id,$password,$name,$email,$phone);
    public function updateMember($member);
    public function deleteMemberByID($id);
    public function getOneMemberByID($id);
    public function getAllMember();
    public function doLogin($id,$password);
}
