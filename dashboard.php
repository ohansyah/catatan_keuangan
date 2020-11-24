<?php 
	session_start();
    require_once 'libs/auth.php';
    ValidateLogin();
    $uri = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    include ('connection.php');
    
    // sum uang masuk
    $query_sum_in = mysqli_query($connection, "select SUM(`value`) as sum_in from `logs` JOIN categories on categories.id = `logs`.category_id where categories.type='in' and `logs`.deleted_at is NULL");
    $sum_in = mysqli_fetch_row($query_sum_in);

    // sum uang keluar
    $query_sum_out = mysqli_query($connection, "select SUM(`value`) as sum_in from `logs` JOIN categories on categories.id = `logs`.category_id where categories.type='out' and `logs`.deleted_at is NULL");
    $sum_out = mysqli_fetch_row($query_sum_out);

    // selsin
    $margin = $sum_in[0] - $sum_out[0];

    // logs kategori masuk
    $category_in = mysqli_query($connection, "SELECT SUM( `logs`.`value` ) AS total, categories.`name` FROM `logs` JOIN categories ON `logs`.category_id = categories.id WHERE categories.type = 'in' and `logs`.deleted_at IS NULL GROUP BY `logs`.category_id ORDER BY categories.`name` ASC");

    // logs kategori masuk
    $category_out = mysqli_query($connection, "SELECT SUM( `logs`.`value` ) AS total, categories.`name` FROM `logs` JOIN categories ON `logs`.category_id = categories.id WHERE categories.type = 'out' and `logs`.deleted_at IS NULL GROUP BY `logs`.category_id ORDER BY categories.`name` ASC");

    // logs all
    $logs_all = mysqli_query($connection, "select * from `logs` where  `logs`.deleted_at is NULL ORDER BY `logs`.id ASC");
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
                <div class="column">
                    <div class="card">
                        Total Uang Masuk : Rp <?php echo number_format($sum_in[0]);?>
                    </div>
                    <table class="tb-flat" style="width:100%">
                        <tbody>
                            <?php while($row = mysqli_fetch_array($category_in)){
                                echo '<tr>';
                                echo '<td>'.$row['name'].'</td>';
                                echo '<td style="text-align: right;"> Rp '.number_format($row['total']).'</td>';
                                echo '</tr>';
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="column">
                    <div class="card" style="background-color: #f0ad4e;">
                        Total Uang Keluar : Rp <?php echo number_format($sum_out[0]);?>
                    </div>
                    <table class="tb-flat" style="width:100%">
                        <tbody>
                            <?php while($row = mysqli_fetch_array($category_out)){
                                echo '<tr>';
                                echo '<td>'.$row['name'].'</td>';
                                echo '<td style="text-align: right;"> Rp '.number_format($row['total']).'</td>';
                                echo '</tr>';
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="column">
                    <div class="card" style="background-color: #5bc0de;">
                        Selisih : Rp <?php echo number_format($margin);?>
                    </div>
                    <table class="tb-flat" style="width:100%">
                        <tbody>
                            <?php while($row = mysqli_fetch_array($logs_all)){
                                echo '<tr>';
                                echo '<td>'.$row['desc'].'</td>';
                                echo '<td style="text-align: right;"> Rp '.number_format($row['value']).'</td>';
                                echo '</tr>';
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</body>
</html>