
////////////////////////////////
// Password 
var mangerPass_ = document.getElementById("mangerPass");
var managerRpass_ = document.getElementById("managerRpass");
var managerMatched__ = document.getElementById("managerMatched__");
var managerNotMatched__ = document.getElementById("managerNotMatched__");
var UpdateManager_ = document.getElementById("UpdateManager");

mangerPass_.onkeyup = function() {
    if (managerRpass_.value === mangerPass_.value) {
        console.log("done");
        managerNotMatched__.style.display = "none";
        managerMatched__.style.display = "block";
        managerRpass_.style.borderColor = "green";
        UpdateManager_.setAttribute("type", "submit");
        UpdateManager_.classList.remove("disabled");
    }
    else {
        console.log("not done");
        managerMatched__.style.display = "none";
        managerNotMatched__.style.display = "block";
        managerRpass_.style.borderColor = "red";
        UpdateManager_.setAttribute("type", "button");
        UpdateManager_.classList.add("disabled");
    }
};

managerRpass_.onkeyup = function() {
    if (managerRpass_.value === mangerPass_.value) {
        managerNotMatched__.style.display = "none";
        managerMatched__.style.display = "block";
        managerRpass_.style.borderColor = "green";
        UpdateManager_.setAttribute("type", "submit");
        UpdateManager_.classList.remove("disabled");
    }
    else {
        managerMatched__.style.display = "none";
        managerNotMatched__.style.display = "block";
        managerRpass_.style.borderColor = "red";
        UpdateManager_.setAttribute("type", "button");
        UpdateManager_.classList.add("disabled");
    }
};