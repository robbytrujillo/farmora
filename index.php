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
            <span>💧 <span id="humidity">--</span></span><br>
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
    <p id="reminderText">Loading reminder...</p>
</div>


<!-- REKOMENDASI -->
<div class="mt-4">
    <h5>Rekomendasi Tanaman</h5>
    <div id="recommendation"></div>
</div>


<!-- PLANTS -->
<?php while($p=$plants->fetch_assoc()): ?>

<div class="card-ui plant-item" data-name="<?= strtolower($p['name']) ?>" data-growth="<?= $p['growth'] ?>">

    <h5><?= $p['name'] ?></h5>

    <div class="progress">
        <div class="progress-bar" style="width:<?= $p['growth'] ?>%">
        </div>
    </div>

    <p class="mt-2">
        <?= $p['growth'] ?>% Growth
    </p>

    <p class="status-text">
        Status: <?= $p['status'] ?>
    </p>

</div>

<?php endwhile; ?>


<!-- SCAN -->
<a href="scan.php" class="text-decoration-none text-dark">
    <div class="card-ui text-center">
        <i class="bi bi-camera-fill fs-1 text-success"></i>
        <h5>Scan Plant</h5>
        <p>Deteksi kesehatan tanaman dengan AI</p>
    </div>
</a>

<script src="/farmogana/assets/js/mlpredict.js"></script>
<script src="/farmogana/assets/js/weather.js"></script>

<!-- <script>
function updateSmartUI(data) {

    const weather = data.weather.toLowerCase();

    const recommendation =
        document.getElementById("recommendation");

    const reminder =
        document.getElementById("reminderText");

    let plants = [];
    let remind = "";

    if (weather.includes("rain")) {
        plants = ["Bayam", "Kangkung", "Sawi"];
        remind = "Tidak perlu menyiram hari ini 🌧";
    } else if (weather.includes("cloud")) {
        plants = ["Tomat", "Cabai", "Terong"];
        remind = "Siram sore jam 16:00 ☁";
    } else {
        plants = ["Semangka", "Jagung", "Pepaya"];
        remind = "Siram pagi & sore ☀";
    }

    recommendation.innerHTML =
        plants.map(p => `
            <div class="plant-card">
                🌱 ${p}
            </div>
        `).join("");

    reminder.innerHTML = remind;


    // update status tanaman
    document.querySelectorAll(".plant-item")
        .forEach(card => {

            const growth =
                parseInt(card.dataset.growth);

            const status =
                card.querySelector(".status-text");

            if (growth >= 70) {
                status.innerHTML =
                    "Status: Healthy ✅";
                status.className =
                    "status-text text-success";
            } else if (growth >= 40) {
                status.innerHTML =
                    "Status: Growing 🌿";
                status.className =
                    "status-text text-warning";
            } else {
                status.innerHTML =
                    "Status: Critical ⚠";
                status.className =
                    "status-text text-danger";
            }

        });
}
</script> -->

<script>
function updateSmartUI(data) {

    const weather =
        data.weather.toLowerCase();

    const reminder =
        document.getElementById(
            "reminderText"
        );

    let remind = "";

    if (weather.includes("rain")) {

        remind =
            "Tidak perlu menyiram hari ini 🌧";

    } else if (weather.includes("cloud")) {

        remind =
            "Siram sore jam 16:00 ☁";

    } else {

        remind =
            "Siram pagi & sore ☀";

    }

    reminder.innerHTML = remind;


    // STATUS TANAMAN
    document.querySelectorAll(".plant-item")
        .forEach(card => {

            const growth =
                parseInt(
                    card.dataset.growth
                );

            const status =
                card.querySelector(
                    ".status-text"
                );

            if (growth >= 70) {

                status.innerHTML =
                    "Status: Healthy ✅";

                status.className =
                    "status-text text-success";

            } else if (growth >= 40) {

                status.innerHTML =
                    "Status: Growing 🌿";

                status.className =
                    "status-text text-warning";

            } else {

                status.innerHTML =
                    "Status: Critical ⚠";

                status.className =
                    "status-text text-danger";

            }

        });

}
</script>


<!-- Bottom Nav -->
<div class="bottom-nav">

    <a href="index.php" class="<?= basename($_SERVER['PHP_SELF'])=='index.php'?'active':'' ?>">
        <i class="bi bi-house-fill"></i>
    </a>

    <a href="#">
        <i class="bi bi-chat-dots-fill"></i>
    </a>

    <a href="scan.php" class="<?= basename($_SERVER['PHP_SELF'])=='scan.php'?'active':'' ?>">
        <i class="bi bi-camera-fill"></i>
    </a>

    <a href="#">
        <i class="bi bi-book-fill"></i>
    </a>

    <a href="profile.php" class="<?= basename($_SERVER['PHP_SELF'])=='profile.php'?'active':'' ?>">
        <i class="bi bi-person-fill"></i>
    </a>

</div>

<?php include 'partials/footer.php'; ?>