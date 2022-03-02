<?php

require_once 'connection.cls.php';

class user{
    private $id;
    private $username;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $admin;
    
    public function setId($id){
      $this->id = $id;
   }
   public function getId(){
      return $this->id;
   }


    public function setUserName($username){
        $this->username = $username;
     }
     public function getUserName(){
        return $this->username;
     }

     public function setFirstName($firstname){
        $this->firstname = $firstname;
     }
     public function getFirstName(){
        return $this->firstname;
     }

     public function setLastName($lastname){
        $this->lastname = $lastname;
     }
     public function getLastName(){
        return $this->lastname;
     }
     public function setEmail($email){
        $this->email = $email;
     }
     public function getEmail(){
        return $this->email;
     }
     public function setPwd($password){
         $hashedPwd = password_hash( $password , PASSWORD_DEFAULT);
        $this->password = $hashedPwd;
     }
     public function getPwd(){
        return $this->password;
     }
     public function setadmin($admin){
        $this->admin = $admin;
     }
     public function getadmin(){
        return $this->admin;
     }

     public function __construct($id,$username,$firstname,$lastname,$email,$password,$admin)
     {
         $this->id = $id;
         $this->username = $username;
         $this->firstname = $firstname;
         $this->lastname = $lastname;
         $this->email = $email;
         $this->setPwd($password);
         $this->admin = $admin;
     }
     public function addToDb($username,$firstname,$lastname,$email,$password,$admin){
         $sql= "insert into users(username,first_name,last_name,email,pwd,admin) values ('$username','$firstname','$lastname','$email','$password','$admin')";
         $return = connection::actionOnDB($sql);
          if($return){
             $sql = "select id from users where email = '$email' ";
             $return = connection::selectionFromDb($sql);
             while($row=$return->fetch()){
                $userID = $row[0];
                $sql = "insert into additional_info(user_id) values('$userID')";
                $return2 = connection::actionOnDB($sql);
             }
            return $return2;
            
             
          }
     }
     public function changeInfo($username,$firstname,$lastname,$userID){
        $sql= "update users set username = '$username',first_name='$firstname' ,last_name='$lastname' where id='$userID' ";
        $return = connection::actionOnDB($sql);
           return $return;
    }
    public static function editContact($phoneNbr,$email,$userId){
      $sql ="update users set email = '$email' where id='$userId'";
      $return = connection::actionOnDB($sql);
      if($return){
         $sql ="update additional_info set phoneNbr = '$phoneNbr' where user_id = '$userId'";
         $return = connection::actionOnDB($sql);
      }
      return $return;

   }
    public function deleteAcount($userId){
        $sql= "delete from users where id ='$userId'";
        $return = connection::actionOnDB($sql);
           return $return;
    }
   
    public function addUserImg($userId,$imgSrc){
      $sql= "insert into profilsimg(user_id,ImgSrc) values ('$userId','$imgSrc') ";
      $return = connection::actionOnDB($sql);
         return $return;
  }
    public function getAllInfoDb($userId){
      $result = false; 
      $sql = "select * from users where user_id = '$userId' ";
      $return = connection::selectionFromDb($sql);
      if($return){
          $result = $return;
      }
      return $result;

    }
    public function NbrOfBooked($userId)
    {
       $sql = "select count(*) from booked where id_user = '$userId'";
       $return = connection::selectionFromDb($sql);
       if($return){
         while($row = $return->fetch()){
            echo($row[0]);
         }
    }
   }
   public function avergeCostOfBooked($userId)
   {
      $sql = "select avg(tatalPaid) from booked where id_user = '$userId'";
      $return = connection::selectionFromDb($sql);
      if($return){
        while($row = $return->fetch()){
           echo($row[0]);
        }
   }
  }
  public function totalCostOfBooked($userId)
  {
     $sql = "select sum(tatalPaid) from booked where id_user = '$userId'";
     $return = connection::selectionFromDb($sql);
     if($return){
       while($row = $return->fetch()){
          echo($row[0]);
       }
  }
 }
    public function getAllBookedTravels($userId)
    {
       $sql = "select * from booked where id_user = '$userId'";
       $return = connection::selectionFromDb($sql);
      if($return){
         while($row = $return->fetch()){
            $idBooked =$row[0];
            $idTrip = $row[1]; 
            $qte = $row[3];
            $prixForOne = $row[4];
            $totalPaid = $row[5];
            $date = $row[6];
            $sql = "select * from trips where trip_id = $idTrip";
            $return2 = connection::selectionFromDb($sql);
            while($row2 = $return2->fetch()){
               $destination = $row2[1];
               $description = $row2[2];
               $priceForOne = $row2[3];
               $maxPersonne = $row2[4];
               $img = $row2[5];
               $timeDepart = $row[6];
               $sql = "select sum(qte) from booked where id_trip = '$idTrip'";
               $return3 = connection::selectionFromDb($sql);
               while($row3 = $return3->fetch()){
                  $sumBooked = $row3[0];
               }
               $tiketsLeft = $maxPersonne - $sumBooked ; 
               echo("<tr>
               <td class='name'>
                   <div class='image'><img src='$img' alt=''></div>
                   <div class='travel-name'>
                       $destination
                       <span>$description</span>
                   </div>
   
               </td>
               <td class='qte'>$qte</td>
               <td class='tikets-left'>$tiketsLeft</td>
               <td class='travel-cost'>$$totalPaid</td>
               <td class='type'><i class='fa-solid fa-plane'></i></td>
           </tr>");
            }
         }
      }else{
         echo("<tr><td colspan='6'>go ahead and get your tikets now</td></tr>");
      }
    }

    public static function displaySettings($userName,$firstName,$lastName,$email,$admin){
      echo("
    <div class='settings'>
    <div class='header_settings'>Settings</div>
    <div class='info'>
      <div class='label' > Username : </div>
      <div class='user_info'><input  id='userName' value='$userName'></input></div>
      <div class='label'>First name :</div>
      <div class='user_info'><input id='firstName' value='$firstName'></input></div>
      <div class='label'>Last name :</div>
      <div class='user_info'><input  id='lastName' value='$lastName' ></input></div>
      <div class='label'>Email :</div>
      <div class='user_info'><input  id='email' value='$email' ></input></div>
       <form action='' method='POST' enctype='multipart/form-data' id='imgForm' >
          <div class='wrapp'>
          <div class='label'>choose your profile image</div>
         <div class = 'user_info'><label class='lll' for='photo'>CHOOSE</label> <input type='file' name='photo' id='photo'></div>
          </div>
      </form>
      <div class='submit' >
      <input type='button' id='default' value='Cancel'>
      <input type='button' id='submit' name='save' value='Save'>
   
      </div>
      <div class='deleteAccount' >
      <input type='button' id='accDel' value='Delete My Account'>
      </div>
      
    </div>
  </div>

            ");
    }
    

}