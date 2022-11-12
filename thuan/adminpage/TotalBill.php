<?php

include '../function/admin/billManager.php';
include '../function/page/cart_Process.php';
$billManager =new BillManager();
$cartProcess =new checkOutClass();




?>
<div class="totalBill">
	<div class="chooseDate">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
			<select id="date_select" name="date">
				<option value="1">Hôm nay</option>
				<option value="7">1 tuần trước</option>
				<option value="15">15 ngày trước</option>
				<option value="30">30 ngày trước</option>
			</select>
			<input type="submit" name="" value="Kiểm Tra">
		</form>
	</div>

	<script>
		let dateSelect = document.getElementById("date_select");
		let hrefNow =window.location.href;
		dateSelect.value= hrefNow.split("date=")[1];
	</script>

	<div class="showResult">


<?php 
if(!empty($_GET['date']))
foreach ($billManager->getBill($_GET['date']) as $value) :
?>

	<table>	
		
<?php	
	foreach ($cartProcess->showtableorderdetail($value['OrderTime']) as $productOrder) :
	
?>

		
	    
	        <tr>
	                    
	                <td><img class="billImg" src="<?php print( $productOrder['Link']); ?>"> </td>
	                <td><?php print($productOrder['ProductName']); ?> </td>
	                <td><?php print($productOrder['Soluong']) ?></td>
	                <td><?php print($productOrder['TongTien']) ?></td>                   
	                
	        </tr>        
	                	
	               
	        
	    
	   
<?php 
	endforeach;
?>	   
	
</table> 
	   	<p>Thành Tiền: 
	   		<?php 
	   			$k=$cartProcess->totalTableOrderDetail($value['OrderTime']);
	   			foreach ($k as  $valueTotal) {
						
						print($valueTotal['total']." ");

			} 
		?>

	   	 VND</p>
	    <p>Địa Chỉ : <?php print $value['Address'] ?></p>
	    <p>Số Điện Thoại: <?php print $value['Phone'] ?> </p>
	    <p>Tên Người Đặt Hàng: <?php print($value['RecipientName']) ?>  </p>
	    <p>Ghi Chú: <?php print($value['Note']) ?> </p>
	
	
	<hr>
<?php

endforeach;
?>

</div>
</div>
	
	
</div>