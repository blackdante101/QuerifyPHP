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
	public function CreateDb($server_name,$username,$password,$databaseName)
	{
		$con = new mysqli($server_name,$username,$password);
		if($con === false)
		{
			die("ERROR: Could not connect ".mysqli_connect_error());
		}
		$sql = "CREATE DATABASE $databaseName";
		if($con->query($sql))
		{
			return true;
		}
		$con->close();
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
            $tblname = $this-quoteIdentifier($tblname);

            $columns = '';
            foreach ($array as $key => $value) {

                $key = $this->quoteIdentifier($key);
                // whether to add a comma or not
                if ($columns) {
                    $columns .= ',';
                }
                $columns .= $key;
            }

            // a string like ?,?,?...
            $placeholders = str_repeat('?,', count($array) - 1) . '?';

            $query = "INSERT INTO $tblname ($columns) VALUES ($placeholders)";
            $stmt = $this->db->prepare($query);
            // it's OK to use s for all variables
            $types = str_repeat("s", count($array));
            $stmt->bind_param($types, ...array_values($array));
            $stmt->execute();
        }

	public function Update($table_name, $fields, $where_condition)
      {
           $query = '';
           $condition = '';

           //loops array keys and values of fields array into query variable
           foreach($fields as $key => $value)
           {
                $query .= $this->quoteIdentifier($key) . "=?, ";
           }

           //removes last comma at the end of query string
           $query = substr($query, 0, -2);

           //loops array keys and values of where condition array into condition variable
           foreach($where_condition as $key => $value)
           {
                $condition .= $this->quoteIdentifier($key) . "=? AND ";
           }

           $condition = substr($condition, 0, -5);

           // prepare and execute statement with parameters
           $query = "UPDATE $table_name SET $query WHERE $condition";
					 $stmt = $this->db->prepare($query);
					 $types = str_repeat("s", count($fields) + count($where_condition));
					 $stmt->bind_param($types, ...array_merge(array_values($fields), array_values($where_condition)));
					 return $stmt->execute();
      }
         public function Import($server_name,$username,$password,$database_name,$sql_file)
    {
    	$sql = file_get_contents($sql_file);
    	$connection = new mysqli($server_name,$username,$password,$database_name);
    	$imported = $connection->multi_query($sql);
    	if($imported)
    	{
    		return true;
    	}

    }

		protected function quoteIdentifier(string $name) : string
		{
			// at least this protection but a whitelist should be really used
			if (preg_match('![^A-Za-z0-9_]!', $name)) {
					throw new InvalidArgumentException("Invalid column name: $name");
			}

			// quote as table/column identifier (backticks)
			return "`$name`";
		}

}

?>
