/*
var quantity_ = document.getElementById("quantity");
var price_ = document.getElementById("price");
var total_price = document.getElementById("total_price");

quantity_.onkeyup = function(){
    'use srtics';
    var result = quantity_.value * parseFloat(price_.innerText);
    result = Number(result).toFixed(2);
    total_price.innerHTML = result;
};
*/
//////////////////////////////////////
var price_div = document.getElementById("price_div");
var d = price_div.children.length-1;
for (var x=1; x<d; x++)
{
    test_(x);
    //console.log("Q " + x + " = " + price_.textContent);
    
}
function test_(i) {
    var model_ = price_div.children[i];
    var form_price_ = model_.children[0].children[0].children[1].children[0];
    var quantity_ = form_price_.children[1].children[1];
    var price_ = form_price_.children[2].children[1];
    var total_price = form_price_.children[3].children[1];
    quantity_.onkeyup = function(){
        'use srtics';
        var result = quantity_.value * parseFloat(price_.innerText);
        result = Number(result).toFixed(2);
        total_price.innerHTML = result;
    };
}

