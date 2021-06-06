<?php
	require '../config/config.php';
 if(empty($_SESSION['username']))
    header('Location: login.php');

if ( isset($_GET['id'])) {
      $id = $_REQUEST['id'];
    } 

    if ( isset($_GET['act'])) {
      $active = $_REQUEST['act'];


if ($active == 'ap') {
        # code...
        try {
          if(isset($_POST['appointment']))
 { 
    $errMsg='';
    // Get data from FORM
        //left vala user define variable
               //control name+id input type
    $adate = $_POST['datum1'];
    $atime = $_POST['time'];
    
    // $r_id = $_SESSION['r_id'];
    // $ra_id = $_SESSION['ra_id'];
   

    
                                  //database coloumn name  //valuse user defined variable
    $stmt = $connect->prepare('INSERT INTO appt (username, adate , atime , mobile, email, user_id, ra_id) VALUES (:username, :adate, :atime, :mobile, :email, :user_id, :ra_id)');
        $stmt->execute(array(
          ':username' => $_SESSION['username'],    //post vriable (input type)           //same 
          ':adate' => $adate,
          ':atime' => $atime,
          ':mobile' => $_SESSION['mobile'],
          ':email' => $_SESSION['email'],
          
          // ':r_id' => $r_id,
          // ':ra_id' => $ra_id, 
          // ':broker_id' => $_SESSION['broker_id'],
          ':user_id' => $_SESSION['user_id'],
          ':ra_id' => $id
          // ':user_id' => $user_id
          
          
          
          
          
          ));
        header('Location: appointment.php?action=app');
        exit;

      
      }
     
        }catch(PDOException $e) {
          $errMsg = $e->getMessage();
        }
      }

      else{
        try{
         if(isset($_POST['appointment']))
 { 
    $errMsg='';
    // Get data from FORM
        //left vala user define variable
               //control name+id input type
    $adate = $_POST['datum1'];
    $atime = $_POST['time'];
    
    // $r_id = $_SESSION['r_id'];
    // $ra_id = $_SESSION['ra_id'];
   

    
                                  //database coloumn name  //valuse user defined variable
    $stmt = $connect->prepare('INSERT INTO appt (username, adate , atime , mobile, email, user_id, r_id) VALUES (:username, :adate, :atime, :mobile, :email, :user_id, :r_id)');
        $stmt->execute(array(
          ':username' => $_SESSION['username'],    //post vriable (input type)           //same 
          ':adate' => $adate,
          ':atime' => $atime,
          ':mobile' => $_SESSION['mobile'],
          ':email' => $_SESSION['email'],
          
          // ':r_id' => $r_id,
          // ':ra_id' => $ra_id, 
          // ':broker_id' => $_SESSION['broker_id'],
          ':user_id' => $_SESSION['user_id'],
          ':r_id' => $id
          // ':user_id' => $user_id
          
          
          
          
          
          ));
        header('Location: appointment.php?action=app');
        exit;

      
      }
        }catch(PDOException $e) {
          echo $e->getMessage();
        }     
      }
    }



    	
     if(isset($_GET['action']) && $_GET['action'] == 'app') {
     $errMsg ='<a href="../app/viewappointment.php"> <font color="red"> Appointment booked successfully, You can view details </font> </a>';
    }
    

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <script>
      
 // Array of max days in month in a year and in a leap year
