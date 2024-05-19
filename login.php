<?php
// Process form submission
$loginError = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $email = $_POST['email'];
    $password = $_POST['password'];
    include("db_connect.php");
    // Initialize variables
    $email = $password = $loginError = "";

    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form inputs
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        $sqllogin = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
        $stmt = $conn->prepare($sqllogin);
        $stmt->execute();
        $number_of_rows = $stmt->fetchColumn();
        if ($number_of_rows > 0) {
            session_start();
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $password;
            echo "<script>alert('Login Success')</script>";
            echo "<script>window.location.href = 'home.php'</script>";
        } else {
            echo "<script>alert('Login Failed')</script>";
            echo "<script>window.location.href = 'login.php'</script>";
        }
    }
    
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Makerspace Inventory System</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .login-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
        }

        .header,
        .footer {
            padding: 16px;
            background: #f1f1f1;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="w3-container w3-teal header">
        <h1>Makerspace Inventory System</h1>
    </div>

    <div class="w3-container login-container">
        <form class="w3-container w3-card-4 w3-light-grey" method="post" id="loginForm" onsubmit="return validateForm()">
            <h2>Login</h2>
            <?php if ($loginError) : ?>
                <div class="w3-panel w3-red">
                    <p><?php echo $loginError; ?></p>
                </div>
            <?php endif; ?>
            <p>
                <label for="email">Email</label>
                <input class="w3-input w3-border" type="email" id="email" name="email" required>
            </p>
            <p>
                <label for="password">Password</label>
                <input class="w3-input w3-border" type="password" id="password" name="password" required>
            </p>
            <p>
                <input class="w3-check" type="checkbox" id="rememberMe" name="rememberMe">
                <label for="rememberMe">Remember me</label>
            </p>
            <p>
                <button class="w3-button w3-teal" type="submit">Login</button>
            </p>
        </form>
    </div>

    <div class="w3-container w3-teal footer">
        <p>&copy; 2024 Makerspace Inventory System</p>
    </div>

    <script>
        // Load stored data on page load
        window.onload = function() {
            if (localStorage.getItem('rememberMe') === 'true') {
                document.getElementById('email').value = localStorage.getItem('email');
                document.getElementById('password').value = localStorage.getItem('password');
                document.getElementById('rememberMe').checked = true;
            }
        }

        // Save data to localStorage
        function validateForm() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var rememberMe = document.getElementById('rememberMe').checked;

            if (rememberMe) {
                localStorage.setItem('email', email);
                localStorage.setItem('password', password);
                localStorage.setItem('rememberMe', true);
            } else {
                localStorage.removeItem('email');
                localStorage.removeItem('password');
                localStorage.setItem('rememberMe', false);
            }

            // Here you can add further form validation if needed
            return true; // return false to prevent form submission if validation fails
        }
    </script>

</body>

</html>