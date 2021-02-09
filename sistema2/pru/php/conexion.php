<?php
	
    $conn = new mysqli("localhost","gilbertm_root","Grupogilbert2020","gilbertm_prueba");
    $count = 0;
    $sql2 = "SELECT * FROM datos WHERE estado = 0";
    $result = mysqli_query($conn, $sql2);
    $count = mysqli_num_rows($result);
?>