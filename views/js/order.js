class Order {
    constructor(orderID, orderDate) {
        this._orderID = orderID;
        this._orderDate = orderDate;
    }

    get orderID() {
        return this._orderID;
    }
    set orderID(orderID) {
        this._orderID = orderID;
    }

    get _orderDate() {
        return this.__orderDate;
    }
    set _orderDate(_orderDate) {
        this.__orderDate = _orderDate;
    }
}