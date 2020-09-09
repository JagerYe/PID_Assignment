<?php

require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/expectationList/ExpectationListDAO_PDO.php";
class ExpectationListService
{
    public static function getDAO()
    {
        return new ExpectationListDAO_PDO();
    }
}
