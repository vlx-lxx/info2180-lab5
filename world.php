<!-- PHP - Javon Laing -->

<?php
header('Access-Control-Allow-Origin: *');
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Check if 'context' is set in the $_GET array, otherwise set a default value
$context = isset($_GET['lookup']) ? $_GET['lookup'] : 'countries';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_GET['country'])) {
  $country = htmlspecialchars($_GET['country']);
  $country = '%' . $country . '%';

  if ($context === 'cities') {
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM countries JOIN cities ON countries.code = cities.country_code WHERE countries.name LIKE '%$country%'");
  } else {
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '$country'");
  }

  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<table>
  <thead>
    <tr>
      <?php if ($context === 'cities'): ?>
        <th>City Name</th>
        <th>District</th>
        <th>Population</th>
      <?php else: ?>
        <th>Country Name</th>
        <th>Continent</th>
        <th>Independence Year</th>
        <th>Head of State</th>
      <?php endif; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($results as $row): ?>
      <tr>
        <?php if ($context === 'cities'): ?>
          <td>
            <?= $row['name']; ?>
          </td>
          <td>
            <?= $row['district']; ?>
          </td>
          <td>
            <?= $row['population']; ?>
          </td>
        <?php else: ?>
          <td>
            <?= $row['name']; ?>
          </td>
          <td>
            <?= $row['continent']; ?>
          </td>
          <td>
            <?= $row['independence_year']; ?>
          </td>
          <td>
            <?= $row['head_of_state']; ?>
          </td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>