<?php
session_start();
include('../koneksi/koneksi.php');

// Paginasi
$limit = 5; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search_query = "";
if (!empty($search)) {
    $search_query = "WHERE p.name LIKE '%$search%' OR c.name LIKE '%$search%' OR r.comment LIKE '%$search%'";
}

// Fetch reviews
$sql = "SELECT r.id, p.name AS property_name, c.name AS customer_name, r.rating, r.comment, r.review_date
        FROM reviews r
        INNER JOIN properties p ON r.property_id = p.id
        INNER JOIN customers c ON r.customer_id = c.id
        $search_query
        LIMIT $offset, $limit";
$query = mysqli_query($koneksi, $sql);

// Query total data
$sql_total = "SELECT COUNT(*) AS total FROM reviews r
              INNER JOIN properties p ON r.property_id = p.id
              INNER JOIN customers c ON r.customer_id = c.id
              $search_query";
$query_total = mysqli_query($koneksi, $sql_total);
$total_data = mysqli_fetch_assoc($query_total)['total'];
$total_pages = ceil($total_data / $limit);
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
                    <h3><i class="fas fa-star"></i> Reviews</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Reviews</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a href="add_review.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Add Review</a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <form action="reviews.php" method="get" class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by property, customer, or comment" name="search" value="<?php echo $search; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Property Name</th>
                            <th>Customer Name</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Review Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($data = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['property_name']; ?></td>
                            <td><?php echo $data['customer_name']; ?></td>
                            <td><?php echo $data['rating']; ?></td>
                            <td><?php echo $data['comment']; ?></td>
                            <td><?php echo $data['review_date']; ?></td>
                            <td>
                                <a href="view_review.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> View</a>
                                <a href="delete_review.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this review?');"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="reviews.php?page=<?php echo $i; ?>&search=<?php echo $search; ?>" class="btn btn-sm <?php if ($i == $page) echo 'btn-primary'; else echo 'btn-default'; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </section>
</div>

<?php include("includes/footer.php") ?>
</div>
<?php include("includes/script.php") ?>
</body>
</html>
