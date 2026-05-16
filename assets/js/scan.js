const MODEL_URL = "/farmora/assets/model/";

let model;

/* =========================
   LOAD MODEL
========================= */
async function init() {
  try {
    model = await tmImage.load(
      MODEL_URL + "model.json",
      MODEL_URL + "metadata.json",
    );

    console.log("Model Loaded");
  } catch (error) {
    console.error(error);

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
   UPLOAD
========================= */
document
  .getElementById("upload")
  .addEventListener("change", async function (e) {
    const file = e.target.files[0];

    if (!file) return;

    const img = new Image();

    /* pakai browser URL bawaan */
    img.src = window.URL.createObjectURL(file);

    img.onload = async function () {
      previewImage(img.src);

      await predict(img);
    };
  });

/* =========================
   PREVIEW
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
      advice = "Tanaman tomat sehat. Lanjutkan penyiraman rutin.";
      break;

    case "Tomat Sakit":
      status = "Warning";
      advice = "Tomat terindikasi penyakit. Kurangi kelembapan berlebih.";
      break;

    case "Cabai Sehat":
      status = "Healthy";
      advice = "Cabai sehat. Pertahankan perawatan.";
      break;

    case "Cabai Layu":
      status = "Critical";
      advice = "Cabai layu. Periksa akar dan kadar air.";
      break;

    case "Bukan Tanaman":
      status = "Invalid";
      advice = "Objek bukan tanaman.";
      break;

    default:
      status = "Unknown";
      advice = "Model tidak mengenali objek.";
  }

  renderResult(top.className, confidence, status, advice);
}

/* =========================
   RENDER
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
