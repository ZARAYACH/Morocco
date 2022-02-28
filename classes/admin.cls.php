<?php 

require_once "connection.cls.php";
require_once "user.cls.php";
require_once "trips.cls.php";

class admin extends user{


    public function setAdminLevel($adminLevel)
    {
        $this->adminLevel=$adminLevel;    
    }
    public function getAdminLevel()
    {
        return $this->adminLevel;
    }
    public function __construct($id,$username,$firstname,$lastname,$email,$password,$admin) {
        parent::__construct($id,$username,$firstname,$lastname,$email,$password,$admin);
    }
    

    public function changeToAdmin($id)
    {
        $result=false;
        $sql = "update users set admin = true where id = '$id'";
        $return = connection::actionOnDB($sql);
        if($return){
            $result = true;        
        }
        return $result ; 
    }
    public function changeToUser($id){
        $result=false;
        $sql = "update users set admin = false where id = '$id'";
        $return = connection::actionOnDB($sql);
        if($return){
            $result = true;        
        }
        return $result ; 
    }
    public function deleteUser($id){
        $result=false;
        $sql = "delete from users where id = '$id'";
        $return = connection::actionOnDB($sql);
        if($return){
            $result = true;        
        }
        return $result ; 
    }

    public function allUsers(){
        $result=false;
        $sql = "select * from users";
        $return = connection::selectionFromDb($sql);
        if($return){
            $result = $result;        
        }
        return $result ; 
    }
    public function allNotes(){
        $result=false;
        $sql = "select * from notes";
        $return = connection::selectionFromDb($sql);
        if($return){
            $result = $result;        
        }
        return $result ; 
    }
    public function allNotesByUser($id){
        $result=false;
        $sql = "select * from notes where user_id='$id'";
        $return = connection::selectionFromDb($sql);
        if($return){
            $result = $result;        
        }
        return $result ; 
    }
    public static function deleteTrip($tripId)
    {
        $result=false;
        $sql = "delete from trips where trip_id = '$tripId'";
        $return = connection::actionOnDB($sql);
        if($return){
            $result = true;        
        }
        return $result ; 
    }
    public function nbrSold()
    {
        $sql="select sum(qte) from booked";
        $return = connection::selectionFromDb($sql);
        while($row = $return->fetch()){
            $sum = $row[0]; 
            if($sum){
                return $sum;
            }else{
                return '0';
            }
        }
    }
    public function avgCost()
    {
        $sql="select avg(tatalPaid) from booked";
        $return = connection::selectionFromDb($sql);
        while($row = $return->fetch()){
            $sum = $row[0]; 
            return $sum;
        }
    }
    public function sumCost()
    {
        $sql="select sum(tatalPaid) from booked";
        $return = connection::selectionFromDb($sql);
        while($row = $return->fetch()){
            $sum = $row[0]; 
            return $sum;
        }
    }
    public function getAllBookedTravelss()
    {
       $sql = "select * from booked ";
       $return = connection::selectionFromDb($sql);
      if($return){
         while($row = $return->fetch()){
            $idBooked =$row[0];
            $idTrip = $row[1]; 
            $idUser = $row[2];
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
               <td class ='userId'>$idUser</td>
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
    
}