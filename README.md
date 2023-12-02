<p align="center">
  <img src="img/querify.PNG" alt="QuerifyPHP">
</p>

[![Open Source Helpers](https://www.codetriage.com/blackdante101/querifyphp/badges/users.svg)](https://www.codetriage.com/blackdante101/querifyphp)

### About QuerifyPHP
a php library that makes querying faster & easier.

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
# Importing Data 

```php
$querify->Import($servername,$username,$password,$database,$sqlfile);
```


# Selecting Data
```php
//assign a variable to store the array returned 
$results = $querify->SelectAll($tablename);

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
	'columnName' => $_POST['data'],
	'columnName' => $_POST['data'],
	'columnName' => $_POST['data']

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

# Updating Data 
```php 

// create an array with table column names as array keys and user inputs as array values
$fields = array
(
	'columnName' => $_POST['data'],
	'columnName' => $_POST['data'],
)
// create an array with table column names as array keys and condition value as array values

$condition = array 
(
	'columnName' => $_POST['data'];

)

//pass the variables into the update method
$querify->Update($tablename,$fields,$condition);



```


# Deleting Data
```php

//pass the values of the tablename and row id in the parameter
$querify->Delete($tablename,$id);

```
