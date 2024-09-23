<?php
session_start();
include('../koneksi/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $property_id = $_POST['property_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $review_date = date('Y-m-d');

    $sql = "INSERT INTO reviews (customer_id, property_id, rating, comment, review_date) VALUES ('$customer_id', '$property_id', '$rating', '$comment', '$review_date')";
    mysqli_query($koneksi, $sql);

    header('Location: reviews.php?notif=addberhasil');
    exit;
}

$sql_customers = "SELECT id, name FROM customers";
$query_customers = mysqli_query($koneksi, $sql_customers);

$sql_properties = "SELECT id, name FROM properties";
$query_properties = mysqli_query($koneksi, $sql_properties);
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

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3><i class="fas fa-plus"></i> Add Review</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Add Review</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <form action="add_review.php" method="post">
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control">
                            <?php while ($customer = mysqli_fetch_assoc($query_customers)): ?>
                                <option value="<?php echo $customer['id']; ?>"><?php echo $customer['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="property_id">Property</label>
                        <select name="property_id" id="property_id" class="form-control">
                            <?php while ($property = mysqli_fetch_assoc($query_properties)): ?>
                                <option value="<?php echo $property['id']; ?>"><?php echo $property['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <input type="number" name="rating" id="rating" class="form-control" max="5" min="1">
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea name="comment" id="comment" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Review</button>
                </form>
            </div>
        </div>
    </section>
</div>

<?php include("includes/footer.php") ?>
</div>
<?php include("includes/script.php") ?>
</body>
</html>
