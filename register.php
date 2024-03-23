<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4">
            </div>
            <div class="col-4">
                <h1 class="text-center">Login</h1>
                <form action="register.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input required type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input required type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input required type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name:</label>
                        <input required type="text" class="form-control" id="fullname" name="fullname">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
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

if (isset($_POST['username']) && $_POST['username']) {
    $username = $_POST['username'];
    $sql = 'SELECT * FROM users WHERE username = :username AND password = :password';
    $statement = $db->prepare($sql);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo "<script>alert('Account $username has been already existed!!')</script>";
    }else{
        try {
            $password = $_POST['password'];
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $sql = 'INSERT INTO users (username, password, email, fullname) VALUES (:username, :password, :email, :fullname)';
            $statement = $db->prepare($sql);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->bindParam(':password', $password, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $statement->execute();
            $_SESSION["IS_LOGINED"] = true;
            $_SESSION[""] = "";
            $_SESSION["USERNAME"] = $username;
            $_SESSION["EMAIL"] = $email;
            $_SESSION["FULL_NAME"] = $fullname;
            echo "<script>alert('Register successfully!!')</script>";
            header("Location: index.php");
        } catch (Exception $th) {
            $err = $th->getMessage();
            echo "<script>alert('Register failed!! $err')</script>";
        }
        
    }

}
} catch (PDOException $e) {
    echo $e->getMessage();
}