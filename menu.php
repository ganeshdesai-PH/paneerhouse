<?php
// Database connection
include('/home/delitmhw/paneerhouse.com/config.php');

// Detect current day (like 'Monday', 'Tuesday', etc.)
$current_day = date('l');

// Fetch signature dishes (day = Everyday)
$signature_sql = "SELECT item_name, ingredients, price 
                  FROM menu_items 
                  WHERE day='Everyday'";
$signature_result = $conn->query($signature_sql);

// Fetch today’s specials only
$daily_sql = "SELECT item_name, ingredients, price 
              FROM menu_items 
              WHERE day = '$current_day'";
$daily_result = $conn->query($daily_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PaneerHouse Menu</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #fafafa;
      margin: 0;
      padding: 0;
    }
    header {
      background: #fff3e0;
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-bottom: 3px solid #ff9800;
    }
    header img {
      height: 60px;
      margin-right: 15px;
    }
    header h1 {
      font-family: Arial, sans-serif;
      font-size: 42px;
      color: #e65100;
      margin: 0;
    }
    .container {
      width: 80%;
      margin: 20px auto;
    }
    h2 {
      border-bottom: 2px solid #ff9800;
      padding-bottom: 5px;
      color: #e65100;
    }
    .dish {
      background: #fff;
      margin: 10px 0;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .dish h3 {
      margin: 0;
      color: #333;
    }
    .dish p {
      margin: 5px 0;
      color: #555;
    }
    .price {
      font-weight: bold;
      color: #2e7d32;
    }
  </style>
</head>
<body>

<header>
  <img src="logo.png" alt="PaneerHouse Logo">
  <h1>PaneerHouse</h1>
</header>

<div class="container">

  <!-- Signature Dishes Section -->
  <h2>Signature Dishes (Available Everyday)</h2>
  <?php
  if ($signature_result->num_rows > 0) {
      while($row = $signature_result->fetch_assoc()) {
          echo "<div class='dish'>";
          echo "<h3>" . htmlspecialchars($row["item_name"]) . "</h3>";
          echo "<p>" . htmlspecialchars($row["ingredients"]) . "</p>";
          echo "<p class='price'>Price: $" . htmlspecialchars($row["price"]) . "</p>";
          echo "</div>";
      }
  } else {
      echo "<p>No signature dishes found.</p>";
  }
  ?>

  <!-- Today’s Specials Section -->
  <h2>Today's Specials (<?php echo $current_day; ?>)</h2>
  <?php
  if ($daily_result->num_rows > 0) {
      while($row = $daily_result->fetch_assoc()) {
          echo "<div class='dish'>";
          echo "<h3>" . htmlspecialchars($row["item_name"]) . "</h3>";
          echo "<p>" . htmlspecialchars($row["ingredients"]) . "</p>";
          echo "<p class='price'>Price: $" . htmlspecialchars($row["price"]) . "</p>";
          echo "</div>";
      }
  } else {
      echo "<p>No specials for today.</p>";
  }
  ?>

</div>

</body>
</html>
