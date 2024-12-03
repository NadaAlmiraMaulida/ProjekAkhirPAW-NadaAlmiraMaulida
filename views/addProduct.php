
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
      
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f5f5f7;
            margin: 0;
            padding: 20px;
        }

        
        fieldset {
            background-color: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
        }

        
        legend {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        
        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"],
        select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #d1d1d6;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        
        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border-color: #0071e3;
            outline: none;
        }

        
        button {
            width: 100%;
            padding: 12px;
            background-color: #0071e3;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        
        button:hover {
            background-color: #005bb5;
        }

        
        table {
            width: 100%;
            margin: 10px 0;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        
        .back-home {
            background-color: #6c757d;
        }

        .back-home:hover {
            background-color: #5a6268;
        }

        
        @media (max-width: 600px) {
            fieldset {
                padding: 20px;
            }

            input[type="text"],
            input[type="number"],
            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<fieldset>
    <legend>Add Product</legend>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required size="40"><br>
        <input type="number" step="0.01" name="price" placeholder="Price" required size="20"><br>

        <!-- Specifications Table -->
        <table>
            <tr>
                <td>RAM:</td>
                <td>
                    <input type="number" name="ram_value" placeholder="RAM" required>
                    <select name="ram_unit">
                        <option value="GB">GB</option>
                        <option value="MB">MB</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Storage:</td>
                <td>
                    <input type="number" name="storage_value" placeholder="Storage" required>
                    <select name="storage_unit">
                        <option value="GB">GB</option>
                        <option value="TB">TB</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Condition:</td>
                <td>
                    <select name="condition">
                        <option value="new">New</option>
                        <option value="used">Used</option> 
                    </select>
                </td>
            </tr>
        </table>

        <input type="file" name="image" required><br>
        <button type="submit" name="add_product">Add Product</button>
    </form>

  
    <form action="index.php?action=home" method="get">
        <button type="submit" class="back-home">Back to Home</button>
    </form>
</fieldset>

</body>
</html>
