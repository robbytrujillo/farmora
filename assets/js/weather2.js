document.addEventListener("DOMContentLoaded", function () {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(success, fail);
  } else {
    fail();
  }
});

function fail() {
  fetchWeather(-6.4025, 106.7942, "Depok");
}

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

async function fetchWeather(lat, lon, cityName) {
  const res = await fetch(`/farmogana/api/weather.php?lat=${lat}&lon=${lon}`);

  const data = await res.json();

  document.getElementById("city").innerText = cityName;

  document.getElementById("temp").innerText = Math.round(data.temp) + "°";

  document.getElementById("weather").innerText = data.weather;

  document.getElementById("humidity").innerText = data.humidity + "%";

  document.getElementById("wind").innerText = data.wind + " m/s";

  document.getElementById("weatherIcon").src =
    `https://openweathermap.org/img/wn/${data.icon}@2x.png`;
}
