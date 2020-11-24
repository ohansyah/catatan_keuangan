<?php 
	session_start();
    require_once 'libs/auth.php';
    ValidateLogin();
    $uri = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    include ('connection.php');

    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $id = 'new';
    
    if (!isset($_GET['get_category']) && !isset($_GET['new_category'])) {
        $_SESSION['status'] = "failed";
        $_SESSION['message'] = "Kategori tidak ditemukan";
        header("Location: category.php");
        return;    
    }

    // edit category
    if (isset($_GET['get_category'])) {
        $id = ($_GET['get_category']);
        $categoory = mysqli_query($connection, "select * from categories where deleted_at is NULL and id = '$id'");
        $row = $categoory->fetch_row();
    }
    
?>
<!DOCTYPE html>
<html>
<?php include 'head.php';?>
	<body>
        <!-- Side navigation -->
        <?php include 'sidebar.php'; ?>

        <!-- Page content -->
        <div class="main">
            <div class="row">
                <div class="column50">
                    <div class="card" style="background-color: #5bc0de;">
                        Data Kategori
                    </div>
                    <form action="action.php" method="post">
                    <div class="container">
                        <input type="hidden" name="category_id" required value=<?php echo $id ?>>
                        
                        <label for="name">Nama Kategori</label>
                        <input type="text" placeholder="Nama Kategori" name="name" value="<?php echo $row[1];?>" required>
                        
                        <label for="type">Tipe Kategori</label>
                        <select name="category_type" class="custom-select">
                            <option <?php if($row[2] == 'in' )echo 'selected ' ?>value="in">in</option>
                            <option <?php if($row[2] == 'out')echo 'selected ' ?>value="out">out</option>
                        </select>
                        <input  type="submit" name="update_category"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</body>
</html>