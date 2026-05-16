// async function loadWeather() {
//   const res = await fetch("/farmora/api/weather.php");
//   const data = await res.json();

//   if (data.error) {
//     console.log(data.error);
//     return;
//   }

//   document.getElementById("city").innerText = data.city;
//   document.getElementById("temp").innerText = `${Math.round(data.temp)}°`;
//   document.getElementById("weather").innerText = data.weather;
//   document.getElementById("humidity").innerText = `${data.humidity}%`;
//   document.getElementById("wind").innerText = `${data.wind} m/s`;

//   document.getElementById("weatherIcon").src =
//     `https://openweathermap.org/img/wn/${data.icon}@2x.png`;
// }

// loadWeather();

// async function loadWeather() {
//   try {
//     const res = await fetch("http://localhost/farmora/api/weather.php");

//     const data = await res.json();

//     console.log(data);

//     if (data.error) {
//       console.log(data.error);
//       return;
//     }

//     document.getElementById("city").innerText = data.city;
//     document.getElementById("temp").innerText = `${Math.round(data.temp)}°`;

//     document.getElementById("weather").innerText = data.weather;

//     document.getElementById("humidity").innerText = `${data.humidity}%`;

//     document.getElementById("wind").innerText = `${data.wind} m/s`;

//     document.getElementById("weatherIcon").src =
//       `https://openweathermap.org/img/wn/${data.icon}@2x.png`;
//   } catch (err) {
//     console.log(err);
//   }
// }

// loadWeather();

document.addEventListener("DOMContentLoaded", async function () {
  try {
    const res = await fetch("/farmora/api/weather.php");
    const data = await res.json();

    console.log(data);

    document.getElementById("city").innerText = data.city;
    document.getElementById("temp").innerText = Math.round(data.temp) + "°";

    document.getElementById("weather").innerText = data.weather;

    document.getElementById("humidity").innerText = data.humidity + "%";

    document.getElementById("wind").innerText = data.wind + " m/s";

    document.getElementById("weatherIcon").src =
      "https://openweathermap.org/img/wn/" + data.icon + "@2x.png";
  } catch (err) {
    console.log("Weather Error:", err);
  }
});
