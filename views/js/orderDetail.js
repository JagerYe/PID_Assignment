class OrderDetail {
    constructor(orderID, commodityID, orderCommodityPrice, orderCommodityQuantity) {
        this._orderID = orderID;
        this._commodityID = commodityID;
        this._orderCommodityPrice = orderCommodityPrice;
        this._orderCommodityQuantity = orderCommodityQuantity;
    }

    get orderID() {
        return this._orderID;
    }
    set orderID(orderID) {
        this._orderID = orderID;
    }

    get commodityID() {
        return this._commodityID;
    }
    set commodityID(commodityID) {
        this._commodityID = commodityID;
    }

    get orderCommodityPrice() {
        return this._orderCommodityPrice;
    }
    set orderCommodityPrice(orderCommodityPrice) {
        this._orderCommodityPrice = orderCommodityPrice;
    }

    get orderCommodityQuantity() {
        return this._orderCommodityQuantity;
    }
    set orderCommodityQuantity(orderCommodityQuantity) {
        this._orderCommodityQuantity = orderCommodityQuantity;
    }
}