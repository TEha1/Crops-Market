var pwd_ = document.getElementById("pwd");
var rpwd_ = document.getElementById("rpwd");
var signUp_ = document.getElementById("signUp");
var matched_ = document.getElementsByClassName("matched");
var notMateched_ = document.getElementsByClassName("not_matched");
var myEmail = document.getElementById("email");
var signEmail = false;
var signPassword = false;
// Email
myEmail.onkeyup = function () {
    'use strict';
    if (myEmail.value === "") {
        console.log("empty");
    } else {
        console.log("not empty");
        var dataString = 'email=' + myEmail.value;
        $.ajax({
            type: "POST",
            url: "../Controllers/checkEmailController.php",
            data: dataString,
            cache: false,
            success: function (d) {
                if (d === "This email is already used" || d==="هذا البريد الالكتروني مستخدم سابقا") {
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
                } else {
                    notMateched_[0].style.display = "none";
                    signEmail = true;
                    if (signEmail == true && signPassword == true) {
                        console.log("true");
                        signUp_.setAttribute("type", "submit");
                        signUp_.classList.remove("disabled");
                    }
                }
            }
        });
        //  activeSignUpBtn(signEmail, signPassword);
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
    // activeSignUpBtn(signEmail, signPassword);
};

function activeSignUpBtn(signEmail, signPassword) {
    if (signEmail === true && signPassword === true) {
        console.log("true");
        signUp_.setAttribute("type", "submit");
        signUp_.classList.remove("disabled");
    } else if (signEmail === true || signPassword === false) {
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
