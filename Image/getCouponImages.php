<?php
    require  __DIR__ . '/../ServerConnection.php';

    $coupon_id= $_POST['coupon_id'];

    $res= $img_dao->getImagesByCouponId($coupon_id);

    echo json_encode($res);
?>
