let username = document.querySelector("#username");
let email = document.querySelector("#email");
let password = document.querySelector('#pass');
let submit = document.querySelector("#submit");
let password_repeat = document.querySelector('#pass-repeat');
let input = document.querySelectorAll(".input");
submit.addEventListener("click",function(){
    $(function(){
            $.ajax({
                type: 'POST',
                url:'auth/logProces.inc.php',
                data : "what="+"signup"+"&email="+email.value+"&pass="+password.value+"&pass-repeat="+password_repeat.value+"&username="+username.value
              }).done(function (res) {
                    let what = res.split('§');
                    if (what[0] == "indice") {
                       if(what[1] =='succes'){
                        input.forEach(function(el){
                            el.classList.add("succes");
                        })           
                       }           
                    }else if(what[0] =='errorWithHeader'){
                        window.location = what[1]
                    }else if (what[0] == 'error'){
                        if(what[1] =="imptyInput"){
                            input.forEach(function(el){
                                el.classList.add("failed")
                            })
                        }else if(what[1] =="wrongEmail"){
                            input[1].classList.add("failed")
                        }else if(what[1] =="emailExist"){
                            input[1].classList.add("failed")
                        }else if(what[1] =="unmachedPassword"){
                            input[2].classList.add("failed")
                            input[3].classList.add("failed")
                        }else if(what[1] =="usernameExists"){
                            input[0].classList.add("failed")
                        }else {
                            window.location.reload();
                        }
                    }
                    
                }
               
                
        )}
    )})
    document.addEventListener("keydown",function(e){
        if(e.key == "Enter"){
            $(function(){
                $.ajax({
                    type: 'POST',
                    url:'auth/logProces.inc.php',
                    data : "what="+"signup"+"&email="+email.value+"&pass="+password.value+"&pass-repeat="+password_repeat.value+"&username="+username.value
                  }).done(function (res) {
                        let what = res.split('§');
                        if (what[0] == "indice") {
                           if(what[1] =='succes'){
                            input.forEach(function(el){
                                el.classList.add("succes");
                            })           
                           }           
                        }else if(what[0] =='errorWithHeader'){
                            window.location = what[1]
                        }else if (what[0] == 'error'){
                            if(what[1] =="imptyInput"){
                                input.forEach(function(el){
                                    el.classList.add("failed")
                                })
                            }else if(what[1] =="wrongEmail"){
                                input[1].classList.add("failed")
                            }else if(what[1] =="emailExist"){
                                input[1].classList.add("failed")
                            }else if(what[1] =="unmachedPassword"){
                                input[2].classList.add("failed")
                                input[3].classList.add("failed")
                            }else if(what[1] =="usernameExists"){
                                input[0].classList.add("failed")
                            }else {
                                window.location.reload();
                            }
                        }
                    }
                   
                    
            )}
        )
        }

    })