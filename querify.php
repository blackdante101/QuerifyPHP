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

		//loops each array value(input values) into string variable with apostrophe and commas
		foreach ($array as $arr) {
			$string .="'".$arr."',";
		}

		// removes last comma at the end of string
		$trimstring= substr($string,0,-1);

		//stores array keys(column names) into columns variable with commas
		$columns = implode(",",array_keys($array));

		//concatenating variables into query string
		$query = "INSERT INTO $tblname($columns) VALUES ($trimstring)";

		//returns true if query runs
		if($this->db->query($query))
		{
			return true;
		}

	}
	public function Update($table_name, $fields, $where_condition)  
      {  
           $query = '';  
           $condition = '';  
           
           //loops array keys and values of fields array into query variable
           foreach($fields as $key => $value)  
           {  
                $query .= $key . "='".$value."', ";  
           } 

           //removes last comma at the end of query string 
           $query = substr($query, 0, -2); 

           //loops array keys and values of where condition array into condition variable
           foreach($where_condition as $key => $value)  
           {  
                $condition .= $key . "='".$value."' AND ";  
           }

           $condition = substr($condition, 0, -5);  

           //concatenating variables into query string
           $query = "UPDATE ".$table_name." SET ".$query." WHERE ".$condition.""; 

           //returns true if query runs successfully 
           if(mysqli_query($this->db, $query))  
           {  
                return true;  
           }  
      } 


}

?>