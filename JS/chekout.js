
<<<<<<< HEAD
let plus = document.querySelectorAll(".plus");
plus.forEach(function(el){
  el.addEventListener('click', function(e){
    let nplus =  e.currentTarget.getAttribute('data-id-trip');
    let qun = document.querySelector(`[data-id-person='${nplus}']`).innerHTML;
    let prix =  document.querySelector(`[data-id-prix='${nplus}']`).getAttribute("price_one");
    prix=prix/1;
    qun = qun/1
    qun +=1
    prix = prix *qun;
  document.querySelector(`[data-id-person='${nplus}']`).innerHTML = qun; 
  document.querySelector(`[data-id-prix='${nplus}']`).innerText = prix; 
  updateTotals();
=======
let plus = document.querySelector("#plus");
plus.addEventListener('click',function(){
  let qun = document.querySelector(".person").innerHTML;
  qun = qun/1
  qun +=1
  document.querySelector(".person").innerHTML = qun;  
}) 
let minus = document.querySelector("#minus");
minus.addEventListener('click',function(){
  let qun = document.querySelector(".person").innerHTML;
  qun = qun/1
  if(qun!=1){
    qun -=1
    document.querySelector(".person").innerHTML = qun;  
  }
 
}) 
>>>>>>> beeb666646453e6a330bc16fd9ab2e167c4ab8eb

    })
})
let minus = document.querySelectorAll(".minus");
minus.forEach(function(el){
  el.addEventListener('click', function(e){
    let nminus =  e.currentTarget.getAttribute('data-id-trip');
    let qun = document.querySelector(`[data-id-person='${nminus}']`).innerHTML;
    let prix =  document.querySelector(`[data-id-prix='${nminus}']`).getAttribute("price_one");
  if(qun !=1){
    qun = qun/1
    prix=prix/1;
    qun -=1
    prix = prix *qun;
    document.querySelector(`[data-id-person='${nminus}']`).innerHTML = qun;  
    document.querySelector(`[data-id-prix='${nminus}']`).innerText = prix; 
    updateTotals();

  }
  
    })
})
let dele = document.querySelectorAll(".delete");
dele.forEach((el)=>{
  el.addEventListener('click',(e)=>{
    let cardTrip = e.currentTarget.parentNode;
    let tripId=e.currentTarget.parentNode.getAttribute('trip');
    $(function(){     
            $.ajax({
                type: 'POST',
                url:'auth/user-fun.inc.php',
                data:'what='+"del"+'&tripId='+tripId
              }).done(function (res){
                  if(res){    
                     cardTrip.remove();
                     updateTotals();
                     nbrOnCart();
                   }
                 
             })
})})})
updateTotals();

function updateTotals(){
  let subTotal = document.querySelector("#subTotal");
  let prix = document.querySelectorAll(".prix");
  let subTotals = 0/1;
  prix.forEach((el)=>{
    ee=el.innerText/1
    subTotals += ee;
  })
  subTotal.innerText = subTotals;
  let extra = document.querySelector("#extra_charges");
  if(subTotal.innerText!=0){
    let m = 10;
    extra.innerText = m;
  }else{
    let m = 0;
    extra.innerText = m;
  }
  

  let total = document.querySelectorAll("#total");
  total.forEach((el)=>{
    let t = subTotals/1 + extra.innerText/1 ;
    el.innerText = '$'+t
  })
  
}
function nbrOnCart(){
  let nbr = document.querySelector("#nbr");
  let cards = document.querySelectorAll(".card");
  nbr.innerText = cards.length;
}
nbrOnCart();

let btnValidate = document.querySelector(".validate");
btnValidate.addEventListener('click',function(){
  let holderName = document.querySelector("#holder-name").value;
  let cardNumber = document.querySelector("#card-number").value;
  let month = document.querySelector("#month").value;
  let year = document.querySelector("#year").value;
  let cvv = document.querySelector("#cvv").value;
  let toBebooked = document.querySelectorAll(".card");
  let formData = new FormData();  
 for (let i = 0; i < toBebooked.length; i++) {
   formData.append('tripId[]',toBebooked[i].getAttribute("trip")); 
 }
 formData.append("userId",userId)
 formData.append("holderName",holderName);
 formData.append("cardNumber",cardNumber);
 formData.append("month",month);
 formData.append("year",year);
 formData.append("cvv",cvv);
 formData.append('what','booking');
  $(function(){   
    $.ajax({
        type: 'POST',
        url:'auth/user-fun.inc.php',
        data:formData,
        contentType: false,
        processData: false
       }).done(function(res){
          if(res){      
            console.log(res)
             
           }
         
     })
})
})


















































// FOR THE CARD EXPIRATION

const monthInput = document.querySelector('#month');
const yearInput = document.querySelector('#year');

const focusSibling = function(target, direction, callback) {
  const nextTarget = target[direction];
  nextTarget && nextTarget.focus();
  // if callback is supplied we return the sibling target which has focus
  callback && callback(nextTarget);
}

// input event only fires if there is space in the input for entry. 
// If an input of x length has x characters, keyboard press will not fire this input event.
monthInput.addEventListener('input', (event) => {

  const value = event.target.value.toString();
  // adds 0 to month user input like 9 -> 09
  if (value.length === 1 && value > 1) {
      event.target.value = "0" + value;
  }
  // bounds
  if (value === "00") {
      event.target.value = "01";
  } else if (value > 12) {
      event.target.value = "12";
  }
  // if we have a filled input we jump to the year input
  2 <= event.target.value.length && focusSibling(event.target, "nextElementSibling");
  event.stopImmediatePropagation();
});

yearInput.addEventListener('keydown', (event) => {
  // if the year is empty jump to the month input
  if (event.key === "Backspace" && event.target.selectionStart === 0) {
    focusSibling(event.target, "previousElementSibling");
    event.stopImmediatePropagation();
  }
});

const inputMatchesPattern = function(e) {
  const { 
    value, 
    selectionStart, 
    selectionEnd, 
    pattern 
  } = e.target;
  
  const character = String.fromCharCode(e.which);
  const proposedEntry = value.slice(0, selectionStart) + character + value.slice(selectionEnd);
  const match = proposedEntry.match(pattern);
  
  return e.metaKey || // cmd/ctrl
    e.which <= 0 || // arrow keys
    e.which == 8 || // delete key
    match && match["0"] === match.input; // pattern regex isMatch - workaround for passing [0-9]* into RegExp
};

document.querySelectorAll('input[data-pattern-validate]').forEach(el => el.addEventListener('keypress', e => {
  if (!inputMatchesPattern(e)) {
    return e.preventDefault();
  }
}));
