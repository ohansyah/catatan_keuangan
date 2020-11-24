<?php 
	session_start();
	if (isset($_SESSION['session']) && $_SESSION['login'] != "" && $_SESSION['login'] != "failed") {
		header('Location: dashboard.php');
	}
?>

<!DOCTYPE html>
<html>
<?php include 'head.php';?>
	<body>
		<?php
			if (isset($_SESSION['session']) && $_SESSION['login'] != "" && $_SESSION['login'] != "failed") {
				header('Location: dashboard.php');
			}else{
				include 'login.php';
			}
		?>
	</body>
</html>