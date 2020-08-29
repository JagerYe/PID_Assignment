<?php
interface CommoditysDAO
{
    public function insertCommoditys($id,$password);
    public function updateCommoditys($eommoditys);
    public function deleteCommoditysByID($id);
    public function getOneCommoditysByID($id);
    public function getAllCommoditys();
}