monthMaxDays  = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
monthMaxDaysLeap= [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
hideSelectTags = [];

function getRealYear(dateObj)
{
  return (dateObj.getYear() % 100) + (((dateObj.getYear() % 100) < 39) ? 2000 : 1900);
}

function getDaysPerMonth(month, year)
{
  /* 
  Check for leap year. These are some conditions to check year is leap year or not...
  1.Years evenly divisible by four are normally leap years, except for... 
  2.Years also evenly divisible by 100 are not leap years, except for... 
  3.Years also evenly divisible by 400 are leap years. 
  */
  if ((year % 4) == 0)
  {
    if ((year % 100) == 0 && (year % 400) != 0)
      return monthMaxDays[month];
  
    return monthMaxDaysLeap[month];
  }
  else
    return monthMaxDays[month];
}

function createCalender(year, month, day)
{
   // current Date
  var curDate = new Date();
  var curDay = curDate.getDate();
  var curMonth = curDate.getMonth();
  var curYear = getRealYear(curDate)

   // if a date already exists, we calculate some values here
  if (!year)
  {
    var year = curYear;
    var month = curMonth;
  }

  var yearFound = 0;
  for (var i=0; i<document.getElementById('selectYear').options.length; i++)
  {
    if (document.getElementById('selectYear').options[i].value == year)
    {
      document.getElementById('selectYear').selectedIndex = i;
      yearFound = true;
      break;
    }
  }
  if (!yearFound)
  {
    document.getElementById('selectYear').selectedIndex = 0;
    year = document.getElementById('selectYear').options[0].value;    
  }
  document.getElementById('selectMonth').selectedIndex = month;

   // first day of the month.
  var fristDayOfMonthObj = new Date(year, month, 1);
  var firstDayOfMonth = fristDayOfMonthObj.getDay();

  continu   = true;
  firstRow  = true;
  var x = 0;
  var d = 0;
  var trs = []
  var ti = 0;
  while (d <= getDaysPerMonth(month, year))
  {
    if (firstRow)
    {
      trs[ti] = document.createElement("TR");
      if (firstDayOfMonth > 0)
      {
        while (x < firstDayOfMonth)
        {
          trs[ti].appendChild(document.createElement("TD"));
          x++;
        }
      }
      firstRow = false;
      var d = 1;
    }
    if (x % 7 == 0)
    {
      ti++;
      trs[ti] = document.createElement("TR");
    }
    if (day && d == day)
    {
      var setID = 'calenderChoosenDay';
      var styleClass = 'choosenDay';
      var setTitle = 'this day is currently selected';
    }
    else if (d == curDay && month == curMonth && year == curYear)
    {
      var setID = 'calenderToDay';
      var styleClass = 'toDay';
      var setTitle = 'this day today';
    }
    else
    {
      var setID = false;
      var styleClass = 'normalDay';
      var setTitle = false;
    }
    var td = document.createElement("TD");
    td.className = styleClass;
    if (setID)
    {
      td.id = setID;
    }
    if (setTitle)
    {
      td.title = setTitle;
    }
    td.onmouseover = new Function('highLiteDay(this)');
    td.onmouseout = new Function('deHighLiteDay(this)');
    if (targetEl)
      td.onclick = new Function('pickDate('+year+', '+month+', '+d+')');
    else
      td.style.cursor = 'default';
    td.appendChild(document.createTextNode(d));
    trs[ti].appendChild(td);
    x++;
    d++;
  }
  return trs;
}

function showCalender(elPos, tgtEl)
{
  targetEl = false;

  if (document.getElementById(tgtEl))
  {
    targetEl = document.getElementById(tgtEl);
  }
  else
  {
    if (document.forms[0].elements[tgtEl])
    {
      targetEl = document.forms[0].elements[tgtEl];
    }
  }
  var calTable = document.getElementById('calenderTable');

  var positions = [0,0];
  var positions = getParentOffset(elPos, positions);  
  calTable.style.left = positions[0]+'px';    
  calTable.style.top = positions[1]+'px';     

  calTable.style.display='block';

  var matchDate = new RegExp('^([0-9]{2})-([0-9]{2})-([0-9]{4})$');
  var m = matchDate.exec(targetEl.value);
  if (m == null)
  {
    trs = createCalender(false, false, false);
    showCalenderBody(trs);
  }
  else
  {
    if (m[1].substr(0, 1) == 0)
      m[1] = m[1].substr(1, 1);
    if (m[2].substr(0, 1) == 0)
      m[2] = m[2].substr(1, 1);
    m[2] = m[2] - 1;
    trs = createCalender(m[3], m[2], m[1]);
    showCalenderBody(trs);
  }

  hideSelect(document.body, 1);
}
function showCalenderBody(trs)
{
  var calTBody = document.getElementById('calender');
  while (calTBody.childNodes[0])
  {
    calTBody.removeChild(calTBody.childNodes[0]);
  }
  for (var i in trs)
  {
    calTBody.appendChild(trs[i]);
  }
}
function setYears(sy, ey)
{
   // current Date
  var curDate = new Date();
  var curYear = getRealYear(curDate);
  if (sy)
    startYear = curYear;
  if (ey)
    endYear = curYear;
  document.getElementById('selectYear').options.length = 0;
  var j = 0;
  for (y=ey; y>=sy; y--)
  {
    document.getElementById('selectYear')[j++] = new Option(y, y);
  }
}
function hideSelect(el, superTotal)
{
  if (superTotal >= 100)
  {
    return;
  }

  var totalChilds = el.childNodes.length;
  for (var c=0; c<totalChilds; c++)
  {
    var thisTag = el.childNodes[c];
    if (thisTag.tagName == 'SELECT')
    {
      if (thisTag.id != 'selectMonth' && thisTag.id != 'selectYear')
      {
        var calenderEl = document.getElementById('calenderTable');
        var positions = [0,0];
        var positions = getParentOffset(thisTag, positions);  // nieuw
        var thisLeft  = positions[0];
        var thisRight = positions[0] + thisTag.offsetWidth;
        var thisTop = positions[1];
        var thisBottom  = positions[1] + thisTag.offsetHeight;
        var calLeft = calenderEl.offsetLeft;
        var calRight  = calenderEl.offsetLeft + calenderEl.offsetWidth;
        var calTop  = calenderEl.offsetTop;
        var calBottom = calenderEl.offsetTop + calenderEl.offsetHeight;

        if (
          (
            /* check if it overlaps horizontally */
            (thisLeft >= calLeft && thisLeft <= calRight)
              ||
            (thisRight <= calRight && thisRight >= calLeft)
              ||
            (thisLeft <= calLeft && thisRight >= calRight)
          )
            &&
          (
            /* check if it overlaps vertically */
            (thisTop >= calTop && thisTop <= calBottom)
              ||
            (thisBottom <= calBottom && thisBottom >= calTop)
              ||
            (thisTop <= calTop && thisBottom >= calBottom)
          )
        )
        {
          hideSelectTags[hideSelectTags.length] = thisTag;
          thisTag.style.display = 'none';
        }
      }

    }
    else if(thisTag.childNodes.length > 0)
    {
      hideSelect(thisTag, (superTotal+1));
    }
  }
}
function closeCalender()
{
  for (var i=0; i<hideSelectTags.length; i++)
  {
    hideSelectTags[i].style.display = 'block';
  }
  hideSelectTags.length = 0;
  document.getElementById('calenderTable').style.display='none';
}
function highLiteDay(el)
{
  el.className = 'hlDay';
}
function deHighLiteDay(el)
{
  if (el.id == 'calenderToDay')
    el.className = 'toDay';
  else if (el.id == 'calenderChoosenDay')
    el.className = 'choosenDay';
  else
    el.className = 'normalDay';
}
function pickDate(year, month, day)
{
  month++;
  day = day < 10 ? '0'+day : day;
  month = month < 10 ? '0'+month : month;
  if (!targetEl)
  {
    alert('target for date is not set yet');
  }
  else
  {
    targetEl.value= day+'-'+month+'-'+year;
    closeCalender();
  }
}
function getParentOffset(el, positions)
{
  positions[0] += el.offsetLeft;
  positions[1] += el.offsetTop;
  if (el.offsetParent)
    positions = getParentOffset(el.offsetParent, positions);
  return positions;
}

 </script>
    <meta http-equiv="Content-Type" content="text/html;">

   <link href="../assets/css/calendarview.css" rel="stylesheet" type="text/css">
  </head>
  <body>
	<!-- Services -->
	<?php include '../include/header.php';?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#212529;" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="../index.php"><img src="../finallogo.png" height="5%" width="40%" border=solid></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="#"><?php echo $_SESSION['fullname']; ?> <?php if($_SESSION['role'] == 'admin'){ echo "(Admin)"; } elseif($_SESSION['role'] == 'broker'){ echo "(Broker)";} ?></a>
            </li>
            <li class="nav-item">
              <a href="../auth/logout.php" class="nav-link">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <header class="bimage">
  <?php include '../include/side-nav.php';?>
    <section id="services">
		<div class="container">
			<div class="row">				
			  <div class="col-md-8 mx-auto">
			  	<div class="alert alert-info" role="alert">
			  		<?php
						if(isset($errMsg)){
							echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
						}
					?>
			  		<h2 class="text-center">Book Appointment</h2>
				    	<form action="" method="post">
                <div class="row">
                 <!-- <div class="col-6">
					            <div class="form-group">
            					    <label for="username">User Name</label>
            					    <input type="text" class="form-control" id="username" placeholder=" Enter Username" name="username" required>
					            </div>
                  </div> -->




        <!--   <div class="col-6">
					     <div class="form-group">
					       <label for="email">Email</label>
					       <input type="" class="form-control" id="email" placeholder="Enter Email" name="email" required>
					     </div>
            </div> -->
          </div> 


          <div class="row">
            <div class="col-6">
					       <div class="form-group">
        					    <label for="adate">Select Appointment date</label> <div id="embeddedDateField">  </div>
                          <input type="text" class="form-control" name="datum1" readonly><a href="#" onClick="setYears(2020, 2025);
       showCalender(this, 'datum1');">
     <button type="button">---Select date here---</button></a>


                                       
                        
                           
                  </div>
                </div>




                <div class="col-6">
                 <div class="form-group">
                   <label for="adate">Select Appointment Time</label> <div id="embeddedDateField">  </div>
                       <select name="time" value="time" class="form-control">
                  <option value="" disabled selected hidden>----Select Time----</option>
                        
                      <option value="10:00am to 11:00am">  10:00am to 11:00am</option>
                        <option value="11:00am to 12:00pm">  11:00am to 12:00pm</option>
                        <option value="12:00pm to 1:00pm">  12:00pm to 1:00pm</option>
                           <option value="1:00pm to 2:00pm">1:00pm to 2:00pm</option>
                          <option value="2:00pm to 3:00pm">2:00pm to 3:00pm</option>
                          <option value="3:00pm to 4:00pm">3:00pm to 4:00pm</option>
                          <option value="4:00pm to 5:00pm">4:00pm to 5:00pm</option>
                          <option value="5:00pm to 6:00pm">5:00pm to 6:00pm</option>
                          <option value="6:00pm to 7:00pm">6:00pm to 7:00pm</option>
                          <option value="7:00pm to 8:00pm">7:00pm to 8:00pm</option>
                          
                         </select>
                      </div>
                </div>
            </div>


                
  



             <div class="row">
                
                   
                   <div class="col-8 mx-auto">  
					           <div class="form-group">
          					    <label for="phone">Booking Charges</label>
          					    <input type="text" class="form-control" id="charges" placeholder="₹300" name="charges" disabled="charges">
          					  </div>
                   </div>
        </div>
     

					  <center>
					 <button input type="Submit" class="btn btn-primary" name='appointment' value="appointment">Submit</button> 
            <button type="Reset" class="btn btn-primary" name='Reset' value="Reset">Reset</button><br>
            <!--<br><button type="button" class="form-control" >Submit</button>-->
            
					</center>
          <?php 
        if($_SESSION['role'] == 'broker' ){
         echo ' <a href="../app/viewappointment.php" ><font color="blue"> back to view appointment details</font> </a>';
        }
        elseif ($_SESSION['role'] == 'user' ){
         echo ' <a href="../app/search.php" ><font color="blue"> back to home</font> </a>';
        }
        ?>
					</form>					 
				 </div>
			</div>
	</div>
		</div>
    </header>
	</section>

<?php include '../include/chat.php';?>


                    <!-- Calender Script  --> 

                                      <table id="calenderTable">
                                          <tbody id="calenderTableHead">
                                            <tr>
                                              <td colspan="4" align="center">
                                              <select onChange="showCalenderBody(createCalender(document.getElementById('selectYear').value,
                                               this.selectedIndex, false));" id="selectMonth">
                                                  <option value="0">January</option>
                                                  <option value="1">February</option>
                                                  <option value="2">March</option>
                                                  <option value="3">April</option>
                                                  <option value="4">May</option>
                                                  <option value="5">June</option>
                                                  <option value="6">July</option>
                                                  <option value="7">August</option>
                                                  <option value="8">September</option>
                                                  <option value="9">October</option>
                                                  <option value="10">November</option>
                                                  <option value="11">December</option>
                                              </select>
                                              </td>
                                              <td colspan="2" align="center">
                                            <select onChange="showCalenderBody(createCalender(this.value, 
                                          document.getElementById('selectMonth').selectedIndex, false));" id="selectYear">
                                          </select>
                                        </td>
                                              <td align="center">
                                            <a href="#" onClick="closeCalender();"><font color="#003333" size="+1">x</font></a>
                                        </td>
                                        </tr>
                                         </tbody>
                                         <tbody id="calenderTableDays">
                                           <tr style="">
                                             <td>Sun</td><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td>Sat</td>
                                           </tr>
                                         </tbody>
                                         <tbody id="calender"></tbody>
                                      </table>

                                  <!-- End Calender Script  --> 


</body>
</html>