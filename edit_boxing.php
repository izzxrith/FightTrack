<?php
include "db.php";
if(!isset($_SESSION['user_id'])) header("Location: login.php");

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM boxing_sessions WHERE id = :id AND user_id = :uid");
$stmt->execute([':id' => $id, ':uid' => $_SESSION['user_id']]);
$session = $stmt->fetch();

if(!$session){
    header("Location: boxing.php");
    exit();
}

if(isset($_POST['update'])){
    $shadow = $_POST['shadow'];
    $bag = $_POST['bag'];
    $sparring = $_POST['sparring'];
    $cardio = $_POST['cardio'];
    $notes = $_POST['notes'];
    $date = $_POST['date'];
    
    $sql = "UPDATE boxing_sessions SET shadowboxing_rounds = :shadow, bag_work_rounds = :bag, 
            sparring_rounds = :sparring, cardio_minutes = :cardio, notes = :notes, session_date = :date WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':shadow' => $shadow,
        ':bag' => $bag,
        ':sparring' => $sparring,
        ':cardio' => $cardio,
        ':notes' => $notes,
        ':date' => $date,
        ':id' => $id
    ]);
    
    header("Location: boxing.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Boxing Session - FightTrack</title>
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
                <div class="card-header bg-warning">
                    <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Boxing Session</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Shadowboxing (rounds)</label>
                                <input type="number" name="shadow" class="form-control" value="<?php echo $session['shadowboxing_rounds']; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Bag Work (rounds)</label>
                                <input type="number" name="bag" class="form-control" value="<?php echo $session['bag_work_rounds']; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Sparring (rounds)</label>
                                <input type="number" name="sparring" class="form-control" value="<?php echo $session['sparring_rounds']; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Cardio (minutes)</label>
                                <input type="number" name="cardio" class="form-control" value="<?php echo $session['cardio_minutes']; ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control" rows="3"><?php echo $session['notes']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" value="<?php echo $session['session_date']; ?>" required>
                        </div>
                        <button type="submit" name="update" class="btn btn-warning w-100">Update Session</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>