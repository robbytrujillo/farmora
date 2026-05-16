const URL = "/farmora/assets/model/";

let model;
let maxPredictions;

/* =========================
   LOAD MODEL
========================= */
async function init() {
  try {
    model = await tmImage.load(URL + "model.json", URL + "metadata.json");

    maxPredictions = model.getTotalClasses();

    console.log("Model Loaded");
  } catch (error) {
    console.error("Model gagal load:", error);

    document.getElementById("result").innerHTML = `
            <div class="alert alert-danger">
                Model gagal dimuat.
                Cek folder:
                assets/model/
            </div>
        `;
  }
}

init();

/* =========================
   UPLOAD IMAGE
========================= */
document
  .getElementById("upload")
  .addEventListener("change", async function (e) {
    const file = e.target.files[0];

    if (!file) return;

    const img = new Image();

    img.src = URL.createObjectURL(file);

    img.onload = async function () {
      previewImage(img.src);

      await predict(img);
    };
  });

/* =========================
   PREVIEW IMAGE
========================= */
function previewImage(src) {
  document.getElementById("preview").innerHTML = `
        <img src="${src}"
        class="scan-preview">
    `;
}

/* =========================
   PREDICT
========================= */
async function predict(img) {
  const prediction = await model.predict(img);

  prediction.sort((a, b) => b.probability - a.probability);

  const top = prediction[0];

  const confidence = (top.probability * 100).toFixed(1);

  let advice = "";
  let status = "";

  switch (top.className) {
    case "Tomat Sehat":
      status = "Healthy";
      advice =
        "Tanaman tomat sehat. Lanjutkan penyiraman rutin dan pastikan terkena sinar matahari cukup.";
      break;

    case "Tomat Sakit":
      status = "Warning";
      advice =
        "Daun tomat terindikasi penyakit. Kurangi kelembapan berlebih dan cek kemungkinan jamur.";
      break;

    case "Cabai Sehat":
      status = "Healthy";
      advice = "Tanaman cabai sehat. Pertahankan pola perawatan dan pemupukan.";
      break;

    case "Cabai Layu":
      status = "Critical";
      advice =
        "Cabai terindikasi layu / stres air. Periksa akar dan tingkat kelembapan tanah.";
      break;

    case "Bukan Tanaman":
      status = "Invalid";
      advice = "Objek bukan tanaman. Upload foto daun tanaman.";
      break;

    default:
      status = "Unknown";
      advice = "Model tidak mengenali objek.";
  }

  renderResult(top.className, confidence, status, advice);
}

/* =========================
   RENDER RESULT
========================= */
function renderResult(plant, confidence, status, advice) {
  document.getElementById("result").innerHTML = `

    <div class="result-card">

        <h3>${plant}</h3>

        <h1>${confidence}%</h1>

        <p>
            <strong>Status:</strong>
            ${status}
        </p>

        <p>${advice}</p>

    </div>

    `;
}
