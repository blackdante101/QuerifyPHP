<?php 
 class Querify 
{
	public $db;
	public function connect($servername,$username,$password,$databasename)
	{
		$this->db = new mysqli($servername,$username,$password,$databasename);
		if($this->db->connect_error)
		{
			echo "connection error".$this->db->connect_error;
		}
	}
	public function CreateDb($databaseName)
	{
		$stmt=$this->db->prepare("CREATE DATABASE $databaseName");
		if($stmt->execute())
		{
			return true;
		}
		$stmt->close();
	}
	public function SelectAll($tblname)
	{
		$stmt=$this->db->prepare("SELECT * FROM $tblname");
		$stmt->execute();
		return $stmt->get_result();
		$stmt->close();
	}
	public function Delete($tblname,$id)
	{
		$stmt=$this->db->prepare("DELETE FROM $tblname WHERE id=?");
		$stmt->bind_param('i',$id);
		if($stmt->execute())
		{
			return true;
		}
		$stmt->close();
	}
	public function Search($tblname,$column,$data)
	{
		$stmt=$this->db->prepare("SELECT * FROM $tblname WHERE $column LIKE ? ");
		$query="%".$data."%";
		$stmt->bind_param('s',$query);
		$stmt->execute();
		return $stmt->get_result();
		$stmt->close();
	}
	public function Insert($tblname,$array)
	{
		$string ='';
		foreach ($array as $arr) {
			$string .="'".$arr."',";
		}
		$trimstring= substr($string,0,-1);
		$columns = implode(",",array_keys($array));
		$query = "INSERT INTO $tblname($columns) VALUES ($trimstring)";
		if($this->db->query($query))
		{
			return true;
		}

	}
	public function Update($table_name, $fields, $where_condition)  
      {  
           $query = '';  
           $condition = '';  
           foreach($fields as $key => $value)  
           {  
                $query .= $key . "='".$value."', ";  
           }  
           $query = substr($query, 0, -2);  
           foreach($where_condition as $key => $value)  
           {  
                $condition .= $key . "='".$value."' AND ";  
           }  
           $condition = substr($condition, 0, -5);  
           $query = "UPDATE ".$table_name." SET ".$query." WHERE ".$condition."";  
           if(mysqli_query($this->db, $query))  
           {  
                return true;  
           }  
      } 


}

?>