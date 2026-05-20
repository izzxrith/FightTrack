<?php
include "db.php";
if(!isset($_SESSION['user_id'])) header("Location: login.php");

$user_id = $_SESSION['user_id'];

// Get Statistics
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM workouts WHERE user_id = :id");
$stmt->execute([':id' => $user_id]);
$total_workouts = $stmt->fetch()['total'];

$stmt = $conn->prepare("SELECT COUNT(*) as total FROM boxing_sessions WHERE user_id = :id");
$stmt->execute([':id'=>$user_id]);
$total_boxing = $stmt->fetch()['total'];

// Weekly workouts
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM workouts WHERE user_id = :id AND workout_date >= CURDATE() - INTERVAL 7 DAY");
$stmt->execute([':id'=>$user_id]);
$weekly_workouts = $stmt->fetch()['total'];

// Recent workouts
$stmt = $conn->prepare("SELECT * FROM workouts WHERE user_id = :id ORDER BY workout_date DESC LIMIT 5");
$stmt->execute([':id'=>$user_id]);
$recent_workouts = $stmt->fetchAll();

// Recent boxing
$stmt = $conn->prepare("SELECT * FROM boxing_sessions WHERE user_id = :id ORDER BY session_date DESC LIMIT 5");
$stmt->execute([':id'=>$user_id]);
$recent_boxing = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - FightTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php"><i class="fas fa-fist-raised"></i> FightTrack</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="workouts.php"><i class="fas fa-dumbbell"></i> Workouts</a>
            <a class="nav-link" href="boxing.php"><i class="fas fa-fist-raised"></i> Boxing</a>
            <a class="nav-link" href="profile.php"><i class="fas fa-user"></i> Profile</a>
            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
</nav>
    
<div class="container mt-4">
    <h1 class="mb-4">Welcome back, <?php echo $_SESSION['user_name']; ?>! 👊</h1>
    
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Workouts</h5>
                    <h2><?php echo $total_workouts; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Boxing Sessions</h5>
                    <h2><?php echo $total_boxing; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Weekly Workouts</h5>
                    <h2><?php echo $weekly_workouts; ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Recent Workouts</h5>
                </div>
                <div class="card-body">
                    <?php if(count($recent_workouts) > 0): ?>
                        <?php foreach($recent_workouts as $w): ?>
                            <div class="border-bottom pb-2 mb-2">
                                <strong><?php echo $w['exercise_name']; ?></strong>
                                <span class="float-end"><?php echo $w['workout_date']; ?></span>
                                <br><small><?php echo $w['sets']; ?> sets × <?php echo $w['reps']; ?> reps</small>
                                <?php if($w['weight']): ?> @ <?php echo $w['weight']; ?>kg<?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">No workouts yet. <a href="add_workout.php">Add your first workout!</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Recent Boxing Sessions</h5>
                </div>
                <div class="card-body">
                    <?php if(count($recent_boxing) > 0): ?>
                        <?php foreach($recent_boxing as $b): ?>
                            <div class="border-bottom pb-2 mb-2">
                                <strong><?php echo $b['session_date']; ?></strong>
                                <span class="float-end">
                                    Shadow: <?php echo $b['shadowboxing_rounds']; ?> | 
                                    Bag: <?php echo $b['bag_work_rounds']; ?>
                                </span>
                                <br><small>Cardio: <?php echo $b['cardio_minutes']; ?> min</small>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">No boxing sessions yet. <a href="add_boxing.php">Add your first session!</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>