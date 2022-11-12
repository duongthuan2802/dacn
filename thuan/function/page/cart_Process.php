<?php
class connectDatabase
{

    public $sever ;
    public $userName ;
    public $password ;
    public $dataName ;
    public $result ;
    public function Connection()
    {
        $this->sever="localhost";
        $this->userName = "root";
        $this->password ="root";
        $this->dataName ="thuan";
        $result = new mysqli($this->sever, $this->userName,$this->password,$this->dataName);
        return $result;

    }


}




class get_Products_ById extends connectDatabase{

    public function get_product($id)
    {


        $sql= "select *from products where ProductId='$id'";
        $products_list=null;
        $result =$this->Connection()->query($sql);
        while ($row=$result->fetch_assoc()) {

           $products_list[]=$row;
        }
        return $products_list;
    }
 }


class Order extends connectDatabase
{

    function insertOrder($ProductId,$CustomerName,$ProductPrice)
    {
        $sql = "insert into tableorder(ProductId,Users,Soluong,TongTien) values('$ProductId','$CustomerName','1',$ProductPrice)";
        $this->Connection()->query($sql);
    }

    function checkProductInOrder($ProductId) {
        $sql = "select * from tableorder where ProductId='$ProductId'";
        $collection = $this->Connection()->query($sql);
        $result = false;
        $collection->num_rows ? $result = true : $result = false;
        return $result; 
    }

    function getOrder($CustomerName)
    {

        $sql= "  select * from tableorder where Users='$CustomerName'   ";
        $orderTable=null;
        $result =$this->Connection()->query($sql);

        while ($row=$result->fetch_assoc()) {

            $orderTable[]=$row;
        }

        return $orderTable;
    }
    function getOrderOfCustomer($CustomerName)
    {
        $sql="select products.ProductId,ProductName,Link,Soluong,TongTien  from products inner join tableorder on products.ProductId =tableorder.ProductId where OrderTime is null and Users='$CustomerName' ";
        return $this->Connection()->query($sql);


    }

    function deleteOrder($ProductId,$CustomerName)
    {
        $sql= "delete from tableorder where ProductId='$ProductId' and Users='$CustomerName' ";

        $this->Connection()->query($sql);
    }
     function updateTableOrder($productId,$soluong,$CustomerName)
    {
        $sql="update tableorder set Soluong=$soluong where ProductId=$productId and Users='$CustomerName'; ";
        $this->Connection()->query($sql);

        $sql2="update tableorder set TongTien = Soluong * (select Price from products where ProductId=$productId) where ProductId = $productId";
        $this->Connection()->query($sql2);

    }
     function total()
    {
        $sql="select sum(TongTien) as total from tableorder";
        return $this->Connection()->query($sql);
    }
}

/**
 * 
 */
class checkOutClass extends connectDatabase
{
    
    function insertOrderInfo($CustomerId,$Address,$Phone,$RecipientName,$Note)
    {
        $sql="insert into orderinfo(CustomerId,Address,Phone,RecipientName,Note,OrderTime) values('$CustomerId','$Address','$Phone','$RecipientName','$Note',now())";
        $this->Connection()->query($sql);
    }
    function insertOrderDetail($ProductId,$Users,$Soluong,$TongTien)
    {
        $sql="insert into tableorderdetail values(now(),$ProductId,'$Users',$Soluong,$TongTien)";
        $this->Connection()->query($sql);
    }
    function showBill($CustomerId)
    {
        $sql="select *from orderinfo where CustomerId='$CustomerId' order by OrderTime desc";
        return $this->Connection()->query($sql);       

        
    }
    function showtableorderdetail($OrderTime)
    {
        $sql="select *from tableorderdetail inner join products on tableorderdetail.ProductId=products.ProductId where OrderTime='$OrderTime' ";
        return $this->Connection()->query($sql);

    }
     function total($OrderTime)
    {
        $sql="select sum(TongTien) as total from tableorder";
        return $this->Connection()->query($sql);
    }
     function totalTableOrderDetail($time)
    {
        $sql="select sum(TongTien) as total from tableorderdetail where OrderTime='$time'";
        return $this->Connection()->query($sql);

    }
    function clearTableOrder($CustomerName)
    {
        $sql="delete from tableorder where  Users='$CustomerName'";
        $this->Connection()->query($sql);

    }

}



?>