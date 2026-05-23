<?php
include "db.php";
if(!isset($_SESSION['user_id'])) header("Location: login.php");

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM workouts WHERE id = :id AND user_id = :uid");
$stmt->execute([':id' => $id, ':uid' => $_SESSION['user_id']]);
$workout = $stmt->fetch();

if(!$workout){
    header("Location: workouts.php");
    exit();
}

if(isset($_POST['update'])){
    $exercise = $_POST['exercise'];
    $sets = $_POST['sets'];
    $reps = $_POST['reps'];
    $weight = $_POST['weight'] ?: null;
    $date = $_POST['date'];
    
    $sql = "UPDATE workouts SET exercise_name = :exercise, sets = :sets, reps = :reps, 
            weight = :weight, workout_date = :date WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':exercise' => $exercise,
        ':sets' => $sets,
        ':reps' => $reps,
        ':weight' => $weight,
        ':date' => $date,
        ':id' => $id
    ]);
    
    header("Location: workouts.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Workout - FightTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php"><i class="fas fa-fist-raised"></i> FightTrack</a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="workouts.php">Back to Workouts</a>
            <a class="nav-link" href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning">
                    <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Workout</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label>Exercise Name</label>
                            <input type="text" name="exercise" class="form-control" value="<?php echo $workout['exercise_name']; ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Sets</label>
                                <input type="number" name="sets" class="form-control" value="<?php echo $workout['sets']; ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Reps</label>
                                <input type="number" name="reps" class="form-control" value="<?php echo $workout['reps']; ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Weight (kg)</label>
                                <input type="number" name="weight" class="form-control" step="0.5" value="<?php echo $workout['weight']; ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" value="<?php echo $workout['workout_date']; ?>" required>
                        </div>
                        <button type="submit" name="update" class="btn btn-warning w-100">Update Workout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>