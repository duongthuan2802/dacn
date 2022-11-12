
<?php 
include '../function/admin/productManager.php';
$category = new categories();
$product  = new products();
$mess=null;
if( !empty($_GET['category']) )
{
	$category->insert($_GET['category']);
}

if( !empty($_GET['ProductName']))
{
	$product->insert(
			$_GET['ProductName'],
			$_GET['Price'],
			$_GET['Link'],
			$_GET['Screen'],
			$_GET['Os'],
			$_GET['CameraS'],
			$_GET['CameraT'],
			$_GET['Cpu'],
			$_GET['Ram'],
			$_GET['Rom'],
			$_GET['Memory_stick'],
			$_GET['Description'],
			$_GET['Category_Id']
		);
	$mess=' Thành Công';
}

?>


<div class="Bigproducts">	

	<div class="category">
		<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
				<input type="text" name="category">
				<input type="submit" name="" value="Thêm Loại Sản Phẩm">		
		</form>
		<?php echo $mess; ?>
	</div>	
	<div class="Product">	
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
			<select name="Category_Id">
			<?php foreach ($category->get() as $value) : ?>
			 	<option value=" <?php  print $value['Id'];?> "><?php print $value['CategoryName'] ;?></option>
				
			<?php endforeach; ?>
		    </select><br>
			<table>
				<tr>
					<th><label>Tên Sản Phẩm</label></th>
					<td><input type="text" name="ProductName"></td>
				</tr>
				<tr>
					<th><label>Giá</label></th>
					<td><input type="text" name="Price"></td>
				</tr>
				<tr>
					<th><label>Link</label></th>
					<td><input type="text" name="Link"></td>
				</tr>
				<tr>
					<th><label>Màn Hình</label></th>
					<td><input type="text" name="Screen"></td>
				</tr>
				<tr>
					<th><label>Hệ Điều Hành</label></th>
					<td><input type="text" name="Os"></td>
				</tr>
				<tr>
					<th><label>Camera sau</label></th>
					<td><input type="text" name="CameraS"></td>
				</tr>
				<tr>
					<th><label>Camera trước</label></th>
					<td><input type="text" name="CameraT"></td>
				</tr>
				<tr>
					<th><label>CPU</label></th>
					<td><input type="text" name="Cpu"></td>
				</tr>
				<tr>
					<th><label>Ram</label></th>
					<td><input type="text" name="Ram"></td>
				</tr>
				<tr>
					<th><label>Bộ Nhớ Trong</label></th>
					<td><input type="text" name="Rom"></td>
				</tr>
				<tr>
					<th><label>Thẻ Nhớ</label></th>
					<td><input type="text" name="Memory_stick"></td>
				</tr>
				<tr>
					<th><label>Mô Tả</label></th>
					<td><input type="text" name="Description"></td>
				</tr>
			</table>
			<input type="submit" name="" value="Thêm Sản Phẩm">

		</form>
		<?php echo $mess; ?>
	</div>	

</div>
