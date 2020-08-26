export class CommodityViewModel {
    static getMenuView(id, name, price) {
        return `<div class="col-md-4">
                    <a href="/PID_Assignment/views/pageFront/commodity.html?commodityID=${id}">
                        <div class="card mb-4 shadow-sm">
                            <img src="/PID_Assignment/views/img/gravatar.jpg">
                            <div class="card-body">
                                <h2>${name}</h2>
                                <p class="card-text">${price}</p>
                            </div>
                        </div>
                    </a>
                </div>`;
    }

    static getShoppingCartView(name,price,commodityQuantity,buyQuantity){
        return `<li class="row">
                    <div class="col-3"><img src="/PID_Assignment/views/img/gravatar.jpg"></div>
                    <div class="col-3">${name}</div>
                    <div class="col-3">${price}</div>
                    <div class="col-2">
                        <input class="commodityQuantity" id="commodityQuantity" name="commodityQuantity" 
                            type="number" min="0" max="${commodityQuantity}" value="${buyQuantity}">
                    </div>
                    <div class="col-1">
                        <button type="button" class="commodityDelete btn">刪除</button>
                    </div>
                </li>`;
    }
}
