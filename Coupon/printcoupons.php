<?php

	require  __DIR__ . '/../ServerConnection.php';

	$arr= $cpn_dao->getAllCoupons();

	//echo $cpn_dao->getCoupon(1);
	echo '<br><br>';

	echo '<table>';
	echo '<tr>';
	echo '<th>coupon id</th>';
	echo '<th>name</th>';
	echo '<th>category id</th>';
	echo '<th>description</th>';
	echo '<th>image url</th>';
	echo '<th>busines id</th>';
	echo '<th>normal price</th>';
	echo '<th>new price</th>';
	echo '</tr>';

	foreach ($arr as $cop) // coupon object
	{
		echo '<tr>';
		echo '<td>' . $cop->getId() . '</td>';
		echo '<td>' . $cop->getName() . '</td>';
		echo '<td>' . $cop->getCategory() . '</td>';
		echo '<td>' . $cop->getDescription() . '</td>';
		echo '<td>' . $cop->getImage() . '</td>';
		echo '<td>' . $cop->getBussinessId() . '</td>';
		echo '<td>' . $cop->getNormalPrice() . '</td>';
		echo '<td>' . $cop->getNewPrice() . '</td>';
		echo '</tr>';
	}
	echo '</table>';
?>
