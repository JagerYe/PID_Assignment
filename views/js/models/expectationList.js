export class ExpectationList {
    constructor(commodityID, userID = "", creationDate = "", commodityName = "", commodityPrice = 0, commodityQuantity = 0, commodityStatus = "close") {
        this._userID = userID;
        this._commodityID = commodityID;
        this._creationDate = creationDate;
        this._commodityName = commodityName;
        this._commodityPrice = commodityPrice;
        this._commodityStatus = commodityStatus;
        this._commodityQuantity = commodityQuantity;
    }

    get userID() {
        return this._userID;
    }
    set userID(userID) {
        this._userID = userID;
    }

    get commodityID() {
        return this._commodityID;
    }
    set commodityID(commodityID) {
        this._commodityID = commodityID;
    }

    get creationDate() {
        return this._creationDate;
    }
    set creationDate(creationDate) {
        this._creationDate = creationDate;
    }

    get commodityName() {
        return this._commodityName;
    }
    set commodityName(commodityName) {
        this._commodityName = commodityName;
    }

    get commodityPrice() {
        return this._commodityPrice;
    }
    set commodityPrice(commodityPrice) {
        this._commodityPrice = commodityPrice;
    }

    get commodityStatus() {
        return this._commodityStatus;
    }
    set commodityStatus(commodityStatus) {
        this._commodityStatus = commodityStatus;
    }

    get commodityQuantity() {
        return this._commodityQuantity;
    }
    set commodityQuantity(commodityQuantity) {
        this._commodityQuantity = commodityQuantity;
    }
}