<?php
if (isset($_POST['btnLower']))
{
	$userNum = $userNum - 1;
	if ($userNum < 0)
	{
		if ($curPage > 1)
		{
			$userNum = $userNum + $count;
			$curPage = $curPage - 1;
		}
	}
	
	if ($curPage <= 1)
	{
		$curPage = 1;
		
		if ($userNum <= 0)
		{
			$userNum = 0;
		}
	}
	
	// päivittää sivun uusi parametreilla
	header("location:testi.php?count=" . $count . "&curPage=" . $curPage . "&userNum=" . $userNum);
}

if (isset($_POST['btnGreater']))
{
	if ($lastID > ($curPage - 1) * $count + $userNum + 1)
	{
		$userNum = $userNum + 1;
		
		if ($userNum >= $count)
		{
			$userNum = $userNum - $count;
			$curPage = $curPage + 1;
		}
	}
		
	// päivittää sivun uusilla parametreilla
	header("location:testi.php?count=" . $count . "&curPage=" . $curPage . "&userNum=" . $userNum);
} 
?>