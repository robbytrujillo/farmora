<?php
include 'partials/header.php';
?>

<div class="app profile-page">

    <!-- TOP HEADER -->
    <div class="d-flex align-items-center mb-4">

        <a href="index.php" class="text-success fs-3 me-3 text-decoration-none">
            <i class="bi bi-arrow-left"></i>
        </a>

        <h4 class="mb-0 fw-bold">
            Profile
        </h4>

    </div>


    <!-- PROFILE CARD -->
    <div class="header-profile">

        <img src="https://ui-avatars.com/api/?name=Robby+I&background=2f9e44&color=fff&size=200">

        <h4 class="mt-3 mb-1">
            Robby Ilhamkusuma
        </h4>

        <p class="text-muted mb-1">
            robby@farmogana.id
        </p>

        <small class="text-muted">
            📍 Gunung Putri, Bogor
        </small>

        <button class="btn btn-success mt-3 px-4">
            Edit Profile
        </button>

    </div>


    <!-- STATS -->
    <div class="card-ui stats-box">

        <div>
            <h4>24</h4>
            <small>Total Scan</small>
        </div>

        <div>
            <h4>12</h4>
            <small>Healthy</small>
        </div>

        <div>
            <h4>4</h4>
            <small>Warning</small>
        </div>

    </div>


    <!-- ACCOUNT SETTINGS -->
    <div class="card-ui">

        <h5 class="mb-3">Account Settings</h5>

        <div class="menu-item">
            <i class="bi bi-envelope-fill"></i>
            Change Email
        </div>

        <div class="menu-item">
            <i class="bi bi-geo-alt-fill"></i>
            Change City
        </div>

        <div class="menu-item">
            <i class="bi bi-lock-fill"></i>
            Change Password
        </div>

    </div>


    <!-- SCAN HISTORY -->
    <div class="card-ui">

        <h5 class="mb-3">Scan History</h5>

        <div class="history-item">
            <strong>Tomat Sakit</strong>
            <span class="text-warning">Warning</span>
            <small>11 May 2026 - 15:12 WIB</small>
        </div>

        <div class="history-item">
            <strong>Cabai Sehat</strong>
            <span class="text-success">Healthy</span>
            <small>10 May 2026 - 09:41 WIB</small>
        </div>

        <div class="history-item">
            <strong>Cabai Layu</strong>
            <span class="text-danger">Critical</span>
            <small>08 May 2026 - 18:27 WIB</small>
        </div>

    </div>


    <!-- LOGOUT -->
    <!-- <div class="card-ui text-center">

        <button class="btn btn-outline-danger w-100">
            Logout
        </button>

    </div> -->

</div>

<?php include 'partials/footer.php'; ?>