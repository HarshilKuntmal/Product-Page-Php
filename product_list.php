<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Product List</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>SR No</th>
                <th>Category Name</th>
                <th>Product</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 10;
        $start = ($page - 1) * $limit;
        $sql = "SELECT * FROM Products LIMIT $start, $limit";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sr_no = 1;
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$sr_no."</td><td>".$row["Category_Name"]."</td><td>".$row["Product"]."</td></tr>";
                $sr_no++;
            }
        } else {
            echo "<tr><td colspan='3'>No products found</td></tr>";
        }
        ?>
        </tbody>
    </table>
    <?php
    $sql = "SELECT COUNT(*) AS total FROM Products";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_pages = ceil($row["total"] / $limit);

    echo "<br><br>Page: ";
    for ($i=1; $i<=$total_pages; $i++) {
        echo "<a href='product_list.php?page=".$i."'>".$i."</a> ";
    }
    ?>
</div>
</body>
</html>
<?php $conn->close(); ?>
