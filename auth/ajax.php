 <?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"newrent");
$state=$_GET["statedd"];
$city=$_GET["city"];




if($state!="")
{			$id = mysqli_query($link,"select id from state where state_name =$state");
			$res=mysqli_query($link, "select * from city where state_id=$id");

			echo "<select id='citydd'>";
			while($row=mysqli_fetch_array($res))
			{
				echo "<option value='$row[city_name]'>"; echo $row["city_name"]; echo "</option>";
			}

			echo "</select>"; 
}


if($city!="")
{
			$res=mysqli_query($link, "select * from area where city_id=$city");
			echo "<select id='area'>";
			while($row=mysqli_fetch_array($res))
			{
				echo "<option value='$row[area_id]'>"; echo $row["area_name"]; echo "</option>";
			}

			echo "</select>"; 
}


?>  
