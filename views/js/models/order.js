export class Order {
    constructor(orderID, orderDate, attention) {
        this._orderID = orderID;
        this._orderDate = orderDate;
        this._attention = attention;
    }

    get orderID() {
        return this._orderID;
    }
    set orderID(orderID) {
        this._orderID = orderID;
    }

    get orderDate() {
        return this._orderDate;
    }
    set orderDate(orderDate) {
        this._orderDate = orderDate;
    }

    get attention() {
        return this._attention;
    }
    set attention(attention) {
        this._attention = attention;
    }
}