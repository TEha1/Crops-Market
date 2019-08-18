// Password 
var pwd_ = document.getElementById("pass");
var rpwd_ = document.getElementById("rpass");
var notMateched_ = document.getElementById("not_matched");
var matched_ = document.getElementById("matched_");
var signUp_ = document.getElementById("update");

pwd_.onkeyup = function() {
    if (rpwd_.value === pwd_.value) {
        notMateched_.style.display = "none";
        matched_.style.display = "block";
        rpwd_.style.borderColor = "green";
        signUp_.setAttribute("type", "submit");
        signUp_.classList.remove("disabled");
    }
    else {
        matched_.style.display = "none";
        notMateched_.style.display = "block";
        rpwd_.style.borderColor = "red";
        signUp_.setAttribute("type", "button");
        signUp_.classList.add("disabled");
    }
};

rpwd_.onkeyup = function() {
    if (rpwd_.value === pwd_.value) {
        notMateched_.style.display = "none";
        matched_.style.display = "block";
        rpwd_.style.borderColor = "green";
        signUp_.setAttribute("type", "submit");
        signUp_.classList.remove("disabled");
    }
    else {
        matched_.style.display = "none";
        notMateched_.style.display = "block";
        rpwd_.style.borderColor = "red";
        signUp_.setAttribute("type", "button");
        signUp_.classList.add("disabled");
    }
};
