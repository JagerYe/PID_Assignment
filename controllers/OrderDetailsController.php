<?php
class OrderDetailsController extends Controller
{
    private $_dao;
    public function __construct()
    {
        require_once "{$_SERVER['DOCUMENT_ROOT']}/PID_Assignment/models/orderDetail/OrderDetailService.php";
        $this->_dao = (new OrderDetailService())->getDAO();
        $this->model("orderDetail");
    }

    public function jsonToModel($str)
    {
        $obj = json_decode($str);
        foreach ($obj as $item) {
            try {
                $orderDetail = new OrderDetail(
                    $item->_orderID,
                    $item->_commodityID,
                    $item->_orderCommodityPrice,
                    $item->_orderCommodityQuantity
                );
            } catch (Exception $err) {
                return false;
            }
            $orderDetails[] = $orderDetail;
        }

        return $orderDetails;
    }

    // public function insert($id, $password, $name, $email, $phone, $status)
    // {
    //     if ($password == null || strlen($password) <= 0) {
    //         return false;
    //     }

    //     if ($this->_dao->insertMember($id, $password, $name, $email, $phone, $status)) {
    //         return true;
    //     }
    //     return false;
    // }

    // public function insertByObj($str)
    // {

    //     if (!($member = $this->jsonToModel($str))) {
    //         return false;
    //     }

    //     if ($this->_dao->insertMemberByObj($member)) {
    //         return true;
    //     }

    //     return false;
    // }

    // public function update($str)
    // {
    //     if (!($member = $this->jsonToModel($str))) {
    //         return false;
    //     }

    //     if ($this->_dao->updateMember($member)) {
    //         return true;
    //     }
    //     return false;
    // }

    // public function delete($id)
    // {
    //     if ($this->_dao->deleteMemberByID($id)) {
    //         return true;
    //     }
    //     return false;
    // }

    // public function getAll()
    // {
    //     if ($members = $this->_dao->getAllMember()) {
    //         return json_encode($members);
    //     }
    //     return false;
    // }

    // public function getOne($id)
    // {
    //     if ($member = $this->_dao->getOneMemberByID($id)) {
    //         $a = json_encode($member);
    //         return $a;
    //     }
    //     return false;
    // }

    // public function login($id, $password)
    // {
    //     // $request = ;
    //     if ($this->_dao->doLogin($id, $password) == 1) {
    //         $member = $this->_dao->getOneMemberByID($id);

    //         $_SESSION["userID"] = $member->getUserID();
    //         $_SESSION["userName"] = $member->getUserName();

    //         return true;
    //     }
    //     return false;
    // }

    // public function getSessionUserName()
    // {
    //     if (isset($_SESSION['userName'])) {
    //         return $_SESSION['userName'];
    //     }
    //     return false;
    // }

    // public function logout()
    // {
    //     unset($_SESSION['userID']);
    //     unset($_SESSION['userName']);
    // }
}
