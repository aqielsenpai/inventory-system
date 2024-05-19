<?php

include('db_connect.php');

if (isset($_GET['button'])) {
    $operation = $_GET['button'];
    if ($operation == 'search') {
        $search = $_GET['search'];
        $option = $_GET['option'];
        if ($option =='name'){
            $sqlload = "SELECT * FROM `inventory` WHERE `item_name` LIKE '%$search%'";
        }
        if ($option =='description'){
            $sqlload = "SELECT * FROM `inventory` WHERE `description` LIKE '%$search%'";
        }    
    }
}else{
    $sqlload = "SELECT * FROM `inventory`";
}
$results_per_page = 10;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
} else {
    $pageno = 1;
    $page_first_result = 0;
}


$stmt = $conn->prepare($sqlload);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);

$sqlload = $sqlload . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlload);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();


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

</head>

<body>
    <div class="w3-header w3-container w3-teal w3-padding-28 w3-center">
        <h1 style="font-size:calc(8px + 4vw);">My Inventory</h1>
        <p style="font-size:calc(8px + 1vw);;">We serve the people</p>
    </div>

    <div class="w3-bar w3-blue-gray">
        <a href="index.php" class="w3-bar-item w3-button w3-left">Home</a>
        <a href="" class="w3-bar-item w3-button w3-left" onclick="document.getElementById('id01').style.display='block';return false;">About</a>
    </div>

    <div style="min-height:100vh;overflow-y: auto;">
    <div class="w3-card w3-container w3-padding w3-margin w3-round">
                <h4>Item Search</h4>
                <form action="index.php">
                    <div class="w3-row">
                        <div class="w3-container w3-half">
                            <input class="w3-input w3-block w3-round w3-border" type="search" id="idsearch"
                                name="search" placeholder="Enter search term" />
                        </div>
                        <div class="w3-container w3-half">
                            <select class="w3-input w3-block w3-round w3-border" name="option" id="srcid">
                                <option value="name">By Name</option>
                                <option value="description">By Description</option>
                            </select>
                            <p>
                        </div>
                        <div class="w3-container">
                            <button class="w3-button w3-teal w3-round w3-right" type="submit" name="button"
                                value="search">search</button>
                        </div>
                    </div>
                </form>
            </div>
        <?php
        if ($number_of_result > 0) {
            echo " <table class='w3-table w3-striped'>
                    <tr>
                        <th>no.</th>
                        <th>id</th>
                        <th>image</th>
                        <th>item_name</th>
                        <th>quantity</th>
                        <th>description</th>
                        <th>category</th>
                        <th>condition</th>
                        <th>created_at</th>
                    </tr>";
            $i = 0;
            foreach ($rows as $items) {
                $i++;
                $id  = $items['id'];
                $item_name = $items['item_name'];
                $quantity = $items['quantity'];
                $description = $items['description'];
                $category = $items['category'];
                $condition = $items['condition'];
                $created_at = date_format(date_create($items['created_at']), "d/m/Y H:i a");
                echo "<tr>
                <td>$i</td>
                <td>$id</td>
                <td><img src='assets/$id.png' onerror=\"this.onerror=null;this.src='assets/noimage.png'\" style='max-width:50px'></td>
                <td>$item_name</td>
                <td>$quantity</td>
                <td>$description</td>
                <td>$category</td>
                <td>$condition</td>
                <td>$created_at</td>
                </tr>";
            }
            echo "</table>";
        }
        ?>

    </div>

    <div class="w3-container w3-row w3-center">
        <?php
            for ($page = 1; $page <= $number_of_page; $page++) {
                echo '<a href = "index.php?pageno=' . $page . '" style=
                "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
            }
            echo " ( " . $pageno . " )";
        ?>
    </div>

    <footer class="w3-footer w3-center w3-blue-grey">
        <p>Makerspace</p>
    </footer>

</body>

</html>