function systemadminnavclick(id){
    if(id == "dashboard"){
        window.location.replace("dashboard.php");
    }else if(id == "product"){
        window.location.replace("product.php");
    }else if(id == "category"){
        window.location.replace("category.php");
    }else if(id == "userlist"){
        window.location.replace("userlist.php");
    }else if(id == "orders"){
        window.location.replace("orders.php");
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
function saveproduct(){
    document.getElementById("addproduct").click();
}


function categoryEdit(id,name,description){
    document.getElementById("categoryName_edit").value = name;
    document.getElementById("categoryDescription_edit").value = description;
    document.getElementById("selected_category_id_update").value = id;
}

function productEdit(id,PItemCode,PName,PQuantity,Pstock,PPrice,PProfit){
    
    document.getElementById("ProductItemCode_edit").value = PItemCode;
    document.getElementById("ProductName_edit").value = PName;
    document.getElementById("ProductQuantity_edit").value = PQuantity;
    document.getElementById("ProductStock_edit").value = Pstock;
    document.getElementById("ProductPrice_edit").value = PPrice;
    document.getElementById("ProductProfit_edit").value = PProfit;
    document.getElementById("selected_category_id_update").value = id;
}
function userEdit(id,usertype,username,password,userkey){
    
    document.getElementById("usertypeedit").value = usertype;
    document.getElementById("usernameedit").value = username;
    document.getElementById("passwordedit").value = password;
    document.getElementById("userkeyedit").value = userkey;
    document.getElementById("selected_category_id_update").value = id;
}

function updateCategory(){
    document.getElementById("editCategorySubmit").click();
}
function updateProduct(){
    
    document.getElementById("editCategorySubmit").click();
    
}
function updateuser(){
    
    document.getElementById("editCategorySubmit").click();
    
}



function categoryDelete(id,name,description){
    document.getElementById("deleteText").innerText = `You are going to delete CATEGORY : {${name}}`;
    document.getElementById("deleteCategory_Id").value = id;
}
function ProductDelete(id,PItemCode,PName,PQuantity,Pstock,PPrice,PProfit){
    
    document.getElementById("deleteText").innerText = `You are going to delete Product : {${PName}}`;
    document.getElementById("deleteCategory_Id").value = id;
}
function userDelete(id,usertype,username,password,userkey){
    
    document.getElementById("deleteText").innerText = `You are going to delete Product : {${username}}`;
    document.getElementById("deleteCategory_Id").value = id;
}

function deleteCategorySubmitClick(){
    document.getElementById("deleteCategorySubmit").click();
}