<!-- INDEX FILE -->

<!-- ADDING PHP --> 
<?php
  //CALLING HEADER
  require ('./header.php');

  //CALLING CONNECTION PAGE
  require ('./connection.php');

  //IF STATEMENT TO SAVE USER INPUT 
  if(isset($_POST['save'])){

    //ENTER USERS INPUT 
    //STMT = statment 
    $stmt = $connect->prepare('insert into teamProfile(fullname,email,bio) values (:fullname,:email,:bio)');

    $stmt->bindValue('fullname', $_POST['fullname']);
    $stmt->bindValue('email', $_POST['email']);
    $stmt->bindValue('bio', $_POST['bio']);

    //EXECUTE 
    $stmt->execute();
    header("location:index.php");
  }



  //IF STATEMENT TO DELETE 
  if(isset($_GET['action']) && $_GET['action'] == 'delete'){


    $stmt = $connect->prepare('delete from teamProfile where fullname = :fullname');
    $stmt->bindValue('fullname', $_GET['fullname']);
    $stmt->execute();
}

  //GETTING DATA FROM THE DATABAS, HENCE SELECT ALL 
  $stmt = $connect->prepare('select * from teamProfile');
  $stmt->execute();
?>


  <!-- HTML --> 
  <main class="container">

    <section class="masthead">
      <div>
        <h1>Our Teams Profile Page</h1>
      </div>
    </section>

    <!-- MAKING FORM --> 
    <section class="form-row row">
      <div class="col-sm-12 col-md-6 col-lg-6">
        <h3>Please Enter in the Forms to be on the Profile Page!</h3>
        <form method="post" action="index.php">


        	<p><input class="form-control" name="fullname" type="text" placeholder="Full Name" required/></p>

        	<p><input class="form-control" name="email" type="email" placeholder="Email" required/></p>

            <p><input class="form-control" name="bio" type="text" placeholder="Bio" required/></p>

            <input class="btn btn-dark" type="submit" name="save" value="Save"/>
        </form>
      </div><br>

      <!-- MAKING A TABLE TO DISPLAY DATABASE -->
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email</th>
            <th scope="col">Bio</th>
          </tr>
        </thead>

        <!-- FETCHING DATA FROM DATABASE --> 
        <?php while($teamProfile = $stmt->fetch(PDO::FETCH_OBJ)) {?>
          <tr>
            <td><?php echo $teamProfile->fullname; ?></td>
            <td><?php echo $teamProfile->email; ?></td>
            <td><?php echo $teamProfile->bio; ?></td>
            <td>
              <a onclick="return confirm('Are you sure you want to delete this?')" class="btn btn-danger" href="index.php?fullname=<?php echo $teamProfile->fullname ?>&action=delete">Delete</a>

              <a class="btn btn-primary" href="edit.php?fullname=<?php echo $teamProfile->fullname ?>">Edit</a>
            </td>
          </tr>
        <!-- CLOSING PHP --> 
        <?php }?>
      </table>
    </section>
  </main>

<!-- FILE PATH TO FOOTER --> 

<?php require ('./footer.php'); ?>