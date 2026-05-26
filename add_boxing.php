<?php
include "db.php";
if(!isset($_SESSION['user_id'])) header("Location: login.php");

if(isset($_POST['add'])){
    $shadow = $_POST['shadow'] ?? 0;
    $bag = $_POST['bag'] ?? 0;
    $sparring = $_POST['sparring'] ?? 0;
    $cardio = $_POST['cardio'] ?? 0;
    $notes = $_POST['notes'];
    $date = $_POST['date'];
    $user_id = $_SESSION['user_id'];
    
    $sql = "INSERT INTO boxing_sessions (user_id, shadowboxing_rounds, bag_work_rounds, sparring_rounds, cardio_minutes, notes, session_date) 
            VALUES (:uid, :shadow, :bag, :sparring, :cardio, :notes, :date)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':uid' => $user_id,
        ':shadow' => $shadow,
        ':bag' => $bag,
        ':sparring' => $sparring,
        ':cardio' => $cardio,
        ':notes' => $notes,
        ':date' => $date
    ]);
    
    header("Location: boxing.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Boxing Session - FightTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php"><i class="fas fa-fist-raised"></i> FightTrack</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="boxing.php">Back to Boxing</a>
            <a class="nav-link" href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0"><i class="fas fa-plus"></i> Add Boxing Session</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Shadowboxing (rounds)</label>
                                <input type="number" name="shadow" class="form-control" value="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Bag Work (rounds)</label>
                                <input type="number" name="bag" class="form-control" value="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Sparring (rounds)</label>
                                <input type="number" name="sparring" class="form-control" value="0">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Cardio (minutes)</label>
                                <input type="number" name="cardio" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <button type="submit" name="add" class="btn btn-primary w-100">Add Session</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>