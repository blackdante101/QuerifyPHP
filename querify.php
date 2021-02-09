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
		$stmt->execute();
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
		$stmt->execute();
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
		$values = implode(',',array_values($array));
		$columns = implode(',',array_keys($array));
		$stmt=$this->db->prepare("INSERT INTO $tblname($columns) VALUES (?)");
		$stmt->bind_param('s',$values);
		$stmt->execute();
		$stmt->close();

	}


}

?>