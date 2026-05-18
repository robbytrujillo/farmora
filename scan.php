<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>farmogana Scanner</title>

    <link rel="icon" type="image/x-icon" href="/farmogana/assets/images/logo.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

    * {
        font-family: "Poppins", sans-serif;
    }

    body {
        background: #edf5ed;
        font-family: "Poppins", sans-serif;
    }

    .app {
        max-width: 420px;
        margin: auto;
        padding: 20px;
        min-height: 100vh;
        padding-bottom: 100px;
    }

    .header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .header a {
        font-size: 24px;
        color: #2f9e44;
        text-decoration: none;
    }

    .card-ui {
        background: white;
        padding: 25px;
        border-radius: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        margin-bottom: 20px;
        text-align: center;
    }

    video,
    img,
    canvas {
        width: 100%;
        border-radius: 20px;
        margin-top: 15px;
    }

    .result-card {
        background: white;
        padding: 20px;
        border-radius: 25px;
        margin-top: 20px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
    }

    .result-card h3 {
        color: #2f9e44;
        font-weight: 700;
    }

    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 420px;
        background: white;
        padding: 15px;
        display: flex;
        justify-content: space-around;
        border-radius: 25px 25px 0 0;
        box-shadow: 0 -8px 20px rgba(0, 0, 0, .08);
    }

    .bottom-nav a {
        font-size: 22px;
        color: #666;
    }

    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        max-width: 420px;
        background: white;
        padding: 16px 10px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        border-radius: 25px 25px 0 0;
        box-shadow: 0 -8px 25px rgba(0, 0, 0, .08);
        z-index: 999;
    }

    .bottom-nav a {
        font-size: 22px;
        color: #8a8a8a;
        text-decoration: none;
        transition: .25s;
    }

    .bottom-nav a.active {
        color: #2f9e44;
        transform: translateY(-3px);
    }

    .bottom-nav a:hover {
        color: #2f9e44;
    }

    .active {
        color: #2f9e44 !important;
    }
    </style>
</head>

<body>

    <div class="app">

        <div class="header">
            <a href="index.php">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h4>AI Plant Scanner</h4>
        </div>

        <div class="card-ui">

            <p>Pilih metode scan</p>

            <button id="cameraBtn" class="btn btn-success w-100 mb-2">
                Scan Kamera
            </button>

            <input type="file" id="upload" accept="image/*" class="form-control">

            <div id="preview"></div>

        </div>

        <div id="result"></div>

        <div id="pdfBtnWrap"></div>

    </div>


    <!-- Bottom Nav -->
    <!-- <div class="bottom-nav">

        <a href="index.php">
            <i class="bi bi-house"></i>
        </a>

        <a href="#">
            <i class="bi bi-chat"></i>
        </a>

        <a class="active" href="scan.php">
            <i class="bi bi-camera-fill"></i>
        </a>

        <a href="#">
            <i class="bi bi-book"></i>
        </a>

        <a href="#">
            <i class="bi bi-person"></i>
        </a>

    </div> -->

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

        <a href="/farmogana/profile.php" class="<?= basename($_SERVER['PHP_SELF'])=='profile.php'?'active':'' ?>">
            <i class="bi bi-person-fill"></i>
        </a>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>

    <script src="/farmogana/assets/js/scan.js"></script>

</body>

</html>