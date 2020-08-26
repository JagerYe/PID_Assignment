export class Member {
    constructor(userID, userPassword, userName, userEmail, userPhone) {
        this._userID = userID;
        this._userPassword = userPassword;
        this._userName = userName;
        this._userEmail = userEmail;
        this._userPhone = userPhone;
    }

    get userID() {
        return this._userID
    }
    set userID(userID) {
        this._userID = userID;
    }

    get userPassword() {
        return this._userPassword
    }
    set userPassword(userPassword) {
        this._userPassword = userPassword;
    }

    get userName() {
        return this._userName
    }
    set userName(userName) {
        this._userName = userName;
    }

    get userEmail() {
        return this._userEmail
    }
    set userEmail(userEmail) {
        this._userEmail = userEmail;
    }

    get userPhone() {
        return this._userPhone
    }
    set userPhone(userPhone) {
        this._userPhone = userPhone;
    }

}