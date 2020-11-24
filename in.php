<?php 
	session_start();
    require_once 'libs/auth.php';
    ValidateLogin();
    $uri = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    include ('connection.php');
    $categoories = mysqli_query($connection, "select * from categories where type='in' and deleted_at is NULL ORDER BY name ASC");
    $logs = mysqli_query($connection, "select `logs`.id, `logs`.`desc`, `logs`.`value`, categories.`name` from `logs` JOIN categories on categories.id = `logs`.category_id where categories.type='in' and `logs`.deleted_at is NULL ORDER BY `logs`.id ASC");

    // sum uang masuk
    $query_sum = mysqli_query($connection, "select SUM(`value`) as sum_in from `logs` JOIN categories on categories.id = `logs`.category_id where categories.type='in' and `logs`.deleted_at is NULL");
    $sum = mysqli_fetch_row($query_sum);
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
                <?php 
                    if(isset($_SESSION['status']) && $_SESSION['status'] == "failed"){
                        echo '<div class="text-danger" for="uname">'.$_SESSION['message'].'</div>';
                        unset($_SESSION['status']);
                        unset($_SESSION['message']);
                    }else if(isset($_SESSION['status']) && $_SESSION['status'] == "success"){
                        echo '<div class="text-success" for="uname">'.$_SESSION['message'].'</div>';
                        unset($_SESSION['status']);
                        unset($_SESSION['message']);
                    }
                ?>
                <div class="column25">
                    <div class="card">
                        Tambah Pemasukan
                    </div>
                    <form action="action.php" method="post">
                        <div class="container">
                        <label for="desc">Deskripsi</label>
                        <input type="text" placeholder="Deskripsi Pemasukan" name="desc" required>

                        <label for="value">Jumlah</label>
                        <input type="text" placeholder="Jumlah Pemasukan" name="value" required>

                        <label for="category_id">Kategori</label>
                        <select name="category_id" class="custom-select">
                            <?php while($row = mysqli_fetch_array($categoories)){
                                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                            } ?>
                        </select>

                        <input  type="submit" name="add_in" style="background-color: #5cb85c;"></input>
                        </div>
                    </form>
                </div>
                <div class="column75">
                    <div class="card" style="background-color: #5bc0de;">
                        Catatan Masuk : Rp <?php echo number_format($sum[0]);?>
                    </div>
                    <table id="table_in" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Deskripsi</th>
                                <th>Kategory</th>
                                <th>Jumlah</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_array($logs)){
                                echo '<tr>';
                                echo '<td>'.$row['desc'].'</td>';
                                echo '<td>'.$row['name'].'</td>';
                                echo '<td style="text-align: right;"> Rp '.number_format($row['value']).'</td>';
                                echo '<td>
                                    <a href="log_form.php?get_log='.$row['id'].'" class="btn-action"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="action.php?delete_log='.$row['id'].'" class="btn-action"><i class="fas fa-trash"></i> Hapus</a>
                                </td>';
                                echo '</tr>';
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</body>
</html>

<script>
    $(document).ready(function() {
        $('#table_in').DataTable();
    } );
</script>