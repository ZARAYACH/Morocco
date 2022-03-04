<?php
session_start();
require_once './classes/user.cls.php';
require_once './classes/trips.cls.php';
if(isset($_SESSION["user"])){
    $user  = unserialize($_SESSION['user']);
    $userId = $user->getId();
    $sql = "select img from users where id = '$userId'";
    $return= connection::selectionFromDb($sql);
    while($row = $return->fetch()){
        $img = $row[0];
    }
    $sql = "select * from additional_info where user_id='$userId' ";
    $return = connection::selectionFromDb($sql);
    while($row = $return->fetch()){
        $additional_id = $row[0];
        $firstName = $row[2];
        $lastName = $row[3];
        $address1 = $row[4];
        $address2 = $row[5];
        $phoneNbr = $row[6];
        $city = $row[7];
        $postalCode = $row[8];
        if($postalCode == 0){
            $postalCode = null;
        }
        $contrie = $row[9];
        if(!empty($phoneNbr)){
            $phoneNbr = explode('/',$phoneNbr);
            $phone = $phoneNbr[1];
            $ext = $phoneNbr[0];
        }else{
            $ext ='---';
            $phone = '';
        }
    }
}else{
    header("location:./log-in.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/user-home.css">
    <title>Document</title>
</head>
<body>
    <div class="nav">
        <div class="above">
        <ul>
            <li location="home" class="click ">
                <b></b>
                <b></b>
                <a>
                <i class="fa fa-house"></i>
            <span>Home</span>
                </a>
            </li>
            <li location="profile" class="click ">
            <b></b>
                <b></b>
                <a>
                <i class="fa fa-user-group"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li location="reviews" class="click">
            <b></b>
                <b></b>
                <a>
                <i class="fa fa-signal"></i>
                    <span>reviews</span>
                </a>
            </li>
            <li location="search" class="click">
            <b></b>
                <b></b>
                <a>
                <i class="fa fa-search"></i>
                    <span>Search</span>
                </a>
            </li>
            <li location="settings" class="click">
            <b></b>
                <b></b>
                <a>
                <i class="fa fa-gear"></i>    
                <span>settings</span>
                </a>
            </li>
            </ul>
        </div>
        <div class="under">
        <ul>
        <li class="click">
        <b></b>
                <b></b>
        <a href='./auth/logout.inc.php' >
                <i class="fa fa-arrow-right-from-bracket"></i>    
                <span>Log out</span>
                </a>
            </li>
        </ul>
        </div>
            
           
        

    </div>

    <div class="main">
    <?php if(isset($_GET['ok'])){
            if($_GET["ok"]=="home"){
           ?>
    <div class="up">
          <div class="spending">
              <div class="spending-title">
                  Travel Dashboard
              </div>
              <div class="dir"><span>Home</span></div>
              <div class="spending-container">
                  <div class="box">
                      <div class="box-title">Booked travels</div>
                      <div class="box-info">
                          <div class="box-booked"><?php $user->NbrOfBooked($userId); ?></div>
                          <div class="stat">
                              <div class="stat-chart"><i class="fa-solid fa-arrow-trend-up"></i></div>
                              <div class="stat-percentage">2.4%</div>

                          </div>
                      </div>
                  </div>

                  <div class="box">
                      <div class="box-title">average costs $</div>
                      <div class="box-info">
                          <div class="box-booked"><?php if($user->avergeCostOfBooked($userId)>=1000){
                              $s = explode(",",number_format($user->avergeCostOfBooked($userId),2));
                              $o = number_format($s[1],0);
                              echo($s[0] ."," .$o[0].$o[1]."k"); 
                          }else{
                              echo(number_format($user->totalCostOfBooked($userId),2));
                             }
                          ?></div>
                          <div class="stat">
                              <div class="stat-chart"><i class="fa-solid fa-arrow-trend-up"></i></div>
                              <div class="stat-percentage">2.4%</div>

                          </div>
                      </div>
                  </div>

                  <div class="box">
                      <div class="box-title">canceld travels</div>
                      <div class="box-info">
                          <div class="box-booked">0 </div>
                          <div class="stat">
                              <div class="stat-chart"><i class="fa-solid fa-arrow-trend-up"></i></div>
                              <div class="stat-percentage">2.4%</div>

                          </div>
                      </div>
                  </div>

                  <div class="box">
                      <div class="box-title">total costs $</div>
                      <div class="box-info">
                          <div class="box-booked"><?php if($user->totalCostOfBooked($userId)>=1000){
                              $s = explode(",",number_format($user->totalCostOfBooked($userId),2));
                              $o = number_format($s[1],0);
                              echo($s[0] ."," .$o[0].$o[1]."k"); 
                          }else{
                              echo(number_format($user->totalCostOfBooked($userId),2));
                             }
                          ?></div>
                          <div class="stat">
                              <div class="stat-chart"><i class="fa-solid fa-arrow-trend-up"></i></div>
                              <div class="stat-percentage">2.4%</div>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="photo">
              <img src="./IMG/undraw_explore_re_8l4v (1).svg" alt="">
          </div>

      </div>
      <div class="down">
          <div class="down-title">Your booked travels</div>
          <table class="table">
          <thead>
        <tr>
            <th >name</th>
            <th >qte</th>
            <th > tikets left</th>
            <th >travel cost</th>
            <th >type</th>
        </tr>
    </thead>
    <tbody>
       <?php $user->getAllBookedTravels($userId); ?> 
        

    </tbody>
          </table>
      </div>
      <?php }else if($_GET["ok"]=="search"){?>
        <div class="up">
          <div class="spending">
              <div class="spending-title">
                  Search 
              </div>
              <div class="dir"><span>Home</span><span>search</span></div>
              <div class="spending-container">
                  <div class="box">
                      <div class="box-title">Booked travels</div>
                      <div class="box-info">
                          <div class="box-booked"><?php $user->NbrOfBooked($userId); ?></div>
                          <div class="stat">
                              <div class="stat-chart"><i class="fa-solid fa-arrow-trend-up"></i></div>
                              <div class="stat-percentage">2.4%</div>

                          </div>
                      </div>
                  </div>

                  <div class="box">
                      <div class="box-title">average costs $</div>
                      <div class="box-info">
                          <div class="box-booked"><?php if($user->avergeCostOfBooked($userId)>=1000){
                              $s = explode(",",number_format($user->avergeCostOfBooked($userId),2));
                              $o = number_format($s[1],0);
                              echo($s[0] ."," .$o[0].$o[1]."k"); 
                          }else{
                              echo(number_format($user->avergeCostOfBooked($userId),2));
                             }
                          ?> </div>
                          <div class="stat">
                              <div class="stat-chart"><i class="fa-solid fa-arrow-trend-up"></i></div>
                              <div class="stat-percentage">2.4%</div>

                          </div>
                      </div>
                  </div>

                  <div class="box">
                      <div class="box-title">canceld travels</div>
                      <div class="box-info">
                          <div class="box-booked">0 </div>
                          <div class="stat">
                              <div class="stat-chart"><i class="fa-solid fa-arrow-trend-up"></i></div>
                              <div class="stat-percentage">2.4%</div>

                          </div>
                      </div>
                  </div>

                  <div class="box">
                      <div class="box-title">total costs $</div>
                      <div class="box-info">
                          <div class="box-booked">
                          <?php if($user->totalCostOfBooked($userId)>=1000){
                              $s = explode(",",number_format($user->totalCostOfBooked($userId),2));
                              $o = number_format($s[1],0);
                              echo($s[0] ."," .$o[0].$o[1]."k"); 
                          }else{
                              echo(number_format($user->totalCostOfBooked($userId),2));
                             }
                          ?></div>
                          <div class="stat">
                              <div class="stat-chart"><i class="fa-solid fa-arrow-trend-up"></i></div>
                              <div class="stat-percentage">2.4%</div>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="photo">
              <img src="./IMG/undraw_explore_re_8l4v (1).svg" alt="">
          </div>

      </div>
      <div class="down">
          <div class="down-title">all the available trips</div>
          <div class="search-bar">
              <span>Explore our trips </span>
              <select name="" id="destinations">
                  <?php trips::tripsDestinations()?>
              </select>
              <input  type="date" id="timeDepart">
              <input id="all" type="button" value="All trips">
          </div>
          <table class="table">
          <thead>
        <tr>
            <th >name</th>
            <th >tikets left</th>
            <th >price</th>
            <th >Time depart</th>
            <th >type</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
       <?php trips::displayAllTripsDashbaord(); ?> 
        

    </tbody>
          </table>
      </div>
      <?php
    }else if($_GET["ok"]=="Profile"){
        ?>
 <div class="up">
          <div class="spending">
              <div class="spending-title">
                  Your Profile
              </div>
              <div class="dir"><span>Home</span><span>Profile</span></div>
              <div class="spending-container pro">
                <div class="head">
                <div class="tiltle">Contact Informations : </div>
                <i class="fa-solid fa-edit" id="edit" edit="false" ></i>
                </div>
              <label for="">Your email :</label>
                    <input type="text" disabled name="" id="email"  value=<?php echo($user->getEmail());?>>
                    <label for="">Phone Number :</label>
                    <div class="phone">
                        <div class="select"> 
                            <div class="cou"><img id="cou" src="" alt=""></div>
                            <input id='ext' disabled  class="input" type="text" value=<?php echo($ext) ?>>
                            <i class="fa-solid fa-angle-down downn"></i>  
                            <div class="container">
                        </div>
                    </div>
                    <input disabled  id='phoneNbr' type="text" value=<?php echo($phone) ?>>
                    </div>
              

                </div>
          </div>
          <div class="photo">
              
              <img src="./IMG/undraw_personal_site_re_c4bp.svg" alt="">
          </div>

          </div>
          <div class="down">
          <div class="down-title">
              <div class="textt">Additional information</div>
              <div class="actions">
              <i class="fa-solid fa-ban" id="cancel"></i>
              <i class="fa-solid fa-edit" id="editAdd" edit="false" ></i>
              
            </div>
            
          </div>
          
          <div class="additional">
              <div class="namee">
                 <div class="first"> <label for="firstname">First name</label>
                  <input id="firstName" disabled type="text" value=<?php echo($firstName); ?>></div>
                  <div class="last">
                  <label for="lastName">last name</label>
                  <input  id="lastName" disabled type="text"  value=<?php echo($lastName); ?>>
                  </div>
              </div>
              <div class="other">
                    <label for="phiAddress">Phisical address 1</label>
                    <input id="phiAddress" disabled type="text" value=<?php echo($address1); ?>>
                    <label for="phiAddress2">Phisical address 2*</label>
                    <input  id="phiAddress2" disabled type="text" value=<?php echo($address2); ?>>
                    <label for="postal">Code Postal</label>
                    <input  id="postal" type="text" disabled value=<?php echo($postalCode); ?>>
                    <div id='nameee' class="namee">
                        <div class="first">
                        <label for="city">City</label>
                    <input  id="city" disabled type="text" value=<?php echo($city) ?>>
                        </div>
                        <div class="last">
                    <label for="country">country</label>
                    <input id="country" disabled type="text"  value=<?php echo($contrie); ?>>
                        </div>
                    </div>

              </div>
          </div>

      </div>


<?php
    }
} ?>
    </div>


    <div class="placeholder"></div>
    <div class="id-card">
    <div class="user-img"><div class="imgChange">
        <form action="" enctype="multipart/form-data">
        <label for="changee"><i class="fa fa-upload"></i></label>    
        <input id="changee" name="changee" type="file">
        </form>
    </div><img id='userIMG' src="" alt=""></div>
        <div class="user-name">
           <?php echo($user->getUserName());?>  <span>Dear Customer ,Welcome</span>
        </div>
    <div class="contact">
        <p>Contact information</p>
        <div class="contact-info">
            <label for="">Email</label>
            <div class="info">
                <span><?php echo($user->getEmail());?></span>
                <i class="fa-solid fa-envelope"></i>
            </div>
        </div>
            <div class="contact-info">
            <label for="">Phone</label>
            <div class="info">
            <span id="phoneNbre"><span id="country-code"><?php echo("+".$ext); ?></span><?php echo(" ".$phone); ?></span>
            <i class="fa fa-phone"></i>
            </div>
            </div>
           
        </div>
        <div class="charts">
            <div class="charts-head">
                <span>Progress</span>
                <select name="" id="">
                    <option value="week">This week</option>
                    <option value="week">This month</option>
                    <option value="year">This year</option>
                </select>
            </div>
            <div class="keys">
                <div class="dot">Planned</div>
                <div class="dot">booked</div>
                <div class="dot">Canceled</div>
            </div>
            <div class="statistiques">
            <div class="tower">
                <div class="chart">
                    <span class="planned"></span>
                    <span class="booked"></span>
                    <span class="Canceled"></span>
                </div>
                <div class="day">Sun</div>
            </div>
            <div class="tower">
                <div class="chart">
                <span class="planned"></span>
                    <span class="booked"></span>
                    <span class="Canceled"></span>
                </div>
                <div class="day">Mon</div>
            </div>
            <div class="tower">
                <div class="chart">
                <span class="planned"></span>
                    <span class="booked"></span>
                    <span class="Canceled"></span>
                </div>
                <div class="day">Tue</div>
            </div>
            <div class="tower">
                <div class="chart">
                <span class="planned"></span>
                    <span class="booked"></span>
                    <span class="Canceled"></span>
                </div>
                <div class="day">Wed</div>
            </div>
            <div class="tower">
                <div class="chart">
                <span class="planned"></span>
                    <span class="booked"></span>
                    <span class="Canceled"></span>
                </div>
                <div class="day">Thu</div>
            </div>
            <div class="tower">
                <div class="chart">
                <span class="planned"></span>
                    <span class="booked"></span>
                    <span class="Canceled"></span>
                </div>
                <div class="day">Fri</div>
            </div>
            <div class="tower">
                <div class="chart">
                <span class="planned"></span>
                    <span class="booked"></span>
                    <span class="Canceled"></span>
                </div>
                <div class="day">sat</div>
            </div>
            
            </div>
            
        </div>

    
    </div>







    <!-- <a href="./auth/logout.inc.php">LOGOUT</a> -->
    <script> let reelEmail='<?php echo($user->getEmail());?>'
     let userImg = '<?php echo($img);?>'
    </script>
    <script src="./JS/jquery-3.1.1.min.js"></script>
    <script src="./JS/user-home.js"></script>
</body>
</html>