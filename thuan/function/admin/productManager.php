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
/**
 * 
 */
class categories extends connectDatabase
{
	public function insert($CategoryName)
	{
		$sql = "insert into categories(CategoryName) values('$CategoryName')";
		$this->Connection()->query($sql);

	}
    public function get()
    {
        $sql ="select *from categories";
        $result=$this->Connection()->query($sql);
        return $result;
    }

}
class products extends connectDatabase
{
	
	public function insert(
            $ProductName,
            $Price,
            $Link,
            $Screen,
            $Os,
            $CameraS,
            $CameraT,
            $Cpu,
            $Ram,
            $Rom,
            $Memory_stick,
            $Description,
            $CategoryId
            )
	{
        $sql="insert into products(
            ProductName,
            Price,
            Link,
            Screen,
            Os,
            CameraS,
            CameraT,
            Cpu,
            Ram,
            Rom,
            Memory_stick,
            Description,
            Id
        )

         values('$ProductName',
            '$Price',
            '$Link',
            '$Screen',
            '$Os',
            '$CameraS',
            '$CameraT',
            '$Cpu',
            '$Ram',
            '$Rom',
            '$Memory_stick',
            '$Description',
             $CategoryId
            )";

            $this->Connection()->query($sql);
		
	}


    public function show()
    {
        $sql="select *from products";
        return $this->Connection()->query($sql);

    }

    public function Delete($id)
    {
        $sql= "delete from products where ProductId='$id'";
        $this->Connection()->query($sql);
    }
    public function getUpdate($id)
    {
        $sql= "select * from products where ProductId='$id'";
         return $this->Connection()->query($sql);
    }
    public function update 
    (
            $ProductName,
            $Price,
            $Link,
            $Screen,
            $Os,
            $CameraS,
            $CameraT,
            $Cpu,
            $Ram,
            $Rom,
            $Memory_stick,
            $Description,
            $CategoryId,
            $ProductId
            )
    {
        $sql="update  products
            set ProductName='$ProductName',
             Price ='$Price' ,
             Link ='$Link',
             Screen = '$Screen',
             Os = '$Os',
             CameraS = '$CameraS',
             CameraT = '$CameraT',
             Cpu = '$Cpu',
             Ram = '$Ram',
             Rom = '$Rom',
             Memory_stick ='$Memory_stick',
             Description = '$Description',
             Id ='$CategoryId'
            where ProductId ='$ProductId'
            ";


     $this->Connection()->query($sql);

    }
}


?>