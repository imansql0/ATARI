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


function categoryEdit(id,name,description){
    document.getElementById("categoryName_edit").value = name;
    document.getElementById("categoryDescription_edit").value = description;
    document.getElementById("selected_category_id_update").value = id;
}

function updateCategory(){
    document.getElementById("editCategorySubmit").click();
}


function categoryDelete(id,name,description){
    document.getElementById("deleteText").innerText = `You are going to delete CATEGORY : {${name}}`;
    document.getElementById("deleteCategory_Id").value = id;
}

function deleteCategorySubmitClick(){
    document.getElementById("deleteCategorySubmit").click();
}