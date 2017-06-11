<?php
$sigh = $_GET['sigh'];
$qty = $_GET['qty'];
$url = $_GET['url'];

for ($i=0; $i<$qty; $i++) {
	$u = str_replace('$L', '2', $url);
	$u = str_replace('$N', 'M'.$i, $u);
	echo '<img src="'.$u.'?sigh='.$sigh.'"><br>';
}
