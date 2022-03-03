let img = document.querySelector("#userIMG");
if(userImg != ""){
    img.src = userImg;
}else{
    img.src = "IMG/download.jpg"
}
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
}else if(wher.includes("?ok=Profile")){
    navBtn[1].classList.add("active");
    async function getCodes(){
        const res = await fetch("https://restcountries.com/v2/all");
        const data = await res.json();
        let input = document.querySelector(".input");
       let select =  document.querySelector('.container')
       for (let i = 0; i < data.length; i++) {
           if(data[i].numericCode !="732" && data[i].numericCode !="376" ){
            const contryCode =data[i].alpha3Code;
           const callingCode = '+'+data[i].callingCodes;
           const flag = data[i].flags.png
           select.innerHTML +=`<div callingCode="${callingCode}" class="option">
                <div class="img"><img src=${flag} alt=""></div>
                <span>${contryCode}</span>
            </div>`  
            }
             if(data[i].callingCodes ==input.value){
                let input = document.querySelector(".input");
                input.value ='+' + data[i].callingCodes;
                document.querySelector("#cou").src =data[i].flags.png ;
            }
           
       }
    }
    
    async function select(){
        await getCodes();
        let option = await document.querySelectorAll(".option");
        let input = document.querySelector(".input");
        for (let i = 0; i < option.length; i++) {
            option[i].addEventListener("click",(e)=>{
            let code = e.currentTarget.getAttribute("callingcode");
            let cont = document.querySelector(".container")
            cont.classList.remove("set");
            arrow.style.transform = "rotateZ(0deg)";
            input.value =`${code}`
            console.log(e.currentTarget.querySelector(".img img").src);
            let flagg =  e.currentTarget.querySelector(".img img").src;
            document.querySelector("#cou").src = flagg;

            })
            
        }
        
        }
        
        select();
        let cont = document.querySelector(".container")
        let down = document.querySelector(".downn");
        let arrow = document.querySelector(".downn");
        down.addEventListener('click',()=>{
            if(cont.classList.contains("set")){
                cont.classList.remove("set");
                arrow.style.transform = "rotateZ(0deg)";
            }else{
                cont.classList.add("set");
                arrow.style.transform = "rotateZ(180deg)";
            }
        })

        let edit = document.querySelector("#edit"); 
        edit.addEventListener("click",()=>{
            let editBol = document.querySelector("#edit").getAttribute("edit"); 
            let box = document.querySelector(".pro");
            let email = document.querySelector("#email");
            let cellingCode = document.querySelector("#ext"); 
            let phone = document.querySelector("#phoneNbr");
            if(editBol == "true"){
                $(function(){  
                    if(email.value != '' && cellingCode.value != '' && phone.value !=''){
                        let phoneNbr = cellingCode.value+'/'+phone.value 
                        let dt;
                        if(reelEmail == email.value){
                          dt =   "what="+"editContactAdmin"+"&phoneNbr="+phoneNbr
                        }else{
                             dt = "what="+"editContactAdmin"+"&phoneNbr="+phoneNbr+"&email="+email.value
                        }
                        $.ajax({
                            type:'POST',
                            url:'auth/user-fun.inc.php',
                            data : dt
                        }).done(function (res){
                              console.log(res);
                            if(res == "editContactSucces"){
                                email.setAttribute("disabled",true);
                                phone.setAttribute("disabled",true);
                                edit.classList = "fa-solid fa-edit";
                                box.style.animation = "rotate .9s"
                                setTimeout(() => {
                                    box.style.animation = "none"
                                }, 1500);
                                window.location = "./auth/logout.inc.php"

                            }else if(res=="phoneNbrChanged"){
                                email.setAttribute("disabled",true);
                                phone.setAttribute("disabled",true);
                                edit.classList = "fa-solid fa-edit";
                                box.style.animation = "rotate .9s"
                                setTimeout(() => {
                                    box.style.animation = "none"
                                }, 1500);
                            }
                    })
                    }else{
                        email.style.backgroundColor = 'red';
                        phone.style.backgroundColor = 'red';
                        cellingCode.style.backgroundColor = 'red';
                    }
            })
            }else if(editBol == "false"){
                 email.removeAttribute("disabled");
                 phone.removeAttribute("disabled");
                 edit.setAttribute("edit","true");
                edit.classList = "fa-solid fa-check"
                box.style.animation = "rotate .9s"
            setTimeout(() => {
                box.style.animation = "none"
            }, 1500);
            }
            
        })

        let editAdd = document.querySelector("#editAdd");
        editAdd.addEventListener("click",()=>{
          let editbol = editAdd.getAttribute("edit");
          let firstName= document.querySelector("#firstName");
            let lastName = document.querySelector("#lastName");
            let address2 = document.querySelector("#phiAddress2");
            let address1 = document.querySelector("#phiAddress");
            let postal = document.querySelector("#postal");
            let city = document.querySelector("#city");
            let country = document.querySelector("#country");
          if(editbol == "true"){
            $(function(){   
                let fd = new FormData();
                if(firstName.value != "" && lastName.value != "" && address1.value != "" && postal.value != "" && city.value != "" && country.value != "" ){
                    fd.append("what","editAdditionalAdmin");
                    fd.append("firstName",firstName.value);
                    fd.append("lastName",lastName.value);
                    fd.append("address1",address1.value);
                    fd.append("postal",postal.value);
                    fd.append("city",city.value);
                    fd.append("country",country.value);
                }else{
                    firstName.style.backgroundColor ="red"
                }  
                if(address2.value!= ""){
                    fd.append("address2",address2.value);
                }
                $.ajax({
                    type: 'POST',
                    url:'auth/user-fun.inc.php',
                    data : fd,
                    contentType: false,
                    processData: false
                  }).done(function (res){
                   console.log(res);
                 if(res =="withSucces"){
                    editAdd.setAttribute('edit',"false");
                    editAdd.classList = "fa-solid fa-edit";
                    firstName.setAttribute("disabled","true");
                    lastName.setAttribute("disabled","true");
                    address1.setAttribute("disabled","true");
                    address2.setAttribute("disabled","true");
                    postal.setAttribute("disabled","true");
                    city.setAttribute("disabled","true");
                    country.setAttribute("disabled","true");
                 }
            })
        })

          }else{
              editAdd.setAttribute('edit',"true");
              editAdd.classList = "fa-solid fa-check";
              firstName.removeAttribute("disabled");
              lastName.removeAttribute("disabled");
              address1.removeAttribute("disabled");
              address2.removeAttribute("disabled");
              postal.removeAttribute("disabled");
              city.removeAttribute("disabled");
              country.removeAttribute("disabled");
          }
        })

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

let change = document.querySelector(".user-img");
change.addEventListener('mouseenter' ,()=>{
    let upload = document.querySelector(".imgChange");
    upload.style.opacity = "1";
})
change.addEventListener('mouseleave' ,()=>{
    let upload = document.querySelector(".imgChange");
    upload.style.opacity = "0";
})

document.querySelector("#changee").onchange = ()=>{
    let file = document.querySelector("#changee").files;
    if(file[0].type == "image/png" || file[0].type == "image/jpg" || file[0].type == "image/jpeg" ){
        $(function(){
            let fd = new FormData();
            fd.append("what","changeImgAdmin");
            fd.append("img",file[0]);
            $.ajax({
                type: 'POST',
                url:'auth/user-fun.inc.php',
                data : fd,
                contentType: false,
                processData: false
            }).done(function(res){
                console.log(res);
                if(res == "donesuccesfuly"){
                    let img = document.querySelector("#userIMG");
                    img.src = "uplaodedImg/"+file[0].name;
                }
            })
        })
    }else{
        console.log('it not an image');
    }
};



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
       }else if(location == "profile"){
        window.location = "./admin-home.php?ok=Profile"
       }
    })
    
}
