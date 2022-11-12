<?php
include "header.php";
include '../Function/page/cart_Process.php';
$billInsert = new checkOutClass();
$getOrderItem   = new Order();

if (!empty($_SESSION['user'])) {
	if (!empty($_POST['Phone'])) {

		$billInsert->insertOrderInfo($_SESSION['CustomerId'], $_POST['Address'], $_POST['Phone'], $_POST['Recipient_Name'], $_POST['Note']);
		foreach ($getOrderItem->getOrder($_SESSION['user']) as $value) {


			$billInsert->insertOrderDetail($value['ProductId'], $value['Users'], $value['Soluong'], $value['TongTien']);
		}
	}
	$billInsert->clearTableOrder($_SESSION['user']);
} else {
	header('Location: index.php');
	die();
}


?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../style/ProCart.css">
	<link rel="stylesheet" type="text/css" href="../style/css2.css">
	<link rel="stylesheet" href="../style/checkOut.css">
</head>

<body>
	<div>
		<button id="buttontrangchu"><a href="index.php">Trang Chủ</a></button>
		<?php

		foreach ($billInsert->showbill($_SESSION['CustomerId']) as $value) :
		?>
			<div class="checkOut">

				<table>
					<tr>
						<td></td>
						<td>Tên Sản Phẩm</td>
						<td>Số Lượng</td>
						<td>Thành Tiền</td>
					</tr>
					<?php
					foreach ($billInsert->showtableorderdetail($value['OrderTime']) as $productOrder) :

					?>



						<tr>

							<td><img src="<?php print($productOrder['Link']); ?>"> </td>
							<td><?php print($productOrder['ProductName']); ?> </td>
							<td><?php print($productOrder['Soluong']) ?></td>
							<td><?php print($productOrder['TongTien']) ?></td>




						</tr>

				</table>
			<?php
					endforeach;
			?>

			<p>Thành Tiền:
				<?php
				$k = $billInsert->totalTableOrderDetail($value['OrderTime']);
				foreach ($k as  $valueTotal) {

					print($valueTotal['total'] . " ");
				}
				?>

				VND</p>
			<p>Địa Chỉ: <?php print $value['Address'] ?></p>
			<p>Số Điện Thoại: <?php print $value['Phone'] ?> </p>
			<p>Tên Người Đặt Hàng: <?php print($value['RecipientName']) ?> </p>
			<p>Ghi Chú: <?php print($value['Note']) ?> </p>
			</div>
			<hr>
		<?php

		endforeach;
		?>

	</div>



</body>

</html>