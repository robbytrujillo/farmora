<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Farmora AI Scanner</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
        background: #edf5ed;
        font-family: 'Segoe UI', sans-serif;
    }

    .app {
        max-width: 420px;
        margin: auto;
        min-height: 100vh;
        padding: 20px;
    }

    .scan-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
    }

    .scan-header a {
        color: #2f9e44;
        font-size: 24px;
        text-decoration: none;
    }

    .scan-header h4 {
        margin: 0;
        font-weight: 700;
        color: #222;
    }

    .scan-card {
        background: white;
        padding: 28px;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        text-align: center;
    }

    .scan-icon {
        font-size: 70px;
        color: #2f9e44;
    }

    .scan-title {
        margin-top: 15px;
        font-weight: 700;
    }

    .scan-sub {
        color: #777;
        font-size: 14px;
    }

    #upload {
        margin-top: 20px;
    }

    .scan-preview {
        width: 100%;
        border-radius: 22px;
        margin-top: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
    }

    .result-card {
        background: white;
        padding: 25px;
        border-radius: 24px;
        margin-top: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        text-align: center;
    }

    .result-card h3 {
        font-weight: 700;
        color: #2f9e44;
    }

    .result-card h1 {
        font-size: 50px;
        font-weight: 800;
    }

    .result-card p {
        color: #444;
    }

    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 420px;
        background: white;
        border-radius: 25px 25px 0 0;
        padding: 15px;
        display: flex;
        justify-content: space-around;
        box-shadow: 0 -8px 20px rgba(0, 0, 0, .08);
    }

    .bottom-nav a {
        color: #666;
        font-size: 22px;
    }

    .active-nav {
        color: #2f9e44 !important;
    }
    </style>
</head>

<body>

    <div class="app">

        <!-- HEADER -->
        <div class="scan-header">
            <a href="index.php">
                <i class="bi bi-arrow-left"></i>
            </a>

            <h4>AI Plant Scanner</h4>
        </div>

        <!-- UPLOAD -->
        <div class="scan-card">

            <i class="bi bi-camera-fill scan-icon"></i>

            <h4 class="scan-title">
                Scan Tanaman
            </h4>

            <p class="scan-sub">
                Upload gambar daun tanaman untuk mendeteksi kondisi kesehatan secara otomatis
            </p>

            <input type="file" id="upload" accept="image/*" class="form-control">

        </div>

        <!-- PREVIEW -->
        <div id="preview"></div>

        <!-- RESULT -->
        <div id="result"></div>

    </div>

    <!-- BOTTOM NAV -->
    <div class="bottom-nav">

        <a href="index.php">
            <i class="bi bi-house"></i>
        </a>

        <a href="#">
            <i class="bi bi-chat"></i>
        </a>

        <a class="active-nav" href="scan.php">
            <i class="bi bi-camera-fill"></i>
        </a>

        <a href="#">
            <i class="bi bi-book"></i>
        </a>

        <a href="#">
            <i class="bi bi-person"></i>
        </a>

    </div>

    <!-- TENSORFLOW -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image"></script> -->

    <!-- SCAN JS -->
    <!-- <script src="assets/js/scan.js"></script> -->


    <!-- TensorFlow Browser -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>

    <!-- Teachable Machine Browser -->
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@0.8/dist/teachablemachine-image.min.js"></script>

    <!-- App -->
    <script src="/farmora/assets/js/scan.js"></script>

</body>

</html>