<?php
include "db.php";
if(!isset($_SESSION['user_id'])) header("Location: login.php");

$user_id = $_SESSION['user_id'];

// Get user data first bruv
$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute([':id' => $user_id]);
$user = $stmt->fetch();

// Update profile
if(isset($_POST['update_profile'])){
    $full_name = $_POST['full_name'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $goals = $_POST['goals'];
    $boxing_experience = $_POST['boxing_experience'];
    
    $sql = "UPDATE users SET full_name = :full_name, height = :height, weight = :weight, 
            goals = :goals, boxing_experience = :boxing_experience WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':full_name' => $full_name,
        ':height' => $height,
        ':weight' => $weight,
        ':goals' => $goals,
        ':boxing_experience' => $boxing_experience,
        ':id' => $user_id
    ]);
    
    echo "<script>alert('Profile updated successfully!'); window.location.href='profile.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile - FightTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php"><i class="fas fa-fist-raised"></i> FightTrack</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="dashboard.php">Dashboard</a>
            <a class="nav-link" href="workouts.php">Workouts</a>
            <a class="nav-link" href="boxing.php">Boxing</a>
            <a class="nav-link" href="profile.php">Profile</a>
            <a class="nav-link" href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><i class="fas fa-user"></i> My Profile</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Username</label>
                                <input type="text" class="form-control" value="<?php echo $user['username']; ?>" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" value="<?php echo $user['email']; ?>" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Full Name</label>
                                <input type="text" name="full_name" class="form-control" value="<?php echo $user['full_name']; ?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Height (cm)</label>
                                <input type="number" name="height" class="form-control" step="0.01" value="<?php echo $user['height']; ?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Weight (kg)</label>
                                <input type="number" name="weight" class="form-control" step="0.01" value="<?php echo $user['weight']; ?>">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Boxing Experience</label>
                                <select name="boxing_experience" class="form-control">
                                    <option value="Beginner" <?php if($user['boxing_experience'] == 'Beginner') echo 'selected'; ?>>Beginner</option>
                                    <option value="Intermediate" <?php if($user['boxing_experience'] == 'Intermediate') echo 'selected'; ?>>Intermediate</option>
                                    <option value="Advanced" <?php if($user['boxing_experience'] == 'Advanced') echo 'selected'; ?>>Advanced</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Fitness Goals</label>
                                <textarea name="goals" class="form-control" rows="3"><?php echo $user['goals']; ?></textarea>
                            </div>
                        </div>
                        <button type="submit" name="update_profile" class="btn btn-dark w-100">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>