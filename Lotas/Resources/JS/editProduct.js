var productName_ = document.getElementById("productNameEdit");
var productNameAr_ = document.getElementById("productNameEditAr");
var notMateched_1 = document.getElementById("notMatechedEdit_1");
var notMateched_2 = document.getElementById("notMatechedEdit_2");
var signUp_ = document.getElementById("editProduct__");
var arabic = true;
var english = true;

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
