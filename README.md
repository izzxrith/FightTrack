# 🥊 FightTrack

FightTrack is a modern gym and boxing training tracker built with PHP and MySQL.  
The application helps users track workouts, boxing sessions, fitness progress and training consistency through a clean dashboard interface.

---

## 📸 Screenshots

| Main Page | Dashboard |
|-----------|-----------|
| ![Main Page](images/MainPage.png) | ![Dashboard](images/Dashboard.png) |

---

## ✨ Features

- User authentication system (Register, Login, Logout)
- Workout tracking (Add, Edit, Delete)
- Boxing training tracker (Add, Edit, Delete)
- Progress dashboard with statistics
- User profile management
- Responsive modern UI with Bootstrap 5
- Session-based access control
- Password hashing for security

---

## 🛠️ Tech Stack

### Backend
- PHP
- MySQL
- PDO (Prepared Statements)

### Frontend
- HTML
- CSS
- Bootstrap 5
- Font Awesome Icons

---


## 🚀 How to Run

### Prerequisites
- XAMPP / WAMP / MAMP with PHP 7.4+
- MySQL database
- Web browser

### Steps

1. **Start XAMPP** (Apache & MySQL)

2. **Create database**  
   Open phpMyAdmin and run the SQL schema:
   ```sql
   CREATE DATABASE fighttrack_db;
   
   USE fighttrack_db;
   
   CREATE TABLE users (
       id INT PRIMARY KEY AUTO_INCREMENT,
       username VARCHAR(80) UNIQUE NOT NULL,
       email VARCHAR(120) UNIQUE NOT NULL,
       password VARCHAR(200) NOT NULL,
       full_name VARCHAR(100),
       height FLOAT,
       weight FLOAT,
       goals TEXT,
       boxing_experience VARCHAR(50),
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   
   CREATE TABLE workouts (
       id INT PRIMARY KEY AUTO_INCREMENT,
       user_id INT NOT NULL,
       exercise_name VARCHAR(100) NOT NULL,
       sets INT NOT NULL,
       reps INT NOT NULL,
       weight FLOAT,
       workout_date DATE NOT NULL,
       FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
   );
   
   CREATE TABLE boxing_sessions (
       id INT PRIMARY KEY AUTO_INCREMENT,
       user_id INT NOT NULL,
       shadowboxing_rounds INT DEFAULT 0,
       bag_work_rounds INT DEFAULT 0,
       sparring_rounds INT DEFAULT 0,
       cardio_minutes INT DEFAULT 0,
       notes TEXT,
       session_date DATE NOT NULL,
       FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
   );

3. **Copy folder** to C:\xampp\htdocs\FightTrack\

4. **Configure database**
   Edit db.php with your database credentials :
   ```bash
   $database = "fighttrack_db";
   $username = "root";
   $password = "";
   ```

5. **Access the application**
   Open browser and go to http://localhost/FightTrack/register.php