<?php
include "header.php";
include '../Function/page/cart_Process.php';
$idProduct =null;
$quantityProduct=null;
$OrderTable = new Order();
$dem=0;
if(empty($_SESSION['user']))
{
	header('Location: login.php');
            die();
}
else
{
	$dem=1;
}

if(!empty($_POST['id']) )
{
	//echo $_POST;
	$idProduct = explode('n',$_POST['id']);
	$quantityProduct =explode('n',$_POST['quantity']);
	for($i=0;$i<count($idProduct) - 1;$i++)
	{
		$OrderTable->updateTableOrder( $idProduct[$i] , $quantityProduct[$i],$_SESSION['user'] );
		$dem+=1;
	}
}


if($dem==0)
{
	print '<script>alert("Your cart is null") </script>';
}


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<link rel="stylesheet" href="../style/checkOut1.css">
	<link rel="stylesheet" type="text/css" href="../style/ProCart1.css">
	<link rel="stylesheet" type="text/css" href="../style/css2.css">

	<script type="text/javascript">
		
		let checkcount = <?php print($dem); ?>;
		if( checkcount==0)
		{
			window.location='http://localhost/thuan/page/index.php';
		}
	</script>
		


	
</head>
<body>
<div id="mainCheckOut">
	<div class="checkOut">	
		
		<h1 class="bill">Hóa Đơn</h1>
		<table>
		<tr>
			<td></td>
			<td>Tên Sản Phẩm</td>
			<td>Số lượng</td>
			<td>Thành Tiền</td>
		</tr>
	    <?php
	    $dem=0;

	    if(!empty($idProduct)| !empty($_SESSION['user']))       
	             foreach ( $OrderTable->getOrderOfCustomer($_SESSION['user']) as $value):
	    ?>
	        <tr>    
	                    
	                <td><img src="<?php print($value['Link']); ?>"> </td>
	                <td><?php print($value['ProductName']); ?> </td>
	                <td><?php print($value['Soluong']) ?></td>
	                <td><?php print($value['TongTien']) ?></td>
	                   
	                
	                
	                	
	                
	        </tr>
	    <?php
	            endforeach;


	    ?>
	    
	   </table>
	   	<p>Thành Tiền: <?php 
	   			$k=$OrderTable->total();
	   			foreach ($k as  $value) {
						
						print($value['total']." ");
					}

	   	 ?>VND</p>
	</div>
	<div class="infomation">
		<form action="bill.php" method="post">
			<input type="text" name="Address" placeholder="Địa Chỉ..." v-model="address"  required><br>
			<input type="text" name="Phone" placeholder="Số Điện Thoại..." required v-model="phone"><br>
			<input type="text" name="Recipient_Name" placeholder=" Tên Người Đặt Hàng..." required v-model="recipient"><br>
			<input type="text" name="Note" placeholder="Ghi Chú..."  v-model="note"><br>
			<input type="submit" name="" value="Thanh Toán">
		</form>
		
	</div>
</div>

<script type="text/javascript" src="../javascript/CheckOut1.js"></script>
</body>
</html>