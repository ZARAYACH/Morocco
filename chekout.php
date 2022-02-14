<?php
if(isset($_COOKIE['logined'])){
    if($_COOKIE['logined']){
        // echo 'yeah';
    }else{
        // echo 'IT FALSE';
    }
}else{
    // echo 'NO';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/chekout.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://kit.fontawesome.com/8b4d616e93.js" crossorigin="anonymous"></script>
    <title>Chekout</title>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="back">
                    <div class="click">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    <p>Continu exploring</p> 
                    </div>
                </div>
            <div class="head" > 
                <div class="title">
                 <h1>waiting your reservation! </h1>
                 <span>you have <!--number from database -->1 trips in your list</span>
                </div>      
                <div class="sort">
                    <p>Sort By :</p>
                    <select name="" id="">
                        <option value="price">Price</option>
                        <option value="data">Date</option>
                    </select>

                </div> 
                </div>
                
               <div class="cards_container">
               <div class="card">
                    <div class="img"><img src="./IMG/835a014c3ce140d01c1d2b4e4b913487.jpg" alt="" srcset=""></div>
                    <div class="card_title">
                        <div class="trip_title">TO marakeck</div>
                        <div class="trip_destination">Lorem, ipsum dolor.</div>
                    </div>
                    <div class="Number">
                        <div id="plus"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>
                        <div class="person">1</div>
                        <div id="minus"><i class="fa fa-minus-circle" aria-hidden="true"></i></div>
                    </div>
                    <div class="price"><span id="currency">$</span>999.99</div>
                    <div class="delete"><i class="fa-solid fa-trash-can"></i></div>
                </div> 


                
               </div>
        
        </div>
        <div class="right">
            <div class="right_head">
                <div class="right_title">card details</div>
                <div class="UserImg"><img src="./IMG/pic1.png" alt=""></div>
            </div>
            <div class="ways">
            <p>card type :</p>
               <div class="cards">
                   <div id="pay">
                    <i  class="fa-brands fa-cc-mastercard"></i>
                    <span id="selected"><i class="material-icons">check_circle</i></span>

                </div>
                <div class="active" id="pay" >
                <i class="fa-brands fa-cc-visa"></i>
                    <span class="active" id="selected"><i class="material-icons">check_circle</i></span>
                   
                </div>
                <div id="pay">
                <i class="fa-brands fa-cc-paypal"></i>
                    <span id="selected"><i class="material-icons">check_circle</i></span>
                  
                </div>
               </div>
                </div>
                <div class="form">
                    <label for="holder-name">card holder name</label>
                    <input id="holder-name" type="text" placeholder="Tom Hanks">
                    <label for="card-number">Card Number</label>
                    <input id="card-number" type="text" inputmode="numeric" placeholder="1111 2222 3333 4444">
                    <div class="para">
                        <div class="para_1">
                        <label for="experation-date">Experation Date</label>
                        <div class="exp-wrapper">
                                <input autocomplete="off" class="exp" id="month" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="MM" type="text" data-pattern-validate />
                                <input autocomplete="off" class="exp" id="year" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="YY" type="text" data-pattern-validate />
                        </div>
                        </div>
                        <div class="para_2">
                        <label for="cvv">cvv</label>
                            <input id="cvv" maxlength="3" inputmode="numeric" type="text" pattern="[0-9]{3}" placeholder="123" >
                        </div>
                    </div>
                </div>
                <div class="summary">
                    <div class="extra">
                        <p>Sub Total </p>
                        <span>TOTAL</span>
                    </div>
                    <div class="extra">
                        <p>Extra charge</p>
                        <span>TOTAL</span>
                    </div>
                    <div class="extra">
                        <p>Total </p>
                        <span id="total" >TOTAL</span>
                    </div>
                </div>
                <div class="validate">
                    <span id="total">$total</span>
                <span id="bla">chekout<i class="fa fa-arrow-right" aria-hidden="true"></i> </span>
                
            </a>
        </div>
            </div>
        </div>
    </div>

    <script src="JS\chekout.js"></script>
</body>
</html>