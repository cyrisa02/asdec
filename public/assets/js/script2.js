// Filter disable /Enable Partner

const showEnable = () =>{
    let partners = document.getElementsByClassName("partner");
    
    for (i=0; i < partners.length; i++) {
       
        if (partners[i].classList.contains("active")){
            partners[i].style.display= "block";
        }
        else {
             partners[i].style.display= "none";
        }
    }
}
const showDisable = () =>{
    let partners = document.getElementsByClassName("partner");
    
    for (i=0; i < partners.length; i++) {
       
        if (partners[i].classList.contains("active")){
            partners[i].style.display= "none";
        }
        else {
             partners[i].style.display= "block";
        }
    }
}
const showAll = () =>{
    let partners = document.getElementsByClassName("partner");
    
    for (i=0; i < partners.length; i++) {

        partners[i].style.display= "block";
       
       
    }
}


window.onload= () => {
let buttonEnable = document.getElementById("enable");

buttonEnable.addEventListener("click", showEnable);

let buttonDisable = document.getElementById("disable");

buttonDisable.addEventListener("click", showDisable);

let buttonAll= document.getElementById("all");

buttonAll.addEventListener("click", showAll);

}