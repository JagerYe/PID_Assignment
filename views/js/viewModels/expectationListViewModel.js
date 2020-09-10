export class ExpectationListViewModel {
    static getListView(id, name, price, quantity, date) {
        return `<div class="row item border" id="item${id}">
                    <div class="col-4">
                        <img src="/PID_Assignment/views/pageFront/commodity.html?commodityID=${id}" alt="${name}" onerror="this.onerror = null; this.src='/PID_Assignment/views/img/gravatar.jpg'">
                    </div>
                    <div class="col-8">
                        <div>
                        <a href="/PID_Assignment/views/pageFront/commodity.html?commodityID=${id}"><h2>${name}</h2></a>
                        </div>
                        <div class="row align-items-center">
                            <div class="col"></div>
                            <div class="col-1 row align-items-center">
                                <h4 class="col text-center">${price}</h4>
                            </div>
                            <div class="col-2">
                                <h4 class="col text-center">購買數量</h4>
                                <input class="form-control" type="number" value="1" min="1" max="${quantity}" id="buyQuantity${id}">
                            </div>
                            <div class="col-1"><button class="btn btn-success" id="btnBuy${id}">放進購物車</button></div>
                        </div>
                        <div class="row">
                            <div class="col-2">${date}</div>
                            <div class="col-1"><button class="btn btn-link" id="delete${id}">delete</button></div>
                        </div>
                    </div>
                </div>`;
    }

}
