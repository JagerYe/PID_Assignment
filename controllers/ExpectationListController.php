<?php
class ExpectationListController extends Controller
{
    public function __construct()
    {
        $this->requireDAO("expectationList");
    }

    public function insertByObj($str)
    {

        $expectationList = ExpectationList::jsonObjToModel($str);

        return ExpectationListService::getDAO()->insertExpectationListByObj($expectationList);
    }

    public function delete($commodityID)
    {
        return ExpectationListService::getDAO()->deleteExpectationListByID($_SESSION['userID'], $commodityID);
    }

    public function getAll()
    {
        return ExpectationListService::getDAO()->getMemberAllExpectationList($_SESSION['userID']);
    }

    public function checkExist($commodityID)
    {
        return ExpectationListService::getDAO()->checkExpectationListExist($_SESSION['userID'], $commodityID);
    }
}
