<?php
 //By IT20654962
    // Dynamic Header
    $title = 'Vendor Dashboard'; include("header.php");
	 //session_start();
	 //$vendorID=$_SESSION["id"];
     //$$_SESSION["username"];
     //$_SESSION["fname"];
     //$_SESSION["lname"];
     //$_SESSION["email"];
	 //vendorID=$vendorID;
	 $company;
	 $username;
	 $ImageLoc;
	 $firstname;
	 $lastname;
	 $password;
	 $mobile;
	 $address;
	 $email;
	 $sqlstmt="SELECT * FROM Vendor WHERE vendorID=3;";
	 if($result=mysqli_query($conn,$sqlstmt)){
		 if($result->num_rows>0){
			 while($row=$result->fetch_assoc()){
				 $company=$row["v_company"];
	             $username=$row["v_username"];
	             $ImageLoc=$row["v_imgLoc"];
	             $firstname=$row["v_fname"];
	             $lastname=$row["v_lname"];
	             $password=$row["v_password"];
	             $mobile=$row["v_mobile"];
	             $address=$row["v_address"];
	             $email=$row["v_email"];
			 }
		 }else{
			 echo "Cannot find this vendor";
			 
			 
		 }
		 		 
	 }else{
		 echo "Errors,vendor retriving:".$conn->error;
	 }
?>

<!--paymentHistory css-->
 

   
   
   
   
 
<link rel="stylesheet" href="./assets/css/accountDetails.css">
<link rel="stylesheet" href="./assets/css/vendorNavBar.css">
	<nav id="vnavBar">
		<ul class="vendorNavbar">
			<li>
				<a class="current" href="accountDetails.php">Account details</a>
			</li>
			<li>
				<a  href="adsInventory.php">Ads Inventory</a>
			</li>
			<li>
				<a  href="addCommercialsPage.php">Add advertisement</a>
			</li>
			<li>
				<a  href="paymentHistory.php">Payments</a>
			</li>
		</ul>
	</nav>
	<hr>
	
	<div class="acdetails">
	<!--my code-->
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
  <fieldset>
    <legend>Account Details</legend>
	<div class="data">
	<div class="profilepic">
	<label for="propic">Profile Picture:</label>
	<!--img src='{$row['addImageLoc']}'-->
	<img src="<?php echo $ImageLoc;?>" height='200' width='200' alt="profilepicture" title="vendorpropic">
    <input class="visible" type="file" id="propic" name="propic" value="<?php echo htmlspecialchars($ImageLoc);?>" ><br><br>
	</div>
	<div class="vendorDetails">
	 <label for="company">Company Name:</label>
    <input class="visible" type="text" id="company" name="company" value="<?php echo  $company;?>" ><br><br>

	<label for="username">User name:</label>
    <input class="visible" type="text" id="username" name="username" value="<?php 	echo $username;?>" ><br><br>
	
	
	
    <label for="fname">First name:</label>
    <input class="visible" type="text" id="fname" name="fname" value="<?php echo $firstname;?>" ><br><br>

    <label class="visible" for="lname">Last name:</label>			
    <input class="visible" type="text" id="lname" name="lname" value="<?php echo  $lastname;?>" ><br><br>
  
    <label for="email">Email:</label>
    <input class="visible" type="email" id="email" name="email" value="<?php echo $email;?>" ><br><br>
    	 
		 
    <label for="password">Password:</label>
    <input class="visible" type="password" id="password" name="password" value="<?php echo $password;?>"><br><br>

	
	 <label for="mobile">Mobile name:</label>
    <input class="visible" type="text" id="mobile" name="mobile" value="<?php echo $mobile;?>" pattern="[1-9]{9}"><br><br>
	

	 <label for="address">Company addresss:</label>
	 <textarea class="visible" id="address" name="address" cols="45" rows="10" ><?php echo htmlspecialchars($address); ?></textarea>

	
    <div class="profilebtn">	
    <input type="submit" name="save" id="update" value="save">
	 <input type="button" name="No" id="delete" value="No" onclick="window.location.href='accountDetails.php'">
	 
	</div>
	</div>
	 </div>
  </fieldset>
  
  
  
  
</form>
	
	<?php
	   if(isset($_POST["save"])){
		   // echo htmlspecialchars($message);
		   //get updated  details
		   $companyName=$_POST["company"];
		   $userNameUp=$_POST["username"];
		   $firstName=$_POST["fname"];
		   $lastName=$_POST["lname"];
		   $emailNew=$_POST["email"];
		   $passwordNew=password_hash($_POST["password"],PASSWORD_DEFAULT);
		   $newMobile=$_POST["mobile"];
		   $companyAddress=$_POST["address"];
		   		   
		   
		   //VendorProPic
		   $ImageName=$_FILES["propic"]["name"];
		   $ImageTempName=$_FILES["propic"]["tmp_name"];
		   $ImageSize=$_FILES["propic"]["size"];
		   //explode from punctuation mark
		  // $tempfilext=explode('.',$ImageName);//this is array consist of boht name and type
		   //end() function returns the last element of array strtolower will convert string to lowercase
		  // $fileext=strtolower(end($tempfilext));
		   //alllowed extentions
		  // $allowed=array('jpg','jpeg','png');
		  //in_array($fileext,$allowed
		   $targetPropicdir="Uploads/VendorProPic/";
		   $target_image=$targetPropicdir.basename($ImageName);
		  // echo $target_image;
		   if(true){
			     if($ImageSize<2000000){
					 
					  move_uploaded_file($ImageTempName,$target_image);
					 
				 }else{
					 echo "Image is too big";
				 }
			   			   			   
		   }else{
			   echo "Image type is not allowed";
		   }
		  
	
		  		  		   
      $sqlstatement="Update Vendor
               SET  v_username='$userNameUp',v_imgLoc='$target_image',v_fname='$firstName',
			   v_lname='$lastName',v_password='$passwordNew',v_mobile=$newMobile,v_address='$companyAddress',
			   v_company='$companyName',v_email='$emailNew'
               WHERE vendorID=3;";						  
		   if(mysqli_query($conn,$sqlstatement)){
			  
			  echo "<script>alert('Updated')</script>";
			  
			
		   }else{
			   echo "Error cannot update vendor because: ".$conn->error;
		   }
		   
		   
	   }
	
		 
	
	
	
		
	
	
	?>
	</div>
	
<!-- Code segment for display Announcements related to vendor ------------------>
<section class="adminAnnouncement">
    <?php
        $today = date("Y-m-d");
        $sql = "SELECT * from Announcement 
                WHERE
                    user_type = 'vendor' AND
                    publish_date = '" . $today . "'
        ";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
            echo "
                <div class='announcements'>
                    <h3>Title = ". $row["title"] ."</h3>
                    <h5>Description = ". $row["annDescription"] ."</h5>
                </div>
                ";
            }
        } else {
            echo "
                <div class='announcements'>
                    <h3>No Announcements Today!</h3>
                </div>
                ";
        }
    ?>
</section>
<!-- --------------------------------------------------------------------------------- -->

<section>
    <h1 class="main-title">vendorDashboard Page</h1>
</section>


<script src="./assets/js/vendorDashboard.js"></script>
<?php include("footer.php"); ?>

	
	
	
	
	
	
	
	
	
	
	
	
	
