<?php
session_start();
if(isset($_SESSION["user"])){
    $user  = unserialize($_SESSION['user']);
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
            <li class="click">
                <b></b>
                <b></b>
                <a>
                <i class="fa fa-house"></i>
            <span>Home</span>
                </a>
            </li>
            <li class="click active">
            <b></b>
                <b></b>
                <a>
                <i class="fa fa-user-group"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="click">
            <b></b>
                <b></b>
                <a>
                <i class="fa fa-signal"></i>
                    <span>reviews</span>
                </a>
            </li>
            <li class="click">
            <b></b>
                <b></b>
                <a>
                <i class="fa-solid fa-clipboard"></i>
                    <span>tikets</span>
                </a>
            </li>
            <li class="click">
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
                          <div class="box-booked">100 </div>
                          <div class="stat">
                              <div class="stat-chart"><i class="fa-solid fa-arrow-trend-up"></i></div>
                              <div class="stat-percentage">2.4%</div>

                          </div>
                      </div>
                  </div>

                  <div class="box">
                      <div class="box-title">average costs $</div>
                      <div class="box-info">
                          <div class="box-booked">100 </div>
                          <div class="stat">
                              <div class="stat-chart"><i class="fa-solid fa-arrow-trend-up"></i></div>
                              <div class="stat-percentage">2.4%</div>

                          </div>
                      </div>
                  </div>

                  <div class="box">
                      <div class="box-title">canceld travels</div>
                      <div class="box-info">
                          <div class="box-booked">100 </div>
                          <div class="stat">
                              <div class="stat-chart"><i class="fa-solid fa-arrow-trend-up"></i></div>
                              <div class="stat-percentage">2.4%</div>

                          </div>
                      </div>
                  </div>

                  <div class="box">
                      <div class="box-title">total costs $</div>
                      <div class="box-info">
                          <div class="box-booked">100 </div>
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
        <tr>
            <td class="name">
                <div class="image"><img src="./IMG/marakech.jpg" alt=""></div>
                <div class="travel-name">
                    marakech
                    <span>Lorem ipsum dolor sit amet.</span>
                </div>

            </td>
            <td class="qte">10</td>
            <td class="tikets-left">100</td>
            <td class="travel-cost">$100</td>
            <td class="type"><i class="fa-solid fa-plane"></i></td>
        </tr>

    </tbody>
          </table>
      </div>
    </div>


    <div class="placeholder"></div>
    <div class="id-card">
    <div class="user-img"><img src="./IMG/pic4.png" alt=""></div>
        <div class="user-name">
            Camerron Robins <span>Sales manager</span>
        </div>
    <div class="contact">
        <p>Contact information</p>
        <div class="contact-info">
            <label for="">Email</label>
            <div class="info">
                <span>moha3@gmail.com</span>
                <i class="fa-solid fa-envelope"></i>
            </div>
        </div>
            <div class="contact-info">
            <label for="">Phone</label>
            <div class="info">
            <span id="phoneNbr"><span id="country-code">+212</span>  639-034-619</span>
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
    

    <script src="./JS/user-home.js"></script>
</body>
</html>