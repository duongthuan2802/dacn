<?php
include 'header.php';

function getProductByCategoryId($id)
{

    $sql=null;
    $con=new mysqli('localhost','root','root','thuan');
    if((int)$id -1>=0)
    { 
        $sql= "select *from Products where Id=$id";
    }    
    else  {
         $sql= "select *from Products where productName like N'%$id%'";  
    }    
    return $con->query($sql);

}


if(empty($_GET['getAll']))
{
    header('Location: index.php');
    die();
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>Cửa hàng</title>
    
    <link rel="stylesheet" href="../style/danhsach.css">
    <link rel="stylesheet" href="../style/css2.css">
</head>
<body>
<main>

    <?php
    $dem=0;
    $checkNull=0;
    foreach (getProductByCategoryId($_GET['getAll']) as  $value) :

        if($dem%4==0){ print('<div class="group-card">');}
        $dem=$dem+1;
        $checkNull+=1;
        ?>


        <div class="container-card ds-card">
            <img src="<?php print($value['Link']) ?>" alt="Laptop-Macbook">
            <p><?php print($value['ProductName']) ?></p>
            <p><?php print($value['Price']) ?></p>
            <form action="cart.php" method="get">
                <input type="hidden" name="ProductId" value="<?php print($value['ProductId']) ?>">
                <input class="button-card" type="submit" name="" value="Mua Ngay">
            </form>
        </div>



        <?php
        if($dem%4==0&&$dem!=0){print("</div>");}

    endforeach;?>
    <?php if($dem/4!=0){print("</div>"); }  ?>

    <?php 
        if ($checkNull==0)
        {
            echo "<h1 style='margin-top: 140px'>Không tìm thấy kết quả trùng với " .$_GET['getAll']. "</h1>";
        }


    ?>






</main>
</body>
</html>