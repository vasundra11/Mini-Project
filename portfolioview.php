<!DOCTYPE html>

<?php 
  session_start();
  include 'core/init.php';
  include 'includes/header.php';
  $sql = "SELECT * FROM portfolio;
  $portfolio = $db->query($sql);
?>

<html lang="en">

<?php 
  // Fetch the internship details
  if(isset($_GET['portfolio'])){
    $id = sanitize((int)$_GET['portfolio']);
    $sql = "SELECT * FROM portfolio WHERE id = '$id'";
    $sqlResult = $db->query($sql);
    $portfoliocount = mysqli_num_rows($sqlResult);
    if($portfoliocount > 0){
      while ($row = mysqli_fetch_array($sqlResult)) {
        $id = $row['id'];
        $portfolioname = $row['portfolioname'];
        $description = $row['description'];
        $features = $row['features'];
        $price = $row['price'];
        $author = $row['author'];
        $createdOn = $row['createdOn'];
      
      }
    }else{
      echo "Internship does not exist";
      exit();
    }
  }
  else{
    echo "Data is missing, please select the internship";
    exit();
  }
?>
  <!-- Display Portfolio details -->
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h2 class="p-2 text-center card-title"><?=$category;?> Portfolio Name <?=$portfolioname;?> by <?=$author;?></h2>
      </div>
      <div class="card-body">
        <h4 class="p-2 h4-responsive float-left"><?=$portfolioname;?></h4>
        <h5 class="p-2 h5-responsive float-right"><b>Price: </b><?=$price;?></h5>
        <table class="table table-bordered">
          <thead>
            <th>id</th>
            <th>portfolioname</th>
            <th>Created on On</th>
            <th>Author </th>
            <th>Price</th>
          </thead>
          <tbody>
            <tr>
              <td><?=$id;?> </td>
	      <td><?=$portfolioname;?></td>
	      <td><?=$createdOn;?></td>
	      <td><?=$author;?></td>
              <td>&#8377; <?=$price;?></td>
            </tr>
          </tbody>
        </table>
        <div class="text-justify py-2">
          <div class="aboutCompany">
            <h4 class="h4-responsive">About Portfolio</h4>
            <p class="py-2"><?=$description;?></p>
          </div>
          <div class="aboutInternship">
            <h4 class="h4-responsive">Features of Portfolio</h4>
            <p class="py-2"><?=nl2br($features);?></p>
          </div>
         </div>
      </div>

      <div class="card-footer">
        <?php
          if(!isset($_SESSION['email'])){
            echo "<a href='login.php' class='btn btn-success btn-black waves-effect z-depth-0' name='apply'>Buy Now</a>";
          }else{
            
            $email = $_SESSION['email'];
            $sqlcus = "SELECT * FROM customers WHERE email = '$email'";
            $result = $db->query($sqlcus);
            while ($row_pro = mysqli_fetch_array($result)) {
              $cus_id = $row_pro['id'];
              $cus_name = $row_pro['fullname'];
              $cus_email = $row_pro['email'];
              $cus_address1 = $row_pro['address1'];
              $cus_address2 = $row_pro['address2'];
              $cus_city = $row_pro['city'];
              $cus_state = $row_pro['state'];
              $cus_zipcode = $row_pro['zipcode'];
              $cus_phone = $row_pro['phone'];
              $cus_country = $row_pro['country'];
            }

            $sqlapp = "SELECT * FROM applications WHERE cus_id = '$cus_id' AND int_id = '$id'";
            $applications = $db->query($sqlapp);
            while($application = mysqli_fetch_array($applications)){
              $app_id = $application['id'];
              $cus_app_id = $application['cus_id'];
              $int_id = $application['int_id'];
              $applied = $application['applied'];
            }

            if(isset($cus_app_id) == $cus_id){              
              echo "<a href='#' class='btn btn-success btn-black waves-effect z-depth-0' name='applied'>Applied</a>";
            }else{
        ?>
        <a href="application.php?apply=<?=$id;?>" class="btn btn-success btn-black waves-effect z-depth-0" name="apply">Buy Now</a>
        <?php } } ?>
      </div>
    </div>
  </div>

<?php include 'includes/footer.php';?>
