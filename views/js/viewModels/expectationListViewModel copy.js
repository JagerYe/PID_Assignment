export class CommodityViewModel {
    static getListView(id, name, price) {
        return `<div class="row">
                    <div class="col-4">
                        <img src="/PID_Assignment/views/pageFront/commodity.html?commodityID=${id}">
                    </div>
                    <div class="col-8">
                        <div>
                            <h2>Name</h2>
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-1">
                                <h3>價錢</h3>
                            </div>
                            <div class="col-2"><input type="number" name="" id=""></div>
                            <div class="col-1"><button>Buy</button></div>
                        </div>
                        <div class="row">
                            <div class="col-2">新增日期</div>
                            <div class="col-1"><button>delete</button></div>
                        </div>
                    </div>
                </div>`;
    }

}
