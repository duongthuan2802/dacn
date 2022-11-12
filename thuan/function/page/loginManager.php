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
class Users extends connectDatabase
{
    
    public function insert($UserName,$UserPassword)
    {
        $sql="insert into customers(Users,Password,role) values('$UserName','$UserPassword','user')";
         if($this->Connection()->query($sql))
         {
            return true;
         }
         return false;

    }
    public function checkuserlogin($userName,$password)
    {

       $sql=" select * from customers where Users='$userName' and Password='$password' ";

        $result = $this->Connection()->query($sql); 
        $id=null;
        $role=null;
         while($row = $result->fetch_assoc())
        {   
            
            $id=$row['CustomerId'];
            $role=$row['role'];

        }
        
        return array($id,$role);
    }
}
?>
