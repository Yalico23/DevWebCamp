(function () {
  const mapa = document.querySelector("#mapa");
  if (mapa) {

    const lat = -12.029216;
    const lng = -77.018320;
    const zoom = 16;

    const map = L.map("mapa").setView([lat, lng], zoom);

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    L.marker([lat, lng])
      .addTo(map)
      .bindPopup(`
            <h2 class='map__heading'>DevWebCamp</h2>
            <p class='map__texto'>Centro</p>
        `)
      .openPopup();
  }
})();
