let navBtn = document.querySelectorAll(".click");
let wher = window.location.search;
if(!wher.includes("?ok=")){
    window.location = "./admin-home.php?ok=home";
}
if(wher.includes("?ok=home")){
    navBtn[0].classList.add("active");
   
}else if(wher.includes("?ok=search")){
    navBtn[3].classList.add("active");
    let destination = document.querySelector("#destinations");
destination.addEventListener('change',()=>{
    $(function(){   
        let value= destination.value;
        let date = document.querySelector("#timeDepart").value;
        let fd = new FormData();
        if(date === ""){
            fd.append("what","search");
            fd.append("value",value);
        }else{
         fd.append("what","search");
         fd.append("value",value);
         fd.append("date",date);
        }  
        $.ajax({
            type: 'POST',
            url:'auth/user-fun.inc.php',
            data : fd,
            contentType: false,
            processData: false
          }).done(function (res){
            let tbody = document.querySelector("tbody");
            tbody.innerHTML = res;
    })
})})
let dateBtn = document.querySelector("#timeDepart");
dateBtn.addEventListener('change',()=>{
    $(function(){   
        let date = document.querySelector("#timeDepart").value;
        let fd = new FormData();
        if(date === ""){
            
        }else{
         fd.append("what","search");
         fd.append("date",date);
         $.ajax({
            type: 'POST',
            url:'auth/user-fun.inc.php',
            data : fd,
            contentType: false,
            processData: false
          }).done(function (res){
            let tbody = document.querySelector("tbody");
            if(res){
                tbody.innerHTML = res;
            }else{
                tbody.innerHTML = "<tr><td style='opacity: .6 ;text-align:center; ' colspan=6>we are sorry right know we don't have any trip match your specifications</td></tr>";
            }
        }  
)}})})

let btnAll = document.querySelector("#all");
btnAll.addEventListener('click',()=>{
    $(function(){   
        $.ajax({
            type: 'POST',
            url:'auth/user-fun.inc.php',
            data : "what="+"displayAll"
          }).done(function (res){
            let tbody = document.querySelector("tbody");
            tbody.innerHTML = res;
    })
})
})

}else if(wher.includes("?ok=controle")){
    navBtn[2].classList.add("active");
    let deleteBtn = document.querySelectorAll(".delete i");
    for (let i = 0; i < deleteBtn.length; i++) {
        deleteBtn[i].addEventListener("click" ,(e)=>{
            console.log(e.currentTarget.getAttribute('tripId'));
           let tripId = e.currentTarget.getAttribute('tripId');
           $(function(){   
            $.ajax({
                type: 'POST',
                url:'auth/user-fun.inc.php',
                data : "what="+"deleteTrip"+"&tripId="+tripId
              }).done(function (res){
                
                if(res != false){
                    let tbody = document.querySelector("tbody");
                tbody.innerHTML = res;
                }
        })
    })
        })
        
    }
}


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
        nav[0].style.width = "16rem";
        nav[1].style.width = "16rem";
    })
    
}
for (let i = 0; i < nav.length; i++) {
    nav[i].addEventListener('mouseleave',(e)=>{
        nav[0].style.width = "4.5rem";
        nav[1].style.width = "4.5rem";
    })
    
}
for (let i = 0; i < navBtn.length; i++) {
    navBtn[i].addEventListener('click',(e)=>{
       let location = e.currentTarget.getAttribute("location");
       if(location =='home'){
           let main = document.querySelector(".main");
            window.location = "./admin-home.php?ok=home"
       }else if(location == "search"){
        window.location = "./admin-home.php?ok=search"
       }else if(location == "controle"){
        window.location = "./admin-home.php?ok=controle"
       }
    })
    
}