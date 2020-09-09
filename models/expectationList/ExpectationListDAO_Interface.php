<?php
interface ExpectationListDAO
{
    public function insertExpectationList($userID, $commodityID);
    public function deleteExpectationListByID($user, $commodityID);
    public function getMemberAllExpectationList($id);
    public function checkExpectationListExist($user, $commodityID);
}
