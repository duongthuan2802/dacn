<?php

class connectDatabase1
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
class BillManager extends connectDatabase1
{
	
	public function getBill($date)	
	{
		$sql="select * from orderinfo  where datediff(now(),OrderTime) <'$date' ";
		 return $this->Connection()->query($sql);
	}
}


?>