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
        $sql ="select * from trips";
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
   







}