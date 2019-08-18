var pwd_ = document.getElementById("adminPass");
var rpwd_ = document.getElementById("adminRpass");
var signUp_ = document.getElementById("addAdmin");
var matched_ = document.getElementsByClassName("myEmailFoundBefore_1");
var notMateched_ = document.getElementsByClassName("myEmailFoundBefore_2");
var myEmail = document.getElementById("adminEmail");
var signEmail = false;
var signPassword = false;
// Email
myEmail.onkeyup = function () {
    'use strict';
    if (myEmail.value === "") {
        console.log("empty");
    } else {
        var arr1 = myEmail.value.split("@");
        var input_ = arr1[1];
        var lotus = "lotus.com";
        var email_admin = myEmail.value.slice(0,5);
        var admin = "admin";
        console.log("not empty");
        var dataString = 'email=' + myEmail.value;
        $.ajax({
            type: "POST",
            url: "../Controllers/checkAdminController.php",
            data: dataString,
            cache: false,
            success: function (d) {
                if (d === "This email is already used" || d ==="هذا البريد الالكتروني مستخدم سابقا") {
                    notMateched_[0].style.display = "block";
                    notMateched_[0].innerHTML = d;
                    signEmail = false;
                    if (signEmail == true || signPassword == false) {
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                    } else if (signEmail == false || signPassword == true) {
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                    } else if (signEmail == false || signPassword == false) {
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                    } else {
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                    }
                    if(input_ !== lotus || email_admin !== admin) {
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                        console.log("please enter the email like this: example@lotus.com");
                    }
                } else {
                    notMateched_[0].style.display = "none";
                    signEmail = true;
                    if (signEmail == true && signPassword == true && input_ === lotus && email_admin === admin) {
                        console.log("true");
                        signUp_.setAttribute("type", "submit");
                        signUp_.classList.remove("disabled");
                    } else if (input_ !== lotus || email_admin !== admin){
                        signUp_.setAttribute("type", "button");
                        signUp_.classList.add("disabled");
                        notMateched_[0].style.display = "block";
                        notMateched_[0].innerHTML = "please enter the email like this: adminExample@lotus.com" + email_admin;
                    }
                }
            }
        });
    }
};
pwd_.onkeyup = function () {
    'use strict';
    if (rpwd_.value !== "") {
        if (rpwd_.value === pwd_.value) {
            notMateched_[1].style.display = "none";
            matched_[1].style.display = "block";
            rpwd_.style.borderColor = "green";
            signPassword = true;
            if (signEmail === true && signPassword === true) {
                console.log("true");
                signUp_.setAttribute("type", "submit");
                signUp_.classList.remove("disabled");
            }
        } else {
            matched_[1].style.display = "none";
            notMateched_[1].style.display = "block";
            rpwd_.style.borderColor = "red";
            signPassword = false;
            if (signEmail === true || signPassword === false) {
                signUp_.setAttribute("type", "button");
                signUp_.classList.add("disabled");
            } else if (signEmail === false || signPassword === true) {
                signUp_.setAttribute("type", "button");
                signUp_.classList.add("disabled");
            } else if (signEmail === false || signPassword === false) {
                signUp_.setAttribute("type", "button");
                signUp_.classList.add("disabled");
            } else {
                signUp_.setAttribute("type", "button");
                signUp_.classList.add("disabled");
            }
        }
    }
};
// Password 
rpwd_.onkeyup = function () {
    'use strict';
    if (rpwd_.value === pwd_.value) {
        notMateched_[1].style.display = "none";
        matched_[1].style.display = "block";
        rpwd_.style.borderColor = "green";
        signPassword = true;
        if (signEmail === true && signPassword === true) {
            console.log("true");
            signUp_.setAttribute("type", "submit");
            signUp_.classList.remove("disabled");
        }
    } else {
        matched_[1].style.display = "none";
        notMateched_[1].style.display = "block";
        rpwd_.style.borderColor = "red";
        signPassword = false;
        if (signEmail === true || signPassword === false) {
            signUp_.setAttribute("type", "button");
            signUp_.classList.add("disabled");
        } else if (signEmail === false || signPassword === true) {
            signUp_.setAttribute("type", "button");
            signUp_.classList.add("disabled");
        } else if (signEmail === false || signPassword === false) {
            signUp_.setAttribute("type", "button");
            signUp_.classList.add("disabled");
        } else {
            signUp_.setAttribute("type", "button");
            signUp_.classList.add("disabled");
        }
    }
};
signUp_.onclick = function() {
    'use strict';
    var arr1 = myEmail.value.split("@");
    var input_ = arr1[1];
    var lotus = "lotus.com";
    if(input_ !== lotus) {
        console.log("please enter the email like this: example@lotus.com");
    } else {
        console.log("success");
    }
};