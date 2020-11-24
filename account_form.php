<?php 
    session_start();
    $uri = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    include ('connection.php');
    if (!(isset($_SESSION['session'])) || !(isset($_SESSION['username']))){
        include './action_logout.php';
        return;
    }

    $username = $_SESSION['username'];
    $session = $_SESSION['session'];
    $query = mysqli_query($connection, "SELECT * FROM `user` WHERE username = '$username' AND `session` = '$session'");
    if (mysqli_num_rows($query) < 1) {
        include './action_logout.php';
        return;
    }
    $row = $query->fetch_row();
    
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

                    <div class="card" style="background-color: #5bc0de;">
                        Data User
                    </div>
                    <form action="action_setting.php" method="post">
                    <div class="container">
                        <input type="hidden" name="id" required value=<?php echo $row[0];?>>
                        
                        <label for="name">Ubah Username</label>
                        <input type="text" placeholder="Nama Pegguna" name="username" value="<?php echo $row[1];?>" required>
                        
                        <input  type="submit" name="update_username"></input>

                        <hr>
                        <label for="password">Ubah Password</label>
                        <input type="password" placeholder="Konfirmasi Password untuk menguah Password" name="password">
                        
                        <label for="new_pass">New Password</label>
                        <input type="password" placeholder="Isi untuk megganti Password" name="new_pass">
                        
                        <label for="re_new_pass">Re-type Password</label>
                        <input type="password" placeholder="Masukkan kembali Password baru" name="re_new_pass">
                        
                        
                        <input  type="submit" name="update_password"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	</body>
</html>