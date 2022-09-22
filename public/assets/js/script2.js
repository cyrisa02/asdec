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


// API - SearchBar with the Post

const postCardTemplate = document.querySelector("[data-post-template]")
const postCardContainer = document.querySelector("[data-post-cards-container]")
const searchInput = document.querySelector("[data-search]")
let posts = []
searchInput.addEventListener("input", e => {   
    const value = e.target.value.toLowerCase()
    posts.forEach(post => {         
        const isVisible = post.content.toLowerCase().includes(value) || post.author.toLowerCase().includes(value)
        //console.log(post.element.classList)
        post.element.classList.toggle("d-none", !isVisible )
    })    
})
 fetch('https://asdecgrh.herokuapp.com/api/posts?page=1')
.then(res => res.json())
.then(data => { return data['hydra:member']})
.then(data1=> {
   posts = data1.map(post => {     
        const card = postCardTemplate.content.cloneNode(true).children[0]
         const header = card.querySelector("[data-header]")
         const body = card.querySelector("[data-body]")
         
         header.textContent= post.content 
         body.textContent= post.author 
         
         postCardContainer.append(card)
         return { content: post.content, author: post.author, element: card}
         })
 })