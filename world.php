<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

error_reporting (E_ALL ^ E_NOTICE); 

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if($_SERVER['REQUEST_METHOD'] === 'GET' ){

  $country = filter_var($_GET['country'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if((isset($country) or !empty($country)) and (!isset($_GET['context']) or empty($_GET['context']))){
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>", "<tr>", "<th>Country Name</th>", "<th>Continent</th>", "<th>Independence Year</th>", "<th>Head of State</th>", "</tr>";
    foreach($results as $row) {
      $name = $row['name'];
      $continent = $row['continent'];
      $independence_year = $row['independence_year'];
      $head_of_state = $row['head_of_state'];
      echo "<tr>", "<td>$name</td>", "<td>$continent</td>", "<td>$independence_year</td>","<td>$head_of_state</td>", "</tr>";
    }
    echo "</table>";

  } else {
    $countries = filter_var($_GET['country'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population, FROM country join cities on cities.country_code = countries.code WHERE countries.name LIKE '%$country%';");

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table>","<tr>","<th>Name</th>","<th>District</th>","<th>Population</th>","</tr>";
    foreach($results as $row) {
      $name = $row['city'];
      $dist = $row['district'];
      $pnum = $row['population'];
      echo "<tr>", "<td>$name</td>", "<td>$dist</td>", "<td>$pnum</td>", "</tr>";
    }
    echo "</table>";
  }
}
?>