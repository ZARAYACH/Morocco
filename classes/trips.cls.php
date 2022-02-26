<?php
    require_once 'connection.cls.php';
class trips{

    private $id;
    private $destination;
    private $description;
    private $time;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getDestination(){
		return $this->destination;
	}

	public function setDestination($destination){
		$this->destination = $destination;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function getTime(){
		return $this->time;
	}

	public function setTime($time){
		$this->time = $time;
	}


    public static function displayTrips()
    {
        $sql ="select * from trips ";
        $return = connection::selectionFromDb($sql);
        
        while($row = $return->fetch()){
            $id =$row[0] ;
            $to = $row[1];
            $desc = $row[2];
            $prix = $row[3];
            $img= $row[5];
          echo("<div class='box'>
          <img src='$img' alt=''>
          <div class='content'>
              <h3> <i class='fas fa-map-marker-alt'></i> $to</h3>
              <p>$desc</p>
              <div class='stars'>
                  <i class='fas fa-star'></i>
                  <i class='fas fa-star'></i>
                  <i class='fas fa-star'></i>
                  <i class='fas fa-star'></i>
                  <i class='far fa-star'></i>
              </div>
              <div class='price'> \$$prix <span class='remise'>$120.00</span> </div>
              <a tripId='$id' id='booking'  class='btn'  >book now</a>
          </div>
      </div>");

        }
    }
    public static function tripsDestinations()
    {
        $sql="select destination from trips ";
        $return = connection::selectionFromDb($sql);
        
        while($row = $return->fetch()){
            $destination = $row[0];
            echo("<option value='$destination'>$destination</option>");
        }
    }
    public static function displayAllTripsDashbaord()
    {
        $sql ="select trip_id,destination,description,price,max_persone,img,date(time_depart) from trips";
        $return = connection::selectionFromDb($sql);
        while($row = $return->fetch()){
            $id =$row[0] ;
            $to = $row[1];
            $desc = $row[2];
            $price = $row[3];
            $maxPer = $row[4];
            $img= $row[5];
            $timeDepart = $row[6];
            $sql = "select sum(qte) from booked where id_trip = '$id'";
            $return2 = connection::selectionFromDb($sql);
            while($row2 = $return2->fetch()){
               $sumBooked = $row2[0];
               $left  = $maxPer - $sumBooked;
               echo("<tr>
               <td class='name'>
                   <div class='image'><img src='$img' alt=''></div>
                   <div class='travel-name'>
                       $to
                       <span>$desc</span>
                   </div>
   
               </td>
               <td class='qte'>$left</td>
               <td class='tikets-left'>$price</td>
               <td class='travel-cost'>$timeDepart</td>
               <td class='type'><i class='fa-solid fa-plane'></i></td>
           </tr>");
            }
           
         }
        
    }
    public static function displayAllTripsDashbaordd()
    {
        $sql ="select trip_id,destination,description,price,max_persone,img,date(time_depart) from trips";
        $return = connection::selectionFromDb($sql);
        while($row = $return->fetch()){
            $id =$row[0] ;
            $to = $row[1];
            $desc = $row[2];
            $price = $row[3];
            $maxPer = $row[4];
            $img= $row[5];
            $timeDepart = $row[6];
            $sql = "select sum(qte) from booked where id_trip = '$id'";
            $return2 = connection::selectionFromDb($sql);
            while($row2 = $return2->fetch()){
               $sumBooked = $row2[0];
               $left  = $maxPer - $sumBooked;
               echo("<tr>
               <td class='name'>
                   <div class='image'><img src='$img' alt=''></div>
                   <div class='travel-name'>
                       $to
                       <span>$desc</span>
                   </div>
   
               </td>
               <td class='qte'>$left</td>
               <td class='tikets-left'>$price</td>
               <td class='travel-cost'>$timeDepart</td>
               <td class='type delete'><i tripId='$id' class='fa-solid fa-trash'></i></td>
           </tr>");
            }
           
         }
    }

    public static function displayCart($userId)
    {
        $sql = "select * from cart where  user_id ='$userId'";
        $return = connection::selectionFromDb($sql);
        if($return){
            while($row = $return->fetch()){
                $id = $row[0];
                $idTrip = $row[1];
                $idUser = $row[2];
                $date = $row[3];
                $sql2  = "select * from trips where trip_id=$idTrip";
                $return2 = connection::selectionFromDb($sql2);
                if($return2){
                    while($row2=$return2->fetch()){
                        $to = $row2[1];
                        $des = $row2[2];
                        $prix = $row2[3]; 
                        $img = $row2[5];
                        $time = $row2[6];
                    }
                }

                echo("
                <div  trip='$id'  addTime='$time' class='card'>
                <div class='img'><img src='$img' alt='' srcset=''></div>
                <div class='card_title'>
                    <div class='trip_title'>To $to</div>
                    <div class='trip_destination'>$des</div>
                </div>
                <div class='Number'>
                    <div  id='plus' ><i data-id-trip='$id' class='fa fa-plus-circle plus' aria-hidden='true'></i></div>
                    <div data-id-person='$id' class='person'>1</div>
                    <div  id='minus'  ><i data-id-trip='$id' class='fa fa-minus-circle minus' aria-hidden='true'></i></div>
                </div>
               <div class='price'> <span id='currency'>$</span><span price_one=$prix  data-id-prix='$id' class='prix'>$prix</span></div>
                <div class='delete'><i class='fa-solid fa-trash-can'></i></div>
            </div> 
                "); 
            }

        }
    }
    public static function displaySearchWithDestination($to)
    {
        $sql ="select trip_id,destination,description,price,max_persone,img,date(time_depart) from trips where destination = '$to'";
        $return = connection::selectionFromDb($sql);
        while($row = $return->fetch()){
            $id =$row[0] ;
            $to = $row[1];
            $desc = $row[2];
            $price = $row[3];
            $maxPer = $row[4];
            $img= $row[5];
            $timeDepart = $row[6];
            $sql = "select sum(qte) from booked where id_trip = '$id'";
            $return2 = connection::selectionFromDb($sql);
            while($row2 = $return2->fetch()){
               $sumBooked = $row2[0];
               $left  = $maxPer - $sumBooked;
               echo("<tr>
               <td class='name'>
                   <div class='image'><img src='$img' alt=''></div>
                   <div class='travel-name'>
                       $to
                       <span>$desc</span>
                   </div>
   
               </td>
               <td class='qte'>$left</td>
               <td class='tikets-left'>$price</td>
               <td class='travel-cost'>$timeDepart</td>
               <td class='type'><i class='fa-solid fa-plane'></i></td>
           </tr>");
            }
           
         }
        
    }
    public static function  displaySearchWithDestinationAndTime($to,$date)
    {
        $sql ="select trip_id,destination,description,price,max_persone,img,date(time_depart) from trips where destination = '$to' and time_depart >= '$date'";
        $return = connection::selectionFromDb($sql);
        while($row = $return->fetch()){
            $id =$row[0] ;
            $to = $row[1];
            $desc = $row[2];
            $price = $row[3];
            $maxPer = $row[4];
            $img= $row[5];
            $timeDepart = $row[6];
            $sql = "select sum(qte) from booked where id_trip = '$id'";
            $return2 = connection::selectionFromDb($sql);
            while($row2 = $return2->fetch()){
               $sumBooked = $row2[0];
               $left  = $maxPer - $sumBooked;
               echo("<tr>
               <td class='name'>
                   <div class='image'><img src='$img' alt=''></div>
                   <div class='travel-name'>
                       $to
                       <span>$desc</span>
                   </div>
   
               </td>
               <td class='qte'>$left</td>
               <td class='tikets-left'>$price</td>
               <td class='travel-cost'>$timeDepart</td>
               <td class='type'><i class='fa-solid fa-plane'></i></td>
           </tr>");
            }
           
         }
        
    }

    public static function displaySearchWithTime($date)
    {
        $sql ="select trip_id,destination,description,price,max_persone,img,date(time_depart) from trips where time_depart >= '$date'";
        $return = connection::selectionFromDb($sql);
        while($row = $return->fetch()){
            $id =$row[0] ;
            $to = $row[1];
            $desc = $row[2];
            $price = $row[3];
            $maxPer = $row[4];
            $img= $row[5];
            $timeDepart = $row[6];
            $sql = "select sum(qte) from booked where id_trip = '$id'";
            $return2 = connection::selectionFromDb($sql);
            while($row2 = $return2->fetch()){
               $sumBooked = $row2[0];
               $left  = $maxPer - $sumBooked;
               echo("<tr>
               <td class='name'>
                   <div class='image'><img src='$img' alt=''></div>
                   <div class='travel-name'>
                       $to
                       <span>$desc</span>
                   </div>
   
               </td>
               <td class='qte'>$left</td>
               <td class='tikets-left'>$price</td>
               <td class='travel-cost'>$timeDepart</td>
               <td class='type'><i class='fa-solid fa-plane'></i></td>
           </tr>");
            }
           
         }
        
    }
    public static function displayPurchade($selled)
    {
       for ($i=0; $i <count($selled) ; $i++) { 
           $sql = "select * from booked where id = '$selled[$i]'";
           $return = connection::selectionFromDb($sql);
           if($return){
               while($row = $return->fetch()){
                   $to = $row[1];
                   $qte = $row[3];
                   $price= $row[4];
                   $totla = $row[5];
                   $sql = "select * from trips where trip_id = '$to'"; 
                   $return2 = connection::selectionFromDb($sql);
           if($return2){
               while($row2 = $return2->fetch()){
                   $destination = $row2[1];
                   $date = $row2[6];
                   echo("<tr>
                   <td class='name'>
                       <div class='travel-name'>
                           $destination
                       </div>
       
                   </td>
                   <td class='qte'>$qte</td>
                   <td class='tikets-left'>$price</td>
                   <td class='travel-cost'>$totla</td>
                   <td>$date</td>
                                  </tr>");
               }
           }
       }
    }
    


}

    }}