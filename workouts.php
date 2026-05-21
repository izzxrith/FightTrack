<?php
include "db.php";
if(!isset($_SESSION['user_id'])) header("Location: login.php");

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM workouts WHERE user_id = :id ORDER BY workout_date DESC");
$stmt->execute([':id' => $user_id]);
$workouts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Workouts - FightTrack</title>
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fas fa-dumbbell"></i> My Workouts</h1>
        <a href="add_workout.php" class="btn btn-primary">+ Add Workout</a>
    </div>
    
    <?php if(count($workouts) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Date</th>
                        <th>Exercise</th>
                        <th>Sets</th>
                        <th>Reps</th>
                        <th>Weight (kg)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($workouts as $w): ?>
                    <tr>
                        <td><?php echo $w['workout_date']; ?></td>
                        <td><?php echo $w['exercise_name']; ?></td>
                        <td><?php echo $w['sets']; ?></td>
                        <td><?php echo $w['reps']; ?></td>
                        <td><?php echo $w['weight'] ?: '-'; ?></td>
                        <td>
                            <a href="edit_workout.php?id=<?php echo $w['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_workout.php?id=<?php echo $w['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this workout?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No workouts yet. <a href="add_workout.php">Add your first workout!</a></div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>