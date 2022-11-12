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



class products extends connectDatabase
{
	
	public function getProduct()
	{

		$sql = "select *from products";
        return 		$result=$this->Connection()->query($sql);

	}

	public function getLaptop()
	{

		$sql = "select *from products where Id=6";
        return 		$result=$this->Connection()->query($sql);

	}

    public function getProductById($id) {
        $sql = "select *from products where Id=$id";
        return $this->Connection()->query($sql);
    }

}
?>