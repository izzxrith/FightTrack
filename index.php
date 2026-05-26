<?php include "db.php"; ?>
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
            padding: 100px 0; 
        }
        .feature-card { 
            transition: transform 0.3s; 
            border: none; 
            box-shadow: 0 5px 15px rgba(0,0,0,0.3); 
            background: #2c2c2c; 
            color: white;
        }
        .feature-card:hover { 
            transform: translateY(-5px); 
            background: #d32f2f; 
            color: white; 
        }
        .feature-card:hover i {
            color: white !important;
        }
        .btn-custom {
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: bold;
            margin: 5px;
        }
        hr {
            width: 80px;
            margin: 20px auto;
            border: 2px solid white;
            opacity: 0.5;
        }
    </style>
</head>
<body>

<!-- Header / Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-fist-raised"></i> FightTrack
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav ms-auto">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a class="nav-link" href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
                    <a class="nav-link" href="workouts.php"><i class="fas fa-dumbbell"></i> Workouts</a>
                    <a class="nav-link" href="boxing.php"><i class="fas fa-boxing-glove"></i> Boxing</a>
                    <a class="nav-link" href="profile.php"><i class="fas fa-user"></i> Profile</a>
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                <?php else: ?>
                    <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a class="nav-link" href="register.php"><i class="fas fa-user-plus"></i> Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">
            <i class="fas fa-fist-raised"></i> Welcome to FightTrack
        </h1>
        <p class="lead fs-3 mt-3">Track Your Gym Workouts and Boxing Training in One Place</p>
        <hr>
        <?php if(!isset($_SESSION['user_id'])): ?>
            <div>
                <a href="register.php" class="btn btn-light btn-custom">
                    <i class="fas fa-user-plus"></i> Get Started
                </a>
                <a href="login.php" class="btn btn-outline-light btn-custom">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </div>
        <?php else: ?>
            <div>
                <a href="dashboard.php" class="btn btn-light btn-custom">
                    <i class="fas fa-chart-line"></i> Go to Dashboard
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Features Section -->
<div class="container py-5">
    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card feature-card h-100">
                <div class="card-body">
                    <i class="fas fa-dumbbell fa-3x text-danger mb-3"></i>
                    <h3>Track Workouts</h3>
                    <p>Log exercises, Sets, Reps and Weights. Monitor Strength Progress.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card feature-card h-100">
                <div class="card-body">
                    <i class="fas fa-fist-raised fa-3x text-danger mb-3"></i>
                    <h3>Boxing Training</h3>
                    <p>Track Rounds: Shadowboxing, Bag Work, Sparring and Cardio.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card feature-card h-100">
                <div class="card-body">
                    <i class="fas fa-chart-line fa-3x text-danger mb-3"></i>
                    <h3>Progress Dashboard</h3>
                    <p>Visualize Training Consistency and Improvement Over Time.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>