const ctxPie2Docentes = document
  .getElementById("myChartPie2Docentes")
  .getContext("2d");
const ctxEscalafonDocentes = document
  .getElementById("escalafonDocentes")
  .getContext("2d");
const ctxVinculacionDocentes = document
  .getElementById("tiempoVinculacionDocentes")
  .getContext("2d");

const loadingModalDocentes = document.getElementById(
  "loading_modal_docentes"
);
var content_scroll_docentes = document.getElementById(
  "content_scroll_docentes"
);
loadingModalDocentes.style.display = "block";
content_scroll_docentes.classList.remove(
  "mdk-header-layout__content--scrollable"
);

/*------------------------------------------
Grafico pie 2 para los rangos de edades de los docentes
-------------------------------------------*/
fetch("backend/getEdadesDocentes.php", {
  method: "GET",
  headers: {
    "Content-Type": "application/json",
  },
})
  .then((res) => res.json())
  .then((data) => {
    // <block:setup:1>
    const DATA_COUNT = 5;
    const NUMBER_CFG = { count: DATA_COUNT, min: 0, max: 100 };

    const dataPie2Docentes = {
      labels: ["de 18 a 30 años", "de 31 a 50 años", "más de 51 años"],
      datasets: [
        {
          label: "Rango de Edades de los Docentes",
          data: [data["rango1"], data["rango2"], data["rango3"]],
          backgroundColor: [
            "rgba(255, 99, 132, 0.5)",
            "rgba(54, 162, 235, 0.5)",
            "rgba(255, 206, 86, 0.5)",
            "rgba(75, 192, 192, 0.5)",
            "rgba(153, 102, 255, 0.5)",
            "rgba(255, 159, 64, 0.5)",
          ],
        },
      ],
    };
    // </block:data>
    const myChartPie2Docentes = new Chart(ctxPie2Docentes, {
      type: "doughnut",
      data: dataPie2Docentes,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: "top",
          },
          title: {
            display: true,
            text: "Rango de Edades",
          },
        },
      },
    });
  });

/*------------------------------------------
Grafico para saber la cantidad de docentes por escalafon
-------------------------------------------*/
fetch("backend/getEscalafon.php", {
  method: "GET",
  headers: {
    "Content-Type": "application/json",
  },
})
  .then((res) => res.json())
  .then((data) => {
    // <block:setup:1>
    const DATA_COUNT = 5;
    const NUMBER_CFG = { count: DATA_COUNT, min: 0, max: 100 };

    let labelsEscalafon = [];
    let dataEscalafon = [];

    for (let variable in data) {
      let nombreVariable = variable;
      let valorVariable = data[variable];

      labelsEscalafon.push(nombreVariable);
      dataEscalafon.push(valorVariable);
    }
    const dataPieEscalafonDocentes = {
      labels: labelsEscalafon,
      datasets: [
        {
          label: "Cantidad por Escalafón",
          data: dataEscalafon,
          backgroundColor: [
            "rgba(255, 206, 86, 0.5)",
            "rgba(75, 192, 192, 0.5)",
            "rgba(153, 102, 255, 0.5)",
            "rgba(255, 159, 64, 0.5)",
          ],
        },
      ],
    };
    // </block:data>
    const myChartPieEscalafonDocentes = new Chart(ctxEscalafonDocentes, {
      type: "doughnut",
      data: dataPieEscalafonDocentes,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: "top",
          },
          title: {
            display: true,
            text: "Cantidad por Escalafon",
          },
        },
      },
    });
  });

/*------------------------------------------
Grafica para ver los rangos de tiempo transcurrido de vincuacion de los docentes
-------------------------------------------*/
fetch("backend/getTiempoVinculacion.php", {
  method: "GET",
  headers: {
    "Content-Type": "application/json",
  },
})
  .then((res) => res.json())
  .then((data) => {
    // <block:setup:1>
    const DATA_COUNT = 5;
    const NUMBER_CFG = { count: DATA_COUNT, min: 0, max: 100 };

    const dataPievinculacionDocentes = {
      labels: [
        "de 0 a 1 años",
        "de 1 a 3 años",
        "de 3 a 6 años",
        "más de 6 años",
      ],
      datasets: [
        {
          label: "Rango de Tiempo de Vinculación",
          data: [
            data["rango1"],
            data["rango2"],
            data["rango3"],
            data["rango4"],
          ],
          backgroundColor: [
            "rgba(255, 206, 86, 0.5)",
            "rgba(75, 192, 192, 0.5)",
            "rgba(153, 102, 255, 0.5)",
            "rgba(255, 159, 64, 0.5)",
          ],
        },
      ],
    };
    // </block:data>
    const myChartPieVinculacionDocentes = new Chart(ctxVinculacionDocentes, {
      type: "doughnut",
      data: dataPievinculacionDocentes,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: "top",
          },
          title: {
            display: true,
            text: "Rango de Tiempo de Vinculación",
          },
        },
      },
    });
    loadingModalDocentes.style.display = "none";
    content_scroll_Docentes.classList.add("mdk-header-layout__content--scrollable");
  });

// <block:handleHover:1>
// Append '4d' to the colors (alpha channel), except for the hovered index
function handleHover(evt, item, legend) {
  legend.chart.data.datasets[0].backgroundColor.forEach(
    (color, index, colors) => {
      colors[index] =
        index === item.index || color.length === 9 ? color : color + "4D";
    }
  );
  legend.chart.update();
}
// </block:handleHover>

// <block:handleLeave:2>
// Removes the alpha channel from background colors
function handleLeave(evt, item, legend) {
  legend.chart.data.datasets[0].backgroundColor.forEach(
    (color, index, colors) => {
      colors[index] = color.length === 9 ? color.slice(0, -2) : color;
    }
  );
  legend.chart.update();
}
// </block:handleLeave>
