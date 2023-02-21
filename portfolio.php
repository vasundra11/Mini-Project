<?php 
  session_start();
  require_once 'core/init.php';
  include 'includes/header.php'; 
?>

<?php 
  $sql = "SELECT * FROM portfolio";
  $internships = $db->query($sql);
?>
<main>
  <h3 class="text-center p-3">List of Portfolios</h3>
  <div class="container-fluid row">
    <!-- List of Portfolios -->
    <?php while($portfolio = mysqli_fetch_assoc($portfolio)): ?>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h2 class="p-2 text-center card-title"><?=$portfolio['portfolioname'];?></h2>
        </div>
        <div class="card-body">
          <h4 class="p-2 h4-responsive float-left"><?=$portfolio['author'];?></h4>
          <h5 class="p-2 h5-responsive float-right"><b>Price </b><?=$portfolio['price'];?></h5>
          <table class="table table-bordered">
            <thead>
              <th>ID</th>
              <th>Name</th>
              <th>Author</th>
              <th>Price</th>
             </thead>
            <tbody>
              <tr>
                <td><?=$portfolio['id'];?></td>
				<td><?=$portfolio['name'];?></td>
				<td><?=$portfolio['author'];?></td>
                <td>&#8377; <?=$portfolio['price'];?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <a href="portfoliodetail.php?internship=<?=$portfolio['id'];?>" class="btn btn-success btn-black waves-effect z-depth-0">View Details</a>
        </div>
      </div>
    </div>
    <?php endwhile;?>
  </div>
  <br>
</main>
<?php include 'includes/footer.php'; ?>