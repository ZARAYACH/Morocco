<?php

  class connection{
    
        public static function connectToDb(){
            try  {
                $conn = new PDO('mysql:host=localhost;dbname=morocco_travel_agency;charset=utf8', 'root', '');
     $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                return $conn;
                }
            catch (Exception $e)
                {
     echo('Erreur : ' . $e->getMessage());
                }
        }
        public static function actionOnDB($sql){
            $result = false;
            $conn = self::connectToDb();
            if($conn->exec($sql) !== false){
                $result = true;
            }
            $conn = null ;
            return $result;
        }

        public static function selectionFromDb($sql){
            $conn = self::connectToDb();
            $cur = $conn->query($sql);
            if( $cur !== false){
                return $cur;
            }
            return false;
            $conn = null ;
            
        }
        // public static function popUp($which,$message)
        // {
        //     if($which == "ok"){
        //         echo("<script> 
        //         let message ='$message'; 
        //         let pop_up = `<div class='pop_up'>
        //         <div class='x'><button id='close'><img src='../assets/close_black_24dp.svg' alt=''></button></div>
        //         <div class='message'>
        //             <img src='../assets/done_white_24dp.svg' alt=''>
        //             <p>\${message}</p></div>
        //       </div>`
        //        document.write(pop_up);
        //        let dd = document.querySelector('.pop_up');
        //        let close_button = document.querySelector('#close');
        //        close_button.addEventListener('click',function(){
        //         dd.classList.remove('get_out');
        //     })
        //        setTimeout(function(){
          
        //          dd.classList.add('get_out');
        //        },500)
        //        setTimeout(function(){
        //          dd.classList.remove('get_out');
        //      },5000);
                
        //       </script>");

        //     }else if($which == "error"){
        //         echo("<script> 
        //         let message ='$message'; 
        //         let pop_up = `<div class='pop_up'>
        //         <div class='x'><button id='close'><img src='../assets/close_black_24dp.svg' alt=''></button></div>
        //         <div class='message'>
        //             <img src='../assets/error2.svg' alt=''>
        //             <p>\${message}</p></div>
        //       </div>`
        //        document.write(pop_up);
        //        let dd = document.querySelector('.pop_up');
        //        dd.style.backgroundColor = '#bd362f';
        //        let close_button = document.querySelector('#close');
        //        close_button.addEventListener('click',function(){
        //         dd.classList.remove('get_out');
        //     })
        //        setTimeout(function(){
          
        //          dd.classList.add('get_out');
        //        },500)
        //        setTimeout(function(){
        //          dd.classList.remove('get_out');
        //      },5000);
                
        //       </script>");

        //     }
        // }


  }