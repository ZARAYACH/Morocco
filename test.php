<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="CSS/all.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: gray;
        }
        .select{
            width: 8rem;
            height: 2rem;
            border: 1px solid black;
            padding: .5rem;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            background-color: white;
            border: none;
        }
        .cou{
            width: 40%;
            height: inherit;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #cou{
            max-width: 100%;
            height: 100%;
        }
        .select input{
            width: 50%;
            border: none;
            height: inherit;
            border: none;
        }
        .select i{
            width: 10%;
            margin-left: .3rem;
            cursor: pointer;
        }

        .container{
            border: 1px solid black;
            width: 9rem;
            height: 0rem;
            position: absolute;
            top: 3rem;
            left: 0;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            overflow-y: scroll;
            flex-direction: column; 
            border: none; 
            transition: .5s;
        }
        .set{
            height: 12rem !important;
            
        }
        
        
        .option{
            width: 100%;
            height: 3rem;
            display: flex;
            align-items: flex-start;
            justify-content: space-evenly;
            cursor : pointer ;
        }
        .option .img{
            width: 40%;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;

        }
        .option .img img{
            max-width: 100%;
            object-fit: cover;
            max-height: 100%;
            text-align: center;

        }
        .option span{
            width: 50%;
        }

    </style>

    <div class="select"> 
        <div class="cou"><img id="cou" src="" alt=""></div>
        <input class="input" type="text">
        <i class="fa fa-arrow-down down" aria-hidden="true"></i>

        <div class="container">
    
    </div>
    </div>
    

    <script>
    async function getCodes(){
    const res = await fetch("https://restcountries.com/v2/all");
    const data = await res.json();
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
        input.value =`${code}`
        console.log(e.currentTarget.querySelector(".img img").src);
        let flagg =  e.currentTarget.querySelector(".img img").src;
        document.querySelector("#cou").src = flagg;
        })
        
    }
    
    }
    
    select();

    let down = document.querySelector(".down");
    down.addEventListener('click',()=>{
        let cont = document.querySelector(".container")
        if(cont.classList.contains("set")){
            cont.classList.remove("set");
        }else{
            cont.classList.add("set");
        }
    })




    </script>

    
</body>
</html>