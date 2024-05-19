<?php
session_start();
if (!isset($_SESSION["email"])) {
    echo "<script>alert('Please Login')</script>";
    echo "<script>window.location.href = 'login.php'</script>";
}

$email = $_SESSION['email'];
if (isset($_POST["submit"])) {
    include('db_connect.php');
    $item_name = $_POST["item_name"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $condition = $_POST["condition"];
    $sqlinsert = "INSERT INTO `inventory`( `item_name`, `quantity`, `description`, `category`, `condition` ) 
    VALUES ('$item_name','$quantity ','$description','$category','$condition')";
    try {
        $conn->query($sqlinsert);
        $itemid = $conn->lastInsertId();
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) 
        {
            uploadImage($itemid);
        }
        echo "<script>alert('Success')</script>";
        echo "<script>window.location.href = 'home.php'</script>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}
function uploadImage($id)
{
    $target_dir = "assets/";
    $target_file = $target_dir . $id . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-  
     awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/mystyle.css">
    <title>Makerspace Inventory</title>

    <script>
        function previewFile() {
            const preview = document.querySelector('.w3-image');
            const file = document.querySelector('input[type=file]').files[0];
            const reader = new FileReader();
            reader.addEventListener("load", function() {
                // convert image file to base64 string
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
        function confirmDialog() {
        var r = confirm("Insert this item?");
        if (r == true) {
            return true;
        } else {
            return false;
        }
    }
    </script>
</head>

<body>
    <div class="w3-header w3-container w3-teal w3-padding-28 w3-center">
        <h1 style="font-size:calc(8px + 4vw);">My Inventory</h1>
        <p style="font-size:calc(8px + 1vw);;">We serve the people</p>
    </div>

    <div class="w3-bar w3-blue-gray">
        <a href="logout.php" class="w3-bar-item w3-button w3-right">Logout</a>
        <a href="home.php" class="w3-bar-item w3-button w3-left">Home</a>
        <a href="" class="w3-bar-item w3-button w3-left" onclick="document.getElementById('id01').style.display='block';return false;">About</a>
    </div>

    <div style="min-height:100vh;overflow-y: auto;">
        <div class="w3-container w3-padding" style="margin-top:50px; margin:auto; max-width:80%;">
            <form class="w3-container w3-card-4" style="padding:32px;" action="newinventory.php" method="post" enctype="multipart/form-data" onsubmit="return confirmDialog()">
                <h3>New Inventory</h3>
                <div class="w3-container w3-border w3-center w3-padding">
                    <img class="w3-image" src="assets/noimage.png" style="max-width:40%"><br>
                    <input type="file" name="fileToUpload" id="fileToUpload" onchange="previewFile()" accept="image/png" required><br>
                </div>
                <p>
                    <label for="item_name">Item Name</label>
                    <input class="w3-input" type="text" id="item_name" name="item_name" required>
                </p>
                <p>
                    <label for="quantity">Quantity</label>
                    <input class="w3-input" type="number" id="quantity" name="quantity" required>
                </p>
                <p>
                    <label for="description">Description</label>
                    <textarea class="w3-input" id="description" name="description" rows="4" required></textarea>
                </p>
                <p>
                    <label for="category">Category</label>
                    <select class="w3-select" id="category" name="category" required>
                        <option value="" disabled selected>Select a category</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Tools">Tools</option>
                        <option value="Materials">Materials</option>
                        <!-- Add more options as needed -->
                    </select>
                </p>
                <p>
                    <label for="condition">Condition</label>
                    <select class="w3-select" id="condition" name="condition" required>
                        <option value="" disabled selected>Select the condition</option>
                        <option value="New">New</option>
                        <option value="Used">Used</option>
                        <!-- Add more options as needed -->
                    </select>
                </p>
                <p>
                    <button class="w3-button w3-teal" type="submit" name="submit">Submit</button>
                </p>
            </form>
        </div>

    </div>

    <footer class="w3-footer w3-center w3-blue-grey">
        <p>Makerspace</p>
    </footer>

</body>

</html>