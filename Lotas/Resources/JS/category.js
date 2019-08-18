
var categoryName_ = document.getElementById("myCategoryName");
var categoryNameAr_ = document.getElementById("myCategoryNameAr");
var notMateched__1 = document.getElementById("myFoundBefore_1");
var notMateched__2 = document.getElementById("myFoundBefore_2");
var addCategory__ = document.getElementById("myAddCategory__");
var arabic = false;
var english = false;

categoryName_.onkeyup = function () {
    'use strict';
    console.log("teha");
    if (categoryName_.value === "") {
        console.log("empty");
    } else {
        console.log("not empty");
        var dataString = 'name=' + categoryName_.value;
        $.ajax({
            type: "POST",
            url: "../Controllers/checkCategoryController.php",
            data: dataString,
            cache: false,
            success: function (d) {
                if (d !== "") {
                    notMateched__1.style.display = "block";
                    notMateched__1.innerHTML = d;
                    english = false;
                    if (english == true || arabic == false) {
                        addCategory__.setAttribute("type", "button");
                        addCategory__.classList.add("disabled");
                    } else if (english == false || arabic == true) {
                        addCategory__.setAttribute("type", "button");
                        addCategory__.classList.add("disabled");
                    } else if (english == false || arabic == false) {
                        addCategory__.setAttribute("type", "button");
                        addCategory__.classList.add("disabled");
                    } else {
                        addCategory__.setAttribute("type", "button");
                        addCategory__.classList.add("disabled");
                    }
                } else {
                    notMateched__1.style.display = "none";
                    english = true;
                    if (english == true && arabic == true) {
                        console.log("true");
                        addCategory__.setAttribute("type", "submit");
                        addCategory__.classList.remove("disabled");
                    }
                }
            }
        });
    }
};


categoryNameAr_.onkeyup = function () {
    'use strict';
    if (categoryNameAr_.value === "") {
        console.log("empty");
    } else {
        console.log("not empty");
        var dataString = 'name_ar=' + categoryNameAr_.value;
        $.ajax({
            type: "POST",
            url: "../Controllers/checkCategoryController.php",
            data: dataString,
            cache: false,
            success: function (d) {
                if (d !== "") {
                    notMateched__2.style.display = "block";
                    notMateched__2.innerHTML = d;
                    console.log("d = " + d);
                    arabic = false;
                    if (english == true || arabic == false) {
                        addCategory__.setAttribute("type", "button");
                        addCategory__.classList.add("disabled");
                    } else if (english == false || arabic == true) {
                        addCategory__.setAttribute("type", "button");
                        addCategory__.classList.add("disabled");
                    } else if (english == false || arabic == false) {
                        addCategory__.setAttribute("type", "button");
                        addCategory__.classList.add("disabled");
                    } else {
                        addCategory__.setAttribute("type", "button");
                        addCategory__.classList.add("disabled");
                    }
                } else {
                    notMateched__2.style.display = "none";
                    arabic = true;
                    console.log("ar = " + arabic);
                    console.log("d = " + d);
                    if (english == true && arabic == true) {
                        console.log("true");
                        addCategory__.setAttribute("type", "submit");
                        addCategory__.classList.remove("disabled");
                    }
                }
            }
        });
    }
};