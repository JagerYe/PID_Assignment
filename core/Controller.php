<?php

class Controller
{
    public function model($model)
    {
        require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/$model/$model.php";
    }

    public function requireDAO($modelName){
        require_once "{$_SERVER['DOCUMENT_ROOT']}/RD1_Assignment/models/$modelName/{$modelName}Service.php";
        require_once "{$_SERVER['DOCUMENT_ROOT']}/RD1_Assignment/models/$modelName/$modelName.php"; 
    }
}
