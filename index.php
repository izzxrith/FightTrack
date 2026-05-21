<!DOCTYPE html>
<html lang="en">
<head>
    <title>FightTrack - Gym And Boxing Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero { 
            background: linear-gradient(135deg, #1a1a1a 0%, #d32f2f 100%); 
            color: white; 
            padding: 80px 0; }
        .feature-card { 
            transition: transform 0.3s; 
            border: none; 
            box-shadow: 0 5px 15px rgba(0,0,0,0.3); 
            background: #2c2c2c; 
            color: white;}
        .feature-card:hover { 
            transform: translateY(-5px); 
            background: #d32f2f; 
            color: white; }
    </style>
</head>
<body>
    <!-- open header bruv -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-fist-raised"></i> FightTrack
            </a>
            <div class="navbar-nav ms-auto">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                    <a class="nav-link" href="logout.php">Logout</a>
                <?php else: ?>
                    <a class="nav-link" href="login.php">Login</a>
                    <a class="nav-link" href="register.php">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <!-- close header bruv -->

<!-- bussin hero thangy -->
<div class="hero">
    <div class="container text-center">
        <h1 class="display-4"><i class="fas fa-fist-raised"></i> Welcome to FightTrack</h1>
        <p class="lead">Track Your Own Gym Workouts and Boxing Training in One Place</p>
        <hr>
        <?php if(!isset($_SESSION['user_id'])): ?>
            <a href="register.php" class="btn btn-light btn-lg">Get Started</a>
            <a href="login.php" class="btn btn-light btn-lg">Login</a>
        <?php else: ?>
            <a href="dashboard.php" class="btn btn-light btn-lg">Go to Dashboard</a>
        <?php endif; ?>
    </div>
</div>

<!-- One of those classes just using card - there are 3, i guess -->
<div class="container py-5">
    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card feature-card h-100">
                <div class="card-body">
                    <i class="fas fa-dumbbell fa-3x text-primary mb-3"></i>
                    <h3>Track Workouts</h3>
                    <p>Log exercises, Sets, Reps and Weights. Monitor Strength Progress.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card feature-card h-100">
                <div class="card-body">
                    <i class="fas fa-fist-raised fa-3x text-primary mb-3"></i>
                    <h3>Boxing Training</h3>
                    <p>Track Rounds: Shadowboxing, Bag Work, Sparring and Cardio.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card feature-card h-100">
                <div class="card-body">
                    <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                    <h3>Progress Dashboard</h3>
                    <p>Visualize Training Consistency and Improvement Over Time.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>