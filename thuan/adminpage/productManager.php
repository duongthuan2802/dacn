<?php 
	include '../function/admin/productManager.php';
	$product    = new products();
	$categories = new categories();
	$show='none';
	$showUpdate='none';
	$getUpdateValues=null;
	if(!empty($_POST['delete']))
	{
		$product->Delete($_POST['delete']);
		$show='true';	
	}
	if(!empty($_POST['update']))
	{
		$showUpdate='true';
		$getUpdateValues= $product->getUpdate($_POST['update']);

	}

	if( !empty($_POST['ProductName']))
{
	$product->update(
			$_POST['ProductName'],
			$_POST['Price'],
			$_POST['Link'],
			$_POST['Screen'],
			$_POST['Os'],
			$_POST['CameraS'],
			$_POST['CameraT'],
			$_POST['Cpu'],
			$_POST['Ram'],
			$_POST['Rom'],
			$_POST['Memory_stick'],
			$_POST['Description'],
			$_POST['Category_Id'],
			$_POST['ProductId']
		);
}
	
?>


<div>
	<div>
		<h3 style="display: <?php print $show ?>">Xóa Thành Công</h3>
	</div>
</div>
<div class="main">	
	<?php foreach ($product->show() as $value) : ?>
	<div class="item_PM">	
		<div class="left_PM">
			<p class="productname"><?php print $value['ProductName'] ?></p>
			<img src="<?php print $value['Link'] ?>">
		</div>
		<div class="right_PM"> 
			<div class="infomation">
				<span>Màn Hình:</span>   <span class="info2"><?php print( $value['Screen']) ?>	</span>
			</div>
			<div class="infomation">
				<span>Hệ Điều Hành:</span>  <span class="info2">	<?php print( $value['Os']) ?></span>
			</div>
			<div class="infomation">
				<span>Cammera Sau:</span> 		<span class="info2"><?php print( $value['CameraS']) ?>	</span>
			</div>
			<div class="infomation">
				<span>Camera Trước:</span>		<span class="info2"><?php print( $value['CameraT']) ?>	</span>
			</div>
			<div class="infomation">
				<span>CPU :</span>		<span class="info2"><?php print( $value['Cpu']) ?>	</span>
			</div>
			<div class="infomation">
				<span>Ram :</span>		<span class="info2"><?php print( $value['Ram']) ?>	</span>
			</div>
			<div class="infomation">
				<span>Bộ nhớ trong :</span>		<span class="info2"><?php print( $value['Rom']) ?>	</span>
			</div>
			<div class="infomation">
				<span>Thẻ Nhớ :</span>		<span class="info2"><?php print( $value['Memory_stick']) ?>	</span>
			</div>
			<div class="infomation">
				<span>Mô Tả :</span>		<span class="info2"><?php print( $value['Description']) ?>	</span>
			</div>


			<div class="Update_Delete" style="display: flex;">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<input type="hidden" name="update" value="<?php  print($value['ProductId'])?>">
					<input type="submit" value="Sửa">
				</form>
				<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<input type="hidden" name="delete" value="<?php  print($value['ProductId'])?>">
					<input type="submit" value="Xóa">
				</form>
				

			</div>
		</div>
	</div>
	
		
	

<hr>	

<?php endforeach;?>	
</div>

<div class="update_product" style="display: <?php print $showUpdate ?>" >
	<div class="close">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<input type="submit" name="" value="Thoát">
		</form>
		
	</div>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		<select name="Category_Id">
		<?php foreach ($categories->get() as $value) : ?>
		 	<option value=" <?php  print $value['Id'];?> "><?php print $value['CategoryName'] ;?></option>
			
		<?php endforeach; ?>
	    </select><br>
	    <?php if(!empty($getUpdateValues)) foreach ($getUpdateValues as $value) : ?>
			<input type="hidden" name="ProductId" value="<?php print $value['ProductId'] ?>">
			<table>
				<tr>
					<th><label>Tên Sản Phẩm</label></th>
					<td><input type="text" name="ProductName" value="<?php print ($value['ProductName']) ?>" ></td>
				</tr>
				<tr>
					<th><label>Giá</label></th>
					<td><input type="text" name="Price" value="<?php print $value['Price'] ?>"></td>
				</tr>
				<tr>
					<th><label>Link</label></th>
					<td><input type="text" name="Link" value="<?php print $value['Link'] ?>"></td>
				</tr>
				<tr>
					<th><label>Màn Hình</label></th>
					<td><input type="text" name="Screen" value="<?php print $value['Screen'] ?>"></td>
				</tr>
				<tr>
					<th><label>Hệ Điều Hành</label></th>
					<td><input type="text" name="Os" value="<?php print $value['Os'] ?>"></td>
				</tr>
				<tr>
					<th><label>Camera sau</label></th>
					<td><input type="text" name="CameraS" value="<?php print $value['CameraS'] ?>"></td>
				</tr>
				<tr>
					<th><label>Camera trướcc</label></th>
					<td><input type="text" name="CameraT" value="<?php print $value['CameraT'] ?>"></td>
				</tr>
				<tr>
					<th><label>CPU</label></th>
					<td><input type="text" name="Cpu" value="<?php print $value['Cpu'] ?>"></td>
				</tr>
				<tr>
					<th><label>Ram</label></th>
					<td><input type="text" name="Ram" value="<?php print $value['Ram'] ?>"></td>
				</tr>
				<tr>
					<th><label>Bộ Nhớ Trong</label></th>
					<td><input type="text" name="Rom" value="<?php print $value['Rom'] ?>"></td>
				</tr>
				<tr>
					<th><label>Thẻ Nhớ</label></th>
					<td><input type="text" name="Memory_stick" value="<?php print $value['Memory_stick'] ?>"></td>
				</tr>
				<tr>
					<th><label>Mô Tả</label></th>
					<td><input type="text" name="Description" value="<?php print $value['Description'] ?>"></td>
				</tr>
			</table>	

			<input type="submit" name="" value="Sửa">
		<?php endforeach; ?>
	</form>



	
</div>
