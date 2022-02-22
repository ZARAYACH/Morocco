let navBtn = document.querySelectorAll(".click");
for (let i = 0; i < navBtn.length; i++) {
    navBtn[i].addEventListener('click',function(e){
        let currentNavBtn = e.currentTarget;
        if(!currentNavBtn.classList.contains("active")){
            for(let j = 0; j < navBtn.length;j++){
                if(navBtn[j].classList.contains("active")){
                    navBtn[j].classList.remove("active")
                }
            }
            currentNavBtn.classList.add("active")
        }
        
    })
    
}
let nav = document.querySelectorAll("ul");
for (let i = 0; i < nav.length; i++) {
    nav[i].addEventListener('mouseenter',(e)=>{
        nav[0].style.width = "12rem";
        nav[1].style.width = "12rem";
    })
    
}
for (let i = 0; i < nav.length; i++) {
    nav[i].addEventListener('mouseleave',(e)=>{
        nav[0].style.width = "4rem";
        nav[1].style.width = "4rem";
    })
    
}