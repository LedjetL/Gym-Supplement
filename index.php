<?php

$host = "localhost";
$user = "root"; 
$pass = "";     
$dbName = "pharmacy_konini";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Endpoint to get all products
function getAllProducts($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM products LIMIT 20");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$products = getAllProducts($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Products</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXw6D8t4o+/hjc6/5l3vzDw+Or/Cm8J1HZB6kAdI8Ci" crossorigin="anonymous">

</head>
<body>
    <nav>
        <div class="navbar">
            <div class="logo">
                <img src="https://tukuz.com/wp-content/uploads/2019/07/capsule-pharmacy-logo-vector.png" alt="Logo">
            </div>
            <ul class="menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">About</a></li>
            </ul>
            <div class="logo">
              <img src="https://img.freepik.com/premium-vector/quick-shopping-cart-icon_414847-513.jpg?w=2000" alt="">
            </div>
        </div>
    </nav>
    <h2 class="title">Pharmacy Products</h2>
    <div class="product-container">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <div class="product-tumb">
                    <img  src=<?php echo $product['image']; ?> alt="">
                </div>
                <div class="product-details">
                    <span class="product-catagory"><?php echo $product['category']; ?></span>
                    <h4><a href=""><?php echo $product['name']; ?></a></h4>
                    <p>Description: <?php echo $product['description']; ?></p>
                    <p>Manufacturer: <?php echo $product['manufacturer']; ?></p>
                    <div class="product-bottom-details">
                        <div class="product-price">$<?php echo $product['price']; ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
		
</body>
</html>