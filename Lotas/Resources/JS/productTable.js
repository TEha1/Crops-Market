var prodTable_ = document.getElementById("prodTable").children[0];
var clearField_ = document.getElementsByClassName("clearField");
var tr_ = [];
var p = {};
for(var i=1; i<prodTable_.children.length-1; i++) {
    tr_[i] = prodTable_.children[i+1];
    var plus = i+1;
    p['td_' + plus] = Array();
    for(var j=0 ; j<tr_[i].children.length-1; j++) {
        p['td_' + plus].push(tr_[i].children[j+1]);
    }
}
//console.log(p.td_5[1]);
for(var i=2; i<6; i++) {
    for(var w=0; w<4; w++)
        setRequired(i, w);
}
for(var i=0,w=2; i<4; i++,w++) {
    console.log(clearField_[i] + " t " + w);
    clear(i, w);
}
function setRequired(i, w) {
    var firstField = p['td_' + i][w].children[0];
    var secondField =  p['td_' + i][w].children[2];
    firstField.onkeydown = function() {
        'use strict';
        for(var j=0; j<4; j++) {
            var firstField_ar = p['td_' + i][j].children[0];
            var secondField_en = p['td_' + i][j].children[2];
            firstField_ar.setAttribute("required", "");
            firstField_ar.setAttribute("style", "background-color: "); 
            secondField_en.setAttribute("required", "");
            secondField_en.setAttribute("style", "background-color: ");
        }
    };
    secondField.onkeydown = function() {
        'use strict';
        for(var j=0; j<4; j++) {
            var firstField_ar = p['td_' + i][j].children[0];
            var secondField_en = p['td_' + i][j].children[2];
            firstField_ar.setAttribute("required", "");
            firstField_ar.setAttribute("style", "background-color: "); 
            secondField_en.setAttribute("required", "");
            secondField_en.setAttribute("style", "background-color: ");
        }
    };

}
function clear(i,w) {
    clearField_[i].onclick = function() {
        'use strict';
        for(var j=0; j<4; j++) {
            var firstField_ar = p['td_' + w][j].children[0];
            var secondField_en = p['td_' + w][j].children[2];
            firstField_ar.removeAttribute("required");
            firstField_ar.setAttribute("style", "background-color: ");
            firstField_ar.value = "";
            secondField_en.removeAttribute("required");
            secondField_en.setAttribute("style", "background-color: "); 
            secondField_en.value = "";
        }
    };
}
/////////////////////
var productName_ = document.getElementById("productName");
var productNameAr_ = document.getElementById("productNameAr");
var notMateched_1 = document.getElementById("notMateched_1");
var notMateched_2 = document.getElementById("notMateched_2");
var signUp_ = document.getElementById("addProduct__");
var arabic = false;
var english = false;

productName_.onkeyup = function() {
    'use strict';
    if (productName_.value === "") {
        console.log("empty");
    } else {
        console.log("not empty");
        var dataString = 'name=' + productName_.value;
        $.ajax({
            type: "POST",
            url: "../Controllers/checkProductController.php",
            data: dataString,
            cache: false,
            success: function (d) {
                if (d !== "") {
                    notMateched_1.style.display = "block";
                    notMateched_1.innerHTML = d;
                    english = false;
                    if (english == true || arabic == false) {
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                    } else if (english == false || arabic == true) {
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                    } else if (english == false || arabic == false) {
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                    } else {
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                    }
                } else {
                    notMateched_1.style.display = "none";
                    english = true;
                    console.log("en = " + english);
                    if (english == true && arabic == true) {
                        console.log("true");
                        signUp_.setAttribute("type", "submit");
                        signUp_.classList.remove("disabled");
                    }
                }
            }
        });
    }
};


productNameAr_.onkeyup = function() {
    'use strict';
    if (productNameAr_.value === "") {
        console.log("empty");
    } else {
        console.log("not empty");
        var dataString = 'name_ar=' + productNameAr_.value;
        $.ajax({
            type: "POST",
            url: "../Controllers/checkProductController.php",
            data: dataString,
            cache: false,
            success: function (d) {
                if (d !== "") {
                    notMateched_2.style.display = "block";
                    notMateched_2.innerHTML = d;
                    arabic = false;
                    if (english == true || arabic == false) {
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                    } else if (english == false || arabic == true) {
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                    } else if (english == false || arabic == false) {
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                    } else {
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                    }
                } else {
                    notMateched_2.style.display = "none";
                    arabic = true;
                    console.log("ar = " + arabic)
                    if (english == true && arabic == true) {
                        console.log("true");
                        signUp_.setAttribute("type", "submit");
                        signUp_.classList.remove("disabled");
                    }
                }
            }
        });
    }
};
