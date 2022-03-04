let email = document.querySelector("#email");
let password = document.querySelector('#pass');
let submit = document.querySelector("#submit");
let input = document.querySelectorAll(".input");
submit.addEventListener("click",function(){

    $(function(){
            $.ajax({
                type: 'POST',
                url:'auth/logProces.inc.php',
                data : "what="+"login"+"&email="+email.value+"&pass="+password.value
              }).done(function (res){
                if(res == 'incorrect'){
                    input[0].style.border ='2px solid #ff000052';
                    input[1].style.border = '2px solid #ff000052'
                    input[0].style.backgroundColor ='#ff00002e';
                    input[1].style.backgroundColor = '#ff00002e'

                }else  if(res == 'emptyInput'){
                    input[0].style.border ='2px solid #ff000052';
                    input[1].style.border = '2px solid #ff000052'
                    input[0].style.backgroundColor ='#ff00002e';
                    input[1].style.backgroundColor = '#ff00002e'

                }else {
                    let what = res.split('§');
                    if (what[0] == "succes") {
                        window.location = what[1];    
                    }
                }
                
        })
        }
    )})
    
    document.addEventListener("keydown",function(e){
        if(e.key == "Enter"){
            $(function(){
                $.ajax({
                    type: 'POST',
                    url:'auth/logProces.inc.php',
                    data : "what="+"login"+"&email="+email.value+"&pass="+password.value
                  }).done(function (res){
                    if(res == 'incorrect'){
                        input[0].style.border ='2px solid #ff000052';
                        input[1].style.border = '2px solid #ff000052'
                        input[0].style.backgroundColor ='#ff00002e';
                        input[1].style.backgroundColor = '#ff00002e'
    
                    }else  if(res == 'emptyInput'){
                        input[0].style.border ='2px solid #ff000052';
                        input[1].style.border = '2px solid #ff000052'
                        input[0].style.backgroundColor ='#ff00002e';
                        input[1].style.backgroundColor = '#ff00002e'
    
                    }else {
                        let what = res.split('§');
                        if (what[0] == "succes") {
                            window.location = what[1];
                            
                        }
                    }
                    
            })
            }
        ) 
        }
        })