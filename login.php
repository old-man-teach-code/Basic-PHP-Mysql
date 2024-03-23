<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4">
            </div>
            <div class="col-4">
                <h1 class="text-center">Login</h1>
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input required type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input required type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
            <div class="col-4">
            </div>
        </div>
    </div>
</body>

</html>

<?php
// Kết nối với CSDL
try {
    session_start();
    $db = new PDO("mysql:host=localhost;dbname=user_management", "root");

if (isset($_POST['username']) && $_POST['username'] && $_POST['password']) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = 'SELECT * FROM users WHERE username = :username AND password = :password';
    $statement = $db->prepare($sql);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $email = $result['email'];
        $created_at = $result['created_at'];
        $username = $result['username'];
        $password = $result['password'];
        $user_id = $result['id'];
        $full_name = $result['fullname'];
        $_SESSION["IS_LOGINED"] = true;
        $_SESSION[""] = true;
        $_SESSION["USERNAME"] = $username;
        $_SESSION["FULL_NAME"] = $full_name;
        $_SESSION["EMAIL"] = $email;
        echo "<script>alert('Login successfully $full_name ')</script>";
        header("Location: index.php");
    } else {
        if(session_destroy()){
            echo "<script>alert('Login failed')</script>";
        } else {
            echo "<script>alert('Login failed (cant destroy session)')</script>";
        }
        
    }
}
} catch (\Throwable $th) {
    echo "Error: " . $th->getLine() . " " . $th->getMessage();
}

