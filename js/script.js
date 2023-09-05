function systemadminnavclick(id){
    if(id == "dashboard"){
        window.location.replace("dashboard.php");
    }else if(id == "product"){
        window.location.replace("product.php");
    }else if(id == "category"){
        window.location.replace("category.php");
    }
}


function userLogin(){
    document.getElementById("loginButton").click();
}
function userLogout(){
    document.getElementById("logoutButton").click();
    
}
function submitCategory(){
    document.getElementById("submit").click();
}

function saveCategory(){
    document.getElementById("addCategory").click();
}