<!--IT20664558 D.M.P.D.Daundasekara-->

<?php
// include database connection file
 include_once("./src/dbh.php");    
                
    
  include("header.php"); 

include("./src/customer/customerConfig.php"); 
$customerID=$_SESSION['id'];   

// Get id from URL to delete 
$feedbackID = $_GET['feedbackID'];
$adID = $_GET['adID']; 



if(isset($_POST['update']))
{	

	$feedbackID = $_POST['feedbackID'];
	$fbdescription=$_POST['fbdescription'];
	$rating=$_POST['rating'];
	
		
	// update 
   if(mysqli_query($conn, "UPDATE feedback SET fbdescription='$fbdescription', rating='$rating' WHERE feedbackID=$feedbackID AND adID=$adID ")){  
		
	    // Redirect to feedback to display updated
		header("Location: feedback.php?feedbackID=$feedbackID & adID=$adID & customerID= $_SESSION[id]  ");
	
 }
}
?>
<?php
// Display selected  data based on id
// Getting id from url

$feedbackID = $_GET['feedbackID'];
$adID=$_GET['adID'];

// Fetech  data based on id
$result = mysqli_query($conn, "SELECT * FROM feedback WHERE feedbackID='$feedbackID' ");

while($row = mysqli_fetch_array($result))
{
	
	$fbdescription = $row['fbdescription'];
	$rating = $row['rating'];
	
}
?>
<html>
<head>	
	<title>Edit feedback Data</title>
</head>

<body background image>
	
	<br/><br/>
	
	<form class="form" method="post" >
		<table border="0">
			
			<tr> 
				<td>comment</td>
		<td><input type id="comment" name="fbdescription"  value="<?php echo $fbdescription;?>"  ></textarea>
		</td>
			</tr>
			<tr> 
				<td>How would you rate your experience</td>
				<td><input list="rating" name="rating"value="<?php echo $rating;?>"></td>
 			<td> <datalist id="rating" >
  	 		<option value="1-Awful">
    		<option value="2-need to improve">
   			 <option value="3-Neutral">
    		<option value="4-Great">
    		<option value="5-Fantastic">
  			</datalist> </td>
			</tr>
			<tr>
				<td><input type="hidden" name="feedbackID" value=<?php echo $_GET['feedbackID'];?>></td>
				<td><input type="hidden" name="adID" value=<?php echo $_GET['adID'];?>></td>
				<td><input type="hidden" name="customerID" value=<?php echo $_GET['customerID'];?>></td>
				<td><input type="submit" name="update" value="Update" onclick="done()"></td>
			</tr>
		</table>
	</form>

	<script src="./assets/js/feedbackedit.js"></script>

</html>

