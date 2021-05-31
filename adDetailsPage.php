<?php
    // Dynamic Header
    $title = 'Commercial Detail'; include("header.php");
    if (!(isset($_SESSION["id"]))) {
        header("location: ./index.php");
    }
?>

<link rel="stylesheet" href="./assets/css/adDetailsPage.css">

<!-- Gaween -->
<!-- Type your code here -->
<section>
    <body>
        <center>
    <h1 class="main-title">Commercial Details</h1>


    <?php
        $sql = mysqli_query($conn,"SELECT *
        FROM Advertisement AS A, Vendor AS V
        WHERE A.adID ='" . $_GET['adID'] . "' AND V.vendorID=A.vendorID
        ;");

        $row  = mysqli_fetch_array($sql);
        
        echo "<h3>". $row['title'] ."</h3>";
        echo "<h3>". $row['addDescription'] ."</h3>";
        echo "<h3>". $row['mobile'] ."</h3>";
        echo "<h3>". $row['publishDateTime'] ."</h3>";
        echo "<h3>". $row['v_fname'], " ", $row['v_lname'] ."</h3>";

        if (isset($_SESSION["id"])) {
            if($_SESSION["role"] === 'customer') {
                echo "<a href='./src/customer/choice.src.php?adID=". $row['adID'] ."&cID=". $_SESSION['id'] ."'><button>Add</button></a>";
                echo "<a href='./feedback.php?adID=". $row['adID'] ."'><button>Add Feedback</button></a>";
            }
        }
    ?>
</section>
</center>
</body>
<section style="margin">

</section>

<script src="./assets/js/adDetailsPage.js"></script>

<?php include("footer.php"); ?>