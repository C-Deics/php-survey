<?php 
/* -- Group Project Code
Summary page which outputs all of
the user's selected information
from the previous forms -- */

function summary(){ ?>

    <h1 class="inputs">Summary of your answers</h1>
    <div class = "summary">
        
            <h4>Full Name:</h4><p><?php echo($_SESSION['fullName']); ?></p>
        <br>
            <h4>Age:</h4><p><?php echo($_SESSION['age']); ?></p>
        <br>
            <h4>Student Type:</h4><p><?php if($_SESSION['studentType'] =='p'){echo"Part-Time";}
		else if($_SESSION['studentType'] =='f'){ echo"Full-Time";}
		else if($_SESSION['studentType'] =='n'){ echo"Not a student";}  ?></p>
       <br>
            <h4>How you Purchased:  </h4><p><?php if($_SESSION['howPurchased'] == 1){echo"Online";} 
		else if($_SESSION['howPurchased'] == 2){echo"By Phone";}
		else if($_SESSION['howPurchased'] == 3){echo"Mobile App";}
		else if($_SESSION['howPurchased'] == 4){echo"In-Store";}
?></p>
        <br>
            <?php foreach($_SESSION['purchases'] as $purchase){ ?>
                <h4 style="border-top: 2px solid #e67e22; padding-top: 10px;"><?php echo("Product:  ");?></h4><p><?php echo($purchase['name']); ?></p>
                <h4><?php echo("	Rating:  "); ?></h4><p><?php echo($purchase['satisfaction']); ?></p>
                <h4><?php echo("	Would you Recommend:  ") ; ?></h4><p><?php echo($purchase['recommend']); ?></p>
            <?php } ?>
        <br>
<form method="POST">
        
        <div class="btn">
            <input class="button" type="submit" name="survey_b_back" value="Back">
            <input class="button" type="submit" name="survey_b_save" value="Save">
            </div>
        
</form>
      
<?php } ?>
