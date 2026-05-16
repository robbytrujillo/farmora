document.addEventListener("DOMContentLoaded", function () {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(success, fail);
  } else {
    fail();
  }
});

/* fallback */
function fail() {
  fetchWeather(-6.4025, 106.7942, "Depok");
}

/* lokasi user */
async function success(position) {
  const lat = position.coords.latitude;
  const lon = position.coords.longitude;

  let cityName = "Lokasi Anda";

  try {
    const geo = await fetch(
      `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`,
    );

    const loc = await geo.json();

    cityName =
      loc.address.village ||
      loc.address.suburb ||
      loc.address.town ||
      loc.address.city ||
      "Lokasi Anda";
  } catch (e) {
    console.log(e);
  }

  fetchWeather(lat, lon, cityName);
}

/* ambil weather */
async function fetchWeather(lat, lon, cityName) {
  const res = await fetch(`/farmora/api/weather.php?lat=${lat}&lon=${lon}`);

  const data = await res.json();

  console.log(data);

  document.getElementById("city").innerText = cityName;

  document.getElementById("temp").innerText = Math.round(data.temp) + "°";

  document.getElementById("weather").innerText = data.weather;

  document.getElementById("humidity").innerText = data.humidity + "%";

  document.getElementById("wind").innerText = data.wind + " m/s";

  document.getElementById("weatherIcon").src =
    `https://openweathermap.org/img/wn/${data.icon}@2x.png`;

  /* rekomendasi tanaman */
  getRecommendation(data.temp, data.humidity);
}

/* rekomendasi */
async function getRecommendation(temp, humidity) {
  const res = await fetch(
    `/farmora/api/recommend.php?temp=${temp}&humidity=${humidity}`,
  );

  const plants = await res.json();

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
