<?php
include 'header.php';
include '../function/page/product_for_index.php';

$products = new products();



?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="../style/css2.css">
</head>

<body>



	<div class="QC">
		<div id="demo" class="carousel slide" data-ride="carousel">

			<ul class="carousel-indicators">
				<li data-target="#demo" data-slide-to="0" class="active"></li>
				<li data-target="#demo" data-slide-to="1"></li>
				<li data-target="#demo" data-slide-to="2"></li>
			</ul>

			<!-- The slideshow -->
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="img-QC" src="https://cdn.tgdd.vn/2020/10/banner/800-300-800x300-5.png" alt="Los Angeles" width="1100" height="500">
				</div>
				<div class="carousel-item">
					<img class="img-QC" src="https://cdn.tgdd.vn/2020/10/banner/Normal-Note20-800-300-800x300.png" alt="Chicago" width="1100" height="500">
				</div>
				<div class="carousel-item">
					<img class="img-QC" src="https://cdn.tgdd.vn/2020/09/banner/reno4-chung-800-300-800x300-1.png" alt="New York" width="1100" height="500">
				</div>
			</div>

			<!-- Left and right controls -->
			<a class="carousel-control-prev" href="#demo" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</a>
			<a class="carousel-control-next" href="#demo" data-slide="next">
				<span class="carousel-control-next-icon"></span>
			</a>
		</div>
	</div>
	<!-- <div class="frames">
  	<a class="highlights" href="">ĐIỆN THOẠI NỔI BẬT NHẤT</a>
  	<a class="list-phone" href="">Samsung Galaxy Note 20</a>
  	<a class="list-phone" href="">iPhone 11 Pro Max</a>
  	<a class="list-phone" href="">iPhone 11</a>
  	<a class="list-phone" href="">Redmi Note 9S</a>
  	<a class="list-phone" href="">OPPO Reno4</a>
  	<a class="list-phone" href="">Xem tất cả điện thoại</a>
  </div> -->
	<div class="container-list">
		<?php
		$dem = 0;
		foreach ($products->getProduct() as $value) :

			if ($dem == 0 || $dem % 5 == 0) {
				echo '
			<div class="column-display">
				<div class="column">

				';
			}

		?>


			<div class="nomal-product">

				<img class="nomal-img" src="<?php print($value['Link']) ?>">
				<p><?php print $value['ProductName'] ?></p>
				<p><?php print $value['Price'] ?><u>đ</u></p>
				<form action="cart.php" method="get">
					<input type="hidden" name="ProductId" value="<?php print($value['ProductId']) ?>">
					<input type="submit" name="" value="Mua ngay">
				</form>

			</div>





		<?php
			$dem = $dem + 1;
			if ($dem % 5 == 0) {
				echo '</div>
			
		</div>';
			}

		endforeach;
		?>
	</div>


	<div class="container-list">
		<?php
		$dem = 0;
		foreach ($products->getLapTop() as $value) :

			if ($dem == 0 || $dem % 5 == 0) {
				echo '
			<div class="column-display">
				<div class="column">

				';
			}

		?>


			<div class="nomal-product">

				<img class="nomal-img" src="<?php print($value['Link']) ?>">
				<p><?php print $value['ProductName'] ?></p>
				<p><?php print $value['Price'] ?><u>đ</u></p>

				<form action="cart.php" method="get">
					<input type="hidden" name="ProductId" value="<?php print($value['ProductId']) ?>">
					<input type="submit" name="" value="Mua ngay">
				</form>
			</div>





		<?php
			$dem = $dem + 1;
			if ($dem % 5 == 0) {
				echo '</div>
			
		</div>';
			}

		endforeach;
		?>
	</div>


	<div id="adress">
		<p id="information"><strong>Địa chỉ:</strong> thị trấn Thạnh Mỹ, H.Nam Giang, T.Quảng Nam. <strong>Điện thoại:</strong> 0528152456. <strong>Email:</strong> thuanduongk18@gmail.com. Chịu trách nhiệm nội dung: Dương Văn Thuận</p>


	</div>
</body>

</html>