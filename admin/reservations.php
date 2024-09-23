<?php
session_start();
include('../koneksi/koneksi.php');

// Search functionality
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch reservations with search filter and order by id
$sql = "SELECT r.id, c.name AS customer_name, p.name AS property_name, r.check_in, r.nights, r.total_price
        FROM reservations r
        LEFT JOIN customers c ON r.customer_id = c.id
        LEFT JOIN properties p ON r.property_id = p.id
        WHERE c.name LIKE '%$search_query%' OR c.email LIKE '%$search_query%'
        ORDER BY r.id ASC";

// Paginasi
$limit = 5; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query total data with search filter
$sql_total = "SELECT COUNT(*) AS total FROM reservations r
              LEFT JOIN customers c ON r.customer_id = c.id
              WHERE c.name LIKE '%$search_query%' OR c.email LIKE '%$search_query%'";
$query_total = mysqli_query($koneksi, $sql_total);
$total_data = mysqli_fetch_assoc($query_total)['total'];
$total_pages = ceil($total_data / $limit);

// Tambahkan LIMIT dan OFFSET ke dalam query utama
$sql .= " LIMIT $offset, $limit";
$query = mysqli_query($koneksi, $sql);
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
                    <h3><i class="fas fa-calendar-alt"></i> Reservations</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Reservations</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a href="add_reservation.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Add Reservation</a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <form action="reservations.php" method="get" class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by name or email" name="search" value="<?php echo htmlspecialchars($search_query); ?>">
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
                            <th>Customer</th>
                            <th>Property</th>
                            <th>Check_In</th>
                            <th>Nights</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($data = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['customer_name']; ?></td>
                            <td><?php echo $data['property_name']; ?></td>
                            <td><?php echo $data['check_in']; ?></td>
                            <td><?php echo $data['nights']; ?></td>
                            <td><?php echo $data['total_price']; ?></td>
                            <td>
                                <a href="view_reservation.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> View</a>
                                <a href="edit_reservation.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                <a href="delete_reservation.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this reservation?');"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="reservations.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search_query); ?>" class="btn btn-sm <?php if ($i == $page) echo 'btn-primary'; else echo 'btn-default'; ?>"><?php echo $i; ?></a>
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
