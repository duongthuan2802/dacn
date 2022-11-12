<?php
include "header.php";
include '../Function/page/cart_Process.php';
$OrderTable = new Order();
$ProductClass = new get_Products_ById();
$CountNum = 1;
if (!empty($_GET['ProductId'])) {


    // $_SESSION['cart']=$_SESSION['cart']."n".$_GET['ProductId'];
    if (!$OrderTable->checkProductInOrder($_GET['ProductId'])) {
        if (!empty($_SESSION['user'])) {
            $productCollection = $ProductClass->get_product($_GET['ProductId'])[0];
            $OrderTable->insertOrder($_GET['ProductId'], $_SESSION['user'], $productCollection['Price']);
        } else {

            $c = array_search($_GET['ProductId'], $_SESSION['cart']);
            if (empty($c)) {
                array_push($_SESSION['cart'], $_GET['ProductId']);
            }
        }
    }
}

if (!empty($_SESSION['user']) && !empty($_SESSION['cart'])) {


    foreach ($_SESSION['cart'] as $value) {
        $productCollection = $ProductClass->get_product($value);
        $OrderTable->insertOrder($value, $_SESSION['user'], $productCollection['Price']);
        array_splice($_SESSION['cart'], 0, 1);
    }
}


//have delete request without $_SESSION['user'] => delete with session

if (!empty($_POST['delete']) && empty($_SESSION['user'])) {
    $count = count($_SESSION['cart']);


    array_splice($_SESSION['cart'], (int)$_POST['delete'], 1);
    if ($_POST['delete'] == 100) {
        array_splice($_SESSION['cart'], 0, 1);
    }
}

//have delete request with $_SESSION['user'] => delete with database
if (!empty($_POST['delete']) && !empty($_SESSION['user'])) {

    $OrderTable->deleteOrder($_POST['delete'], $_SESSION['user']);
}

if (!empty($_POST['update']) && !empty($_SESSION['user'])) {
    $OrderTable->updateTableOrder($_POST['update'], $_POST['soluong'], $_SESSION['user']);
}

$cart_item = null;
if (!empty($_SESSION['user'])) {

    $cart_item = $OrderTable->getOrder($_SESSION['user']);
} else {
    $cart_item = $_SESSION['cart'];
}
















$getProById = new get_Products_ById();

?>


<link rel="stylesheet" type="text/css" href="../style/ProCart1.css">
<link rel="stylesheet" type="text/css" href="../style/css2.css">

<div id="cart_">
    <table>
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>

        </tr>
        <?php $dem=0; $tien = 0;?>
        <?php if ($cart_item) : ?>
            <?php foreach ($cart_item as $item) : ?>
                <?php $productItem = $getProById->get_product($item['ProductId'])[0] ?>
                <tr>
                    <td>
                        <?php echo ($productItem['ProductName']) ?>
                    </td>
                    <td>
                        <p id="<?php echo ($item['ProductId']) ?>_price"><?php echo ($item['TongTien']) ?></p>
                    </td>
                    <td id="qty_td">
                        <input hidden type="text" name="product_id" value="<?php echo ($item['ProductId']) ?>">
                        <input id="<?php echo ($item['ProductId']) ?>_qty" type="text" name="soluong" value="<?php echo ($item['Soluong']) ?>">
                    </td>
                    <td>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <input type="hidden" name="update" class="update" value="<?php
                                if (!empty($_SESSION['user'])) {
                                    print($item['ProductId']);
                                } else {
                                    if ($dem === 0) {
                                        print(100);
                                    } else {
                                        print($dem);
                                    }
                                }

                                ?>">
                            <input id="<?php echo($item['ProductId']) ?>_soluong_post" type="hidden" name="soluong" class="soluong" value="<?php echo ($item['Soluong']) ?>">
                            <input type="submit" name="" value="luu">
                        </form>
                    </td>
                    <td>
                        <form id="form_delete" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <input type="hidden" name="delete" class="delete" value="<?php
                                if (!empty($_SESSION['user'])) {
                                    print($item['ProductId']);
                                } else {
                                    if ($dem === 0) {
                                        print(100);
                                    } else {
                                        print($dem);
                                    }
                                }

                                ?>">
                            <input id="delete_item" type="submit" name="" value="Xoa">
                        </form>
                    </td>
                </tr>
                <script>
                    var price<?php echo ($item['ProductId']) ?> = document.getElementById("<?php echo ($item['ProductId']) ?>_price");
                    var qty<?php echo ($item['ProductId']) ?> = document.getElementById("<?php echo ($item['ProductId']) ?>_qty");
                    const inputHandler<?php echo ($item['ProductId']) ?> = function(e) {
                        document.getElementById('<?php echo ($item['ProductId']) ?>_soluong_post').value = qty<?php echo ($item['ProductId']) ?>.value;
                        price<?php echo ($item['ProductId']) ?>.innerHTML = (parseInt(e.target.value) * parseInt('<?php echo ($productItem['Price']) ?>')) ? (parseInt(e.target.value) * parseInt('<?php echo ($productItem['Price']) ?>')) : 0;
                    }
                    qty<?php echo ($item['ProductId']) ?>.addEventListener('input', inputHandler<?php echo ($item['ProductId']) ?>);
                    qty<?php echo ($item['ProductId']) ?>.addEventListener('propertychange', inputHandler<?php echo ($item['ProductId']) ?>);
                </script>
            <?php $dem +=1 ?>
            <?php $tien = $tien + $item['TongTien'];?> 
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <table>
        <tr>
            <th>Tong tien</th>
        </tr>
        <tr>
            <td><p id="total_price">0</p></td>
        </tr>
    </table>
</div>
<script>
    document.getElementById("total_price").innerHTML = <?php echo($tien) ?>;
</script>
<form action="CheckOut.php" method="post">
    <input type="submit" value="thanh toan">
</form>
</body>

<script type="text/javascript" src='../javascript/vueJs.js'></script>

</html>