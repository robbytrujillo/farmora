<?php
include 'config/db.php';
include 'partials/header.php';

$plants = $conn->query("SELECT * FROM plants");
?>

<!-- HERO WEATHER -->
<div class="hero">

    <div>
        <h5 id="city">Loading...</h5>
        <p id="weather">...</p>

        <div class="mini-info mt-3">
            <span>💧 <span id="humidity">--</span></span>
            <br>
            <span>🌬 <span id="wind">--</span></span>
        </div>
    </div>

    <div class="text-end">
        <img id="weatherIcon" width="70">
        <h1 id="temp">--°</h1>
    </div>

</div>


<!-- SMART REMINDER -->
<div class="card-ui">
    <h6>Smart Reminder</h6>
    <p>Siram tanaman jam 16:00</p>
</div>


<!-- REKOMENDASI TANAMAN -->
<div class="mt-4">
    <h5>Rekomendasi Tanaman</h5>
    <div id="recommendation"></div>
</div>


<!-- PLANTS -->
<?php while($p=$plants->fetch_assoc()): ?>

<div class="card-ui">

    <h5><?= $p['name'] ?></h5>

    <div class="progress">

        <div class="progress-bar bg-success" style="width:<?= $p['growth'] ?>%">
        </div>

    </div>

    <p class="mt-2">
        <?= $p['growth'] ?>% Growth
    </p>

    <p>Status:
        <?= $p['status'] ?>
    </p>

</div>

<?php endwhile; ?>


<!-- SCAN CARD -->
<a href="scan.php" class="text-decoration-none text-dark">

    <div class="card-ui text-center">

        <i class="bi bi-camera-fill fs-1 text-success"></i>

        <h5>Scan Plant</h5>

        <p>Deteksi kesehatan tanaman dengan AI</p>

    </div>

</a>


<script src="/farmora/assets/js/weather.js"></script>

<?php include 'partials/footer.php'; ?>