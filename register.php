<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - FightTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-shadow">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><i class="fas fa-user-plus"></i> Create Account</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Register</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="login.php">Already have an account? Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    
    if($password != $confirm){
        echo "<script>alert('Passwords do not match!')</script>";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':username'=>$username, ':email'=>$email, ':password'=>$hashed]);
        
        echo "<script>alert('Registration successful! Please login.'); window.location.href='login.php';</script>";
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>