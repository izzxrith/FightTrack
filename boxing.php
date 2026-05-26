<?php
include "db.php";
if(!isset($_SESSION['user_id'])) header("Location: login.php");

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM boxing_sessions WHERE user_id = :id ORDER BY session_date DESC");
$stmt->execute([':id' => $user_id]);
$sessions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Boxing Sessions - FightTrack</title>
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
        <h1><i class="fas fa-boxing-glove"></i> Boxing Sessions</h1>
        <a href="add_boxing.php" class="btn btn-primary">+ Add Session</a>
</div>

<?php if(count($sessions) > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Date</th>
                        <th>Shadowboxing</th>
                        <th>Bag Work</th>
                        <th>Sparring</th>
                        <th>Cardio (min)</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($sessions as $s): ?>
                    <tr>
                        <td><?php echo $s['session_date']; ?></td>
                        <td><?php echo $s['shadowboxing_rounds']; ?></td>
                        <td><?php echo $s['bag_work_rounds']; ?></td>
                        <td><?php echo $s['sparring_rounds']; ?></td>
                        <td><?php echo $s['cardio_minutes']; ?></td>
                        <td><?php echo substr($s['notes'], 0, 30); ?></td>
                        <td>
                            <a href="edit_boxing.php?id=<?php echo $s['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_boxing.php?id=<?php echo $s['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this session?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No boxing sessions yet. <a href="add_boxing.php">Add your first session!</a></div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>