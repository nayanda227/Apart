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
    $search_query = "WHERE title LIKE '%$search%' OR content LIKE '%$search%' OR type LIKE '%$search%'";
}

// Fetch news and events
$sql = "SELECT * FROM news $search_query LIMIT $offset, $limit";
$query = mysqli_query($koneksi, $sql);

// Query total data
$sql_total = "SELECT COUNT(*) AS total FROM news $search_query";
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
                    <h3><i class="fas fa-newspaper"></i> News</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">News</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <a href="add_news.php" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add News</a>
                </div>
            <div class="card-body">
            <div class="mb-3">
                    <form action="news.php" method="get" class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by title, content, or type" name="search" value="<?php echo $search; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                <div class="row">
                    <?php while ($data = mysqli_fetch_assoc($query)): ?>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"><?php echo $data['title']; ?></h5>
                                <p class="card-text"><small class="text-muted"><?php echo $data['date']; ?></small></p>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?php echo $data['content']; ?></p>
                                <p class="card-text"><strong>Type: <?php echo ucfirst($data['type']); ?></strong></p>
                                <div class="btn-group">
                                    <a href="view_news.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> View</a>
                                    <a href="edit_news.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="delete_news.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this news?');"><i class="fas fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="news.php?page=<?php echo $i; ?>&search=<?php echo $search; ?>" class="btn btn-sm <?php if ($i == $page) echo 'btn-primary'; else echo 'btn-default'; ?>"><?php echo $i; ?></a>
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
