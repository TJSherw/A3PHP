<!-- EDIT FILE --> 

<!-- CALLING HEADER --> 
<?php require ('./header.php');

    //CALLING CONNECTION PAGE 
    require ('./connection.php');

    //SELECTING DATA WHICH USER WANTS TO EDIT 
    $stmt = $connect->prepare('select * from teamProfile where fullname = :fullname');
    $stmt->bindValue('fullname',$_GET['fullname']);
    $stmt->execute();
    $teamProfile = $stmt->fetch(PDO::FETCH_OBJ);

    //SAVE/UPDATE
    if(isset($_POST['save'])){
    
        //IF SAVE BUTTON CLICKED SAVE/UPDATE INFO 
        $stmt = $connect->prepare('update teamProfile set email =:email, bio =:bio where fullname =:fullname');

        $stmt->bindValue('fullname',$_POST['fullname']);
        $stmt->bindValue('email',$_POST['email']);
        $stmt->bindValue('bio',$_POST['bio']);

        $stmt->execute();

        //REDIRECT TO INDEX PAGE
        header("location:index.php"); 
}
?>

<!-- HTML -->
<section class="form-row row">
    <div class="col-mid-12">

        <h3>Youre on the Edit Page!</h3>
        
        <form method="post" autocomplete="off">
        <fieldset>
        <table cellpadding="2" cellspacing="2">
            <tr>
                <td>Full Name</td>
                <!-- CALL FOR FULLNAME TO DISPLAY BEFORE EDIT -->
                <td><input type="text" name="fullname" value="<?php echo $teamProfile->fullname; ?>"></td>
            </tr>

            <tr>
                <td>Email</td>
                <!-- CALL FOR EMAIL TO DISPLAY BEFORE EDIT -->
                <td><input type="text" name="email" value="<?php echo $teamProfile->email; ?>"></td>
            </tr>

            <tr>
                <td>bio</td>
                <!-- CALL FOR BIO TO DISPLAY BEFORE EDIT -->
                <td><input type="text" name="bio" value="<?php echo $teamProfile->bio; ?>"></td>
            </tr>

            <tr>
                <td>&nbsp;</td><input class="btn btn-dark" type="submit" name="save" value="Update"/></tr>
        </fieldset>
        </form>
    </div><br>







<?php require ('./footer.php'); ?>