<?php
session_start();
include('../koneksi/koneksi.php');

// Check if property ID is set
if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

    // Fetch property details including price
    $sql_property = "SELECT `name`, `rooms`, `total_area`, `price`, `category`, `launch_date`, `description`, `image_url` FROM `properties` WHERE `id`='$property_id'";
    $query_property = mysqli_query($koneksi, $sql_property);
    $property = mysqli_fetch_assoc($query_property);

    if (!$property) {
        echo "Property not found.";
        exit;
    }
} else {
    echo "Property ID not specified.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include("includes/header.php") ?>

  <?php include("includes/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-building"></i> Property Details</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Property Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <a href="properties.php" class="btn btn-sm btn-secondary float-right"><i class="fas fa-arrow-left"></i> Back to Properties</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                    <tbody>  
                      <tr>
                        <td colspan="2"><i class="fas fa-info-circle"></i> <strong>PROPERTY DETAILS</strong></td>
                      </tr> 
                      <tr>
                        <td width="20%"><strong>Name</strong></td>
                        <td width="80%"><?php echo $property['name']; ?></td>
                      </tr>                
                      <tr>
                        <td width="20%"><strong>Rooms</strong></td>
                        <td width="80%"><?php echo $property['rooms']; ?></td>
                      </tr>                
                      <tr>
                        <td width="20%"><strong>Total Area (sqm)</strong></td>
                        <td width="80%"><?php echo $property['total_area']; ?></td>
                      </tr> 
                      <tr>
                        <td width="20%"><strong>Price</strong></td>
                        <td width="80%"><?php echo $property['price']; ?></td>
                      </tr> 
                      <tr>
                        <td width="20%"><strong>Category</strong></td>
                        <td width="80%"><?php echo $property['category']; ?></td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Launch Date</strong></td>
                        <td width="80%"><?php echo $property['launch_date']; ?></td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Description</strong></td>
                        <td width="80%"><?php echo nl2br($property['description']); ?></td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Image</strong></td>
                        <td width="80%">
                          <?php if(!empty($property['image_url'])): ?>
                            <img src="images/<?php echo $property['image_url'];?>" class="img-fluid" width="200px;">
                          <?php else: ?>
                            No Image
                          <?php endif; ?>
                        </td>
                      </tr>                
                    </tbody>
                  </table>  
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">&nbsp;</div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("includes/footer.php") ?>

</div>
<!-- ./wrapper -->

<?php include("includes/script.php") ?>
</body>
</html>
