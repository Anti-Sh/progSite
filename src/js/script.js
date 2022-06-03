function switchScreen(elID){
    let reg = document.getElementById("reg__page");
    let auth = document.getElementById("auth__page");
    if(elID == 0){
        auth.classList.add("hide");
        reg.classList.remove("hide");
    }
    else{
        reg.classList.add("hide");
        auth.classList.remove("hide")
    }
}
function openProfile(){
    let profile = document.getElementById("profile_div");
    let nav_item = document.getElementById("prof__outer");
    nav_item.classList.add("active");
    profile.classList.remove("hide");
}
function closeProfile(){
    let profile = document.getElementById("profile_div");
    let nav_item = document.getElementById("prof__outer");
    nav_item.classList.remove("active");
    profile.classList.add("hide");
}
if(el = document.getElementById("profile_text")){
    el.addEventListener("click",function(e){
        e.preventDefault();
        openProfile();
    });
}
