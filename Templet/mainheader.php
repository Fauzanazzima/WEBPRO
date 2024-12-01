<?php
define('HOST', "http://localhost/Webpro/");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Logo and Title -->
            <a class="navbar-brand d-flex align-items-center" href="<?= HOST ?>">
            <img src="<?= HOST ?>images/Logo FM.php" alt="Finance Manager Logo" style="width: 40px; height: 40px; margin-right: 10px;">
                <h4 class="mb-0">Finance Manager</h4>
            </a>
            <!-- Toggle button for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= HOST ?>/tLogin">Home</a>
                    </li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= HOST ?>/Tabungan/index.php">Savings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= HOST ?>/tAnggran/index.php">Budgets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= HOST ?>Transaksi/index.php">Transactions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= HOST ?>summary.php">Summary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= HOST ?>investments.php">Investments</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <!-- Search Bar -->
                <form class="d-flex me-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

                <!-- Login/Logout and Register Button -->
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="<?= HOST ?>/tLogin/logout.php" class="btn btn-danger">Logout</a>
                <?php else: ?>
                    <a href="<?= HOST ?>login.php" class="btn btn-primary me-2">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
       

