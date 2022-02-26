<?php
session_start();
require_once './classes/trips.cls.php';
if(isset($_SESSION['selled'])){
    $selled = unserialize($_SESSION['selled']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .wrapper{
        width: 100%;
        height: 100vh;
        display: flex;
       
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background-color: white;
    }
    .pp{
        width: 40%;
        height: 10rem;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .logo{
        width: 80%;
        height: 8rem;
    }
    .logo img{
        max-width: 100%;
        max-height: 100%;
    } 
    .text{
        width: 100%;
        font-size: 1.5rem;
        font-weight: 600;
    }
    
</style>
<body>


<div class="wrapper">
    <div class="pp">
        <div class="logo"><img src="./IMG/done-text-green-grungy-vintage-rectangle-stamp-done-text-green-grungy-vintage-stamp-214435444.jpg" alt=""> </div>
        <div class ="text">wait your Tikets will be soon availaible </div>
    </div>
</div>

    <div id="element" >
        <H1>YOUR TIKETS</H1>
    <table  border=1 class="table" style="width: 100%;border-collapse:collapse;">
          <thead>
        <tr>
            <th >name</th>
            <th >qte</th>
            <th >price</th>
            <th >totle</th>
            <th >Time depart</th>
        </tr>
    </thead>
    <tbody>
       <?php trips::displayPurchade($selled); ?> 
        

    </tbody>
          </table>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"></script>
    <script>
        var element = document.querySelector('#element');


        html2pdf(element, {
            margin: 10,
            filename: 'AhsanPdf.pdf',
            image: {type: 'jpeg', quality: 0.98 },
            html2pdf: { scale: 2, logging: true, dpi: 192, letterRendering: true },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        });
    </script>
</body>
</html>