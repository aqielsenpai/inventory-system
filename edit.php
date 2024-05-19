<?php
session_start();
if (!isset($_SESSION["email"])) {
    echo "<script>alert('Please Login')</script>";
    echo "<script>window.location.href = 'login.php'</script>";
}
include('db_connect.php');
$email = $_SESSION['email'];

if (isset($_POST["submit"])) {
    include('db_connect.php');
    $id = $_POST["id"];
    $item_name = $_POST["item_name"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    $category = $_POST["category"];
    $condition = $_POST["condition"];
    $sqlupdate = "UPDATE `inventory` SET `item_name`='$item_name',`quantity`='$quantity',`description`='$description',`category`='$category',`condition`='$condition' WHERE `id` = '$id'";
    try {
        $conn->query($sqlupdate);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            uploadImage($id);
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
$id = $_GET["id"];
$sqlitem = "SELECT * FROM `inventory` WHERE `id`= '$id'";
$stmt = $conn->prepare($sqlitem);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
$number_of_result = $stmt->rowCount();

if ($number_of_result > 0) {
    foreach ($rows as $items) {
        $id  = $items['id'];
        $item_name = $items['item_name'];
        $quantity = $items['quantity'];
        $description = $items['description'];
        $category = $items['category'];
        $condition = $items['condition'];
        $created_at = date_format(date_create($items['created_at']), "d/m/Y H:i a");
    }
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
            var r = confirm("Update this item?");
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
            <form class="w3-container w3-card-4" style="padding:32px;" action="edit.php" method="post" enctype="multipart/form-data" onsubmit="return confirmDialog()">
                <h3> Edit Inventory</h3>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="w3-container w3-border w3-center w3-padding">
                    <img class="w3-image" src="<?php echo "assets/$id.png"; ?>" onerror="this.onerror=null;this.src='assets/noimage.png';" style="max-width:40%"><br>
                    <input type="file" name="fileToUpload" id="fileToUpload" onchange="previewFile()" accept="image/png"><br>
                </div>
                <p>
                    <label for="item_name">Item Name</label>
                    <input class="w3-input" type="text" id="item_name" name="item_name" value="<?php echo $item_name ?>" required>
                </p>
                <p>
                    <label for="quantity">Quantity</label>
                    <input class="w3-input" type="number" id="quantity" name="quantity" value="<?php echo $quantity ?>" required>
                </p>
                <p>
                    <label for="description">Description</label>
                    <textarea class="w3-input" id="description" name="description" rows="4" required><?php echo $description ?></textarea>
                </p>
                <p>
                    <label for="category">Category</label>
                    <select class="w3-select" id="category" name="category" required>
                        <option value="Electronics" <?php echo $category == 'Electronics' ? 'selected' : ''; ?>>Electronics</option>
                        <option value="Tools" <?php echo $category == 'Tools' ? 'selected' : ''; ?>>Tools</option>
                        <option value="Materials" <?php echo $category == 'Materials' ? 'selected' : ''; ?>>Materials</option>
                        <!-- Add more options as needed -->
                    </select>

                </p>
                <p>
                    <label for="condition">Condition</label>
                    <select class="w3-select" id="condition" name="condition" required>
                        <option value="New" <?php echo $condition == 'New' ? 'selected' : ''; ?>>New</option>
                        <option value="Used" <?php echo $condition == 'Used' ? 'selected' : ''; ?>>Used</option>
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