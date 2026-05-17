async function predictPlant(temp, humidity, wind) {
  let plants = [];

  if (temp <= 25 && humidity >= 80) {
    plants = ["Bayam", "Kangkung", "Sawi"];
  } else if (temp <= 28 && humidity >= 70) {
    plants = ["Tomat", "Cabai"];
  } else if (temp <= 31) {
    plants = ["Jagung", "Pepaya"];
  } else {
    plants = ["Semangka"];
  }

  return plants;
}

function renderRecommendation(plants) {
  let html = "";

  plants.forEach((plant) => {
    html += `
            <div class="plant-card">
                🌱 ${plant}
            </div>
        `;
  });

  document.getElementById("recommendation").innerHTML = html;
}
