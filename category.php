<?php 
	session_start();
    require_once 'libs/auth.php';
    ValidateLogin();
    $uri = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    include ('connection.php');
    $categoories = mysqli_query($connection, "select * from categories where deleted_at is NULL ORDER BY name ASC");
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
                <div class="column100">
                    <div class="card" style="background-color: #5bc0de;">
                        Daftar Kategori
                    </div>
                    <div class="card-left">
                        <a href="category_form.php?new_category=new" class="btn-action"><i class="fa fa-plus-square"></i> Tambah Baru</a>
                    </div>
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
                    <table id="table_in" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tipe</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_array($categoories)){
                                echo '<tr style="text-align:center">';
                                echo '<td style="text-align:left">'.$row['name'].'</td>';
                                echo '<td>'.$row['type'].'</td>';
                                echo '<td>
                                    <a href="category_form.php?get_category='.$row['id'].'" class="btn-action"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="action.php?delete_category='.$row['id'].'" class="btn-action"><i class="fas fa-trash"></i> Hapus</a>
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
        $('#table_in').DataTable({
            "pageLength": 25
        });
    } );
</script>