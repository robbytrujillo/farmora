const MODEL_URL = "/farmogana/assets/model/";

let model;
let webcam;
let liveMode = false;

async function init() {
  model = await tmImage.load(
    MODEL_URL + "model.json",
    MODEL_URL + "metadata.json",
  );

  console.log("Model Loaded");
}

init();

/* upload */
document
  .getElementById("upload")
  .addEventListener("change", async function (e) {
    const file = e.target.files[0];
    if (!file) return;

    const img = new Image();

    img.src = window.URL.createObjectURL(file);

    img.onload = async function () {
      showPreview(img);

      await predict(img, true);
    };
  });

/* start cam */
document.getElementById("cameraBtn").addEventListener("click", startCamera);

async function startCamera() {
  webcam = new tmImage.Webcam(350, 300, true);

  await webcam.setup();
  await webcam.play();

  liveMode = true;

  document.getElementById("preview").innerHTML = "";

  document.getElementById("preview").appendChild(webcam.canvas);

  addCaptureButton();

  window.requestAnimationFrame(loop);
}

async function loop() {
  if (!liveMode) return;

  webcam.update();

  await predict(webcam.canvas, false);

  window.requestAnimationFrame(loop);
}

function addCaptureButton() {
  document.getElementById("preview").insertAdjacentHTML(
    "beforeend",
    `
<button id="captureBtn"
class="btn btn-success w-100 mt-3" style="border-radius: 30px;">
Ambil Foto
</button>
`,
  );

  document.getElementById("captureBtn").addEventListener("click", captureImage);
}

async function captureImage() {
  liveMode = false;

  const canvas = document.createElement("canvas");

  canvas.width = webcam.canvas.width;
  canvas.height = webcam.canvas.height;

  const ctx = canvas.getContext("2d");

  ctx.drawImage(webcam.canvas, 0, 0);

  showPreview(canvas);

  await predict(canvas, true);
}

function showPreview(source) {
  document.getElementById("preview").innerHTML = "";

  document.getElementById("preview").appendChild(source);
}

async function predict(source, locked = false) {
  const prediction = await model.predict(source);

  prediction.sort((a, b) => b.probability - a.probability);

  const top = prediction[0];

  const confidence = (top.probability * 100).toFixed(1);

  let status = "";
  let advice = "";

  switch (top.className) {
    case "Tomat Sehat":
      status = "Healthy";
      advice = "Tanaman tomat sehat.";
      break;

    case "Tomat Sakit":
      status = "Warning";
      advice = "Tomat terindikasi penyakit. Kurangi kelembapan berlebih.";
      break;

    case "Cabai Sehat":
      status = "Healthy";
      advice = "Cabai sehat.";
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
      advice = "Tidak dikenali.";
  }

  render(top.className, confidence, status, advice, locked);
}

function render(plant, confidence, status, advice, locked) {
  let badge = locked ? "Final Result" : "Live Detection";

  document.getElementById("result").innerHTML = `

<div class="result-card">

<p>${badge}</p>

<h3>${plant}</h3>

<h1>${confidence}%</h1>

<p><strong>Status:</strong> ${status}</p>

<p>${advice}</p>

</div>

`;

  if (locked) {
    generatePDFButton(plant, confidence, status, advice);
  }
}

function generatePDFButton(plant, confidence, status, advice) {
  const el = document.querySelector("#preview canvas,#preview img");

  let imageData = "";

  if (el.tagName === "CANVAS") {
    imageData = el.toDataURL("image/png");
  } else {
    const c = document.createElement("canvas");

    c.width = el.naturalWidth;
    c.height = el.naturalHeight;

    const ctx = c.getContext("2d");

    ctx.drawImage(el, 0, 0);

    imageData = c.toDataURL("image/png");
  }

  document.getElementById("pdfBtnWrap").innerHTML = `

<form
method="POST"
action="export.php"
target="_blank">

<input type="hidden"
name="image"
value="${imageData}">

<input type="hidden"
name="plant"
value="${plant}">

<input type="hidden"
name="confidence"
value="${confidence}">

<input type="hidden"
name="status"
value="${status}">

<input type="hidden"
name="advice"
value="${advice}">

<button
class="btn btn-success w-100 mt-3" style="border-radius: 30px;">
Cetak PDF
</button>

</form>

`;
}
