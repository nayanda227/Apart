<?php
session_start();
include('../koneksi/koneksi.php');

// Fetch customers with search condition
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM customers";
if (!empty($search)) {
    $sql .= " WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
}
$query = mysqli_query($koneksi, $sql);

// Pagination
$limit = 5; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql_total = "SELECT COUNT(*) AS total FROM customers";
if (!empty($search)) {
    $sql_total .= " WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
}
$query_total = mysqli_query($koneksi, $sql_total);
$total_data = mysqli_fetch_assoc($query_total)['total'];
$total_pages = ceil($total_data / $limit);

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
                    <h3><i class="fas fa-users"></i> Customers</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a href="add_customer.php" class="btn btn-sm btn-info float-right"><i class="fas fa-plus"></i> Add Customer</a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <form action="customers.php" method="get" class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by name or email" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($data = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['name']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['phone']; ?></td>
                            <td><?php echo $data['address']; ?></td>
                            <td>
                                <a href="view_customer.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> View</a>
                                <a href="edit_customer.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                <a href="delete_customer.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this customer?');"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="customers.php?page=<?php echo $i; ?>&search=<?php echo $search; ?>" class="btn btn-sm <?php if ($i == $page) echo 'btn-primary'; else echo 'btn-default'; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include("includes/footer.php") ?>
</div>
<?php include("includes/script.php") ?>
</body>
</html>
