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
    $from = "out.php";
    if(isset($_SERVER['HTTP_REFERER'])){
        $from = $_SERVER['HTTP_REFERER'];
    }
    
    
    if (!isset($_GET['get_log'])) {
        $_SESSION['status'] = "failed";
        $_SESSION['message'] = "Catatann tidak ditemukan";
        header('Location:' . $_SERVER['HTTP_REFERER']);
        return;    
    }

    $categoories = mysqli_query($connection, "select * from categories where type='out' and deleted_at is NULL ORDER BY name ASC");

    // edit category
    if (isset($_GET['get_log'])) {
        $id = ($_GET['get_log']);
        $categoory = mysqli_query($connection, "select * from logs where deleted_at is NULL and id = '$id'");
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
                        <input type="hidden" name="log_id" required value='<?php echo $id ?>'>
                        <input type="hidden" name="from" required value='<?php echo $from ?>'>
                        
                        <label for="desc">Deskripsi</label>
                        <input type="text" placeholder="Deskripsi Pemasukan" name="desc" required value='<?php echo $row[1]?>'>

                        <label for="value">Jumlah</label>
                        <input type="text" placeholder="Jumlah Pemasukan" name="value" required value='<?php echo $row[3]?>'>

                        <label for="category_id">Kategori</label>
                        <select name="category_id" class="custom-select">
                            <?php while($category = mysqli_fetch_array($categoories)){
                                if($category['id'] ==$row[2] ){
                                    echo '<option selected value="'.$category['id']. '">'.$category['name'].'</option>';
                                }else{
                                    echo '<option value="'.$category['id']. '">'.$category['name'].'</option>';
                                }
                            } ?>
                        </select>

                        <input  type="submit" name="update_log"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</body>
</html>