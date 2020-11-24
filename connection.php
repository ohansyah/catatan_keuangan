<?php
	$connection = mysqli_connect("localhost","root","","catatan_keuangan");
	if (mysqli_connect_errno()){
		echo mysqli_connect_error();
	}
?>