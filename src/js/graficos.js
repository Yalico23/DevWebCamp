import Chart from "chart.js/auto";

(function () {
  const grafica = document.querySelector("#myChart");
  if (grafica) {
    let nombreRegalos = [];
    let dataRegalos = [];

    async function InfoRegalos() {
      try {
        const URL = `${location.origin}/api/regalos`;
        const resultado = await fetch(URL);
        const respuesta = await resultado.json();

        const { Nombres , Data} = respuesta;
        nombreRegalos = Nombres;
        dataRegalos = Data;
      } catch (error) {
        console.log(error);
      }
    }
    InfoRegalos().then(() => {
        Grafico();
    });

    function Grafico() {
      const ctx = document.getElementById("myChart");
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: nombreRegalos,
          datasets: [
            {
              label: "# of Votes",
              data: dataRegalos,
              borderWidth: 1,
              backgroundColor: [
                "#ea580c",
                "#84cc16",
                "#22d3ee",
                "#a855f7",
                "#ef4444",
                "#14b8a6",
                "#db2777",
                "#e11d48",
                "#7e22ce",
              ],
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    }
  }
})();