<p align="center">
  <img src="img/querify.PNG" alt="QuerifyPHP">
</p>

### About QuerifyPHP
it's a library that makes it easy to insert, select, delete and update record of a database in php

# Getting Started

```php

// Include the file in your project
include 'querify.php';

// Create an object
$querify = new Querify();

// Create a database
$database = $querify->CreateDB("databaseName");

//Connect to database
$querify->connect($servername,$username,$password,$database);


```

# Selecting Data
```php
//assign a variable to store the array returned 
$results = $querify->Select($tablename);

//loop and display the data from the array
foreach($results as $results)
{
	echo $result['columnName'];

}
```

# Inserting Data
```php

// create an array with table column names as array keys and user inputs as array values

$data = array 
(
	'columnName' => 'data',
	'columnName' => 'data',
	'columnName' => 'data'

);
// pass the values of the tablename and array in the parameter
$querify->Insert($tablename,$data);

```

# Searching Data
```php

//assign a variable to store the array returned 
$results= $querify->Search($tablename,$column,$id);

//loop and display the data from the array
foreach($results as $results)
{
	echo $result['columnName'];

}

```

# Deleting Data
```php

//pass the values of the tablename and row id in the parameter
$querify->Delete($tablename,$id);

```
