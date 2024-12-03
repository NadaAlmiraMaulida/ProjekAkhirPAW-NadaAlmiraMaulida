
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTech Mart - Product List</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f5f5f7;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .product-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: translateY(-5px); 
        }
        .product-card img {
            width: 100%;
            height: fit;
            object-fit: cover;
        }
        .product-info {
            padding: 12px;
        }
        .product-info h2 {
            font-size: 18px;
            margin: 0;
            color: #333;
        }
        .product-info .price {
            font-size: 16px;
            font-weight: bold;
            color: #e67e22;
        }
        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
        .actions a {
            padding: 6px 12px;
            background-color: #eaeaea;
            border-radius: 4px;
            transition: background-color 0.3s;
            color: #0071e3;
            text-decoration: none;
            font-weight: 500;
        }
        .actions a:hover {
            background-color: #d1d1d6;
        }

        /* Menambahkan styling untuk tombol Delete */
form button {
    padding: 10px 16px;
    background-color: #eaeaea;
    border-radius: 4px;
    transition: background-color 0.3s;
    color: #0071e3;
    font-weight: bold;
    border: none;
    cursor: pointer;
    font-size: 14px; 
}

form button:hover {
    background-color: #d1d1d6;
}

        .nav {
            text-align: center;
            margin-top: 20px;
        }
        .nav a {
            margin: 0 10px;
        }
    </style>
</head>
<body>

<h1>Welcome to iTech Mart, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

<div class="product-container">
    <?php 
    // Mengecek apakah ada produk dalam database
    if ($products->num_rows > 0) {
        while ($row = $products->fetch_assoc()) { ?>
            <div class="product-card">
                <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                <div class="product-info">
                    <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                    <p class="price">Rp<?php echo number_format($row['price'], 0, ',', '.'); ?>.</p>
                    <div class="actions">
                        <a href="index.php?action=detail&id=<?php echo $row['id']; ?>">Detail</a>
                        <a href="index.php?action=editProduct&id=<?php echo $row['id']; ?>">Edit</a>
                        <form action="index.php?action=deleteProduct&id=<?php echo $row['id']; ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } 
    } else {
        echo "<p>No products found.</p>";
    }
    ?>
</div>

<div class="nav">
    <a href="index.php?action=addProduct">Add Product</a> | 
    <a href="index.php?action=logout">Logout</a>
</div>

</body>
</html>
