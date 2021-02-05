<p align="center">
  <img src="img/querify.PNG" alt="QuerifyPHP">
</p>

### About QuerifyPHP
it's a framework that makes it easy to insert, select, delete and update record of a database in php

## Getting Started

```php

// Include the file in your project
include 'querify.php';

// Create an object
$querify = new Querify();

//connect to database
$querify->connect($servername,$username,$password,$database);


```

### Selecting Data
```php
$results = $querify->Select($tablename);

foreach($results as $results)
{
	echo $result['columnName'];

}
```

### Inserting Data
```php

// create an array with table column names as array keys and user inputs as array values

$data = array 
(
	'columnName' => 'data',
	'columnName' => 'data',
	'columnName' => 'data'

);

$querify->Insert($tablename,$data);

```

### Searching Data
```php

$results= $querify->Search($tablename,$column,$id);
foreach($results as $results)
{
	echo $result['columnName'];

}

```

### Deleting Data
```php
$querify->Delete($tablename,$id);
```
