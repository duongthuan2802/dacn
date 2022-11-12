<?php
include '../function/page/loginManager.php';
$Users =new Users();
session_start();
	
$mess=null;

	if(!empty($_POST['passwordcheck']))
	{
		if($_POST['passwordcheck']==$_POST['password'])
		{
			if($Users->insert($_POST['userName'],$_POST['password']))
				{
					$mess ='Tạo Tài Khoản Thành Công';
					
				}
			else{
				$mess="Tên Đăng Nhập Đã tồn Tại";
			}	
		}
		else
		{
			$mess="Nhập Khẩu không trùng khớp";
		}	
		$GLOBALS['value'] ="Đăng Ký";
 		$GLOBALS['check_value']="Đăng Nhập";
	}
	else
	{	
		if(!empty($_POST['userName']))
		{
			if( !empty( $Users->checkuserlogin($_POST['userName'],$_POST['password'])[0] )    )
					{
						
						$_SESSION['user']=$_POST['userName'];
						$_SESSION['CustomerId']=$Users->checkuserlogin($_POST['userName'], $_POST['password'])[0];
						if($Users->checkuserlogin($_POST['userName'], $_POST['password'])[1] =='user')
            			{
                			header('Location: index.php');
                			die();
            			}  
            			else if($Users->checkuserlogin($_POST['userName'], $_POST['password'])[1]=='admin')
           				 {	
           				 	$_SESSION['admin']='admin';
                			header('Location: ../adminpage/menu.php');
                			die();
            			}  
					}
			else{
					$mess="Sai Tài Khoản Hoặc Mật Khẩu";
			}
		}	
		$GLOBALS['value'] ="Đăng Nhập";
 		$GLOBALS['check_value']="Đăng Ký";	
	}


if((empty($check_value) || empty($value)) && empty($_POST['userName']))
{
	$GLOBALS['value'] ="Đăng Nhập";
 	$GLOBALS['check_value']="Đăng Ký";
}


	if(!empty($_POST['checklogin']) &&$_POST['checklogin']=="Đăng Nhập" && empty($_POST['userName'])  )
	{
		$check_value="Đăng Ký";
		$value      ="Đăng Nhập";
	}
	
	if(!empty($_POST['checklogin']) &&$_POST['checklogin']=="Đăng Ký" &&empty($_POST['userName']))
	{
		$check_value="Đăng Nhập";
		$value      ="Đăng Ký";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>	</title>
	<link rel="stylesheet" type="text/css" href="	../style/login.css">
	<link rel="stylesheet" type="text/css" href="	../style/css2.css">
	<!-- CSS only -->

</head>
<body>
<div class="container">	
	<?php if($value=="Đăng Nhập") {?>
		<div class="sign_in">
		<img id="imgin_up"src="https://topthuthuat.com/wp/wp-content/uploads/2018/01/laptop-nao-tot.jpg" />
				<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post"> 
					<h1>Đăng Nhập</h1>
					<input  type="text" name="userName" placeholder="Tên đăng nhập..."><br>	
					<input type="password" name="password" placeholder=" Mật khẩu..." required><br>	
					<input type="submit" name="" value="Đăng Nhập" id="singin_button" required><br>	
					<?php print $mess ?>
					
				</form>	
				

		</div >
	<?php } else {?>	
		<div class="sign_up">	
		<img id="imgin_up"src="https://topthuthuat.com/wp/wp-content/uploads/2018/01/laptop-nao-tot.jpg" />
				<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<h1>Đăng Ký</h1>
				   <input type="text" name="userName" placeholder="Tên đăng nhập..." required><br>	
				   <input type="password" name="password" placeholder=" Mật khẩu..." required><br>	
				   <input type="password" name="passwordcheck" placeholder="Điền lại mật khẩu..." required><br>	
				   <input  type="submit" name="" value="Đăng Ký" id="singup_button">
				   <?php print $mess; ?>
				</form>	
		</div>
	<?php } ?>	
		<div class="right">	
			<h2 id="welcome">Hello!</h2>
			<div class="form_button">
				<form class="changeform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 

					<input type="hidden" name="checklogin" value="<?php  print($check_value)?>">
					<input type="submit" name="" value="<?php print $check_value?>">
				</form>
				<button	id="buttontrangchu"><a href="index.php">Trang Chủ</a></button>
			</div>
		</div>

</div>

</body>
</html>