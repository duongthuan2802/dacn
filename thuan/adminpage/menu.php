<?php
session_start();


if(!empty($_POST['action']))
{
	$_SESSION['page']=$_POST['action'];	
}
if( empty($_SESSION['admin']))
{
	header('Location: ../page/notfound.php');
                			die();
	
}




?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../style/admin/menu.css">

</head>
<body >
<div class="top">
	<h1>Admin page Website </h1>
	<a href="../page/logout.php">Đăng Xuất</a>

</div>
<div class="content">
	<div class="left">
		<form action="" method="post">
			<input type="hidden" name="action" value="addProduct">
			<input type="submit" name="" value="Thêm Sản Phẩm">
			
		</form>

		<form action="" method="post">
			<input type="hidden" name="action" value="productManager">
			<input type="submit" name="" value="Hiển Thị Sản Phẩm">
			
		</form>
		<form action="" method="post">
			<input type="hidden" name="action" value="TotalBill">
			<input type="submit" name="" value="Tổng Hóa Đơn">
			
		</form>
	</div>
	<div class="center">
		<?php
			if(!empty($_SESSION['page'])&& $_SESSION['page']=='addProduct')
			{
				include 'product.php';

			}
			elseif (!empty($_SESSION['page'])&& $_SESSION['page']=='productManager') {
				include 'productManager.php';
			}
			elseif (!empty($_SESSION['page'])&& $_SESSION['page']=='TotalBill') {
				include 'TotalBill.php';
			}

			else
			{
				echo "<h1>Xin Chào Admin ".$_SESSION['user']. "</h1>";
			}
		?>
	</div>
</div>
<div class="footer"></div>
<?php 


?>
</body>
</html>