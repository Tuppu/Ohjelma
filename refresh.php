<?php
$toPageNumber = $_POST['2pageNumber'];
$resultsPerPage = $_POST['resultsPerPage'];

header("location:testi.php?count=".$resultsPerPage."&curPage=".$toPageNumber."&userNum=0");
?>