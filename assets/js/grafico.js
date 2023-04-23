const ctx = document.getElementById("myChart").getContext("2d");
const ctxPie = document.getElementById("myChartPie").getContext("2d");
const ctxPie2 = document.getElementById("myChartPie2").getContext("2d");
let cantidadUrbanas = 0;
let cantidadRurales = 0;

/*------------------------------------------
Grafico de barras par la cantidad de instituciones por departamento
-------------------------------------------*/
fetch("backend/getDptos.php", {
  method: "GET",
  headers: {
    "Content-Type": "application/json",
  },
})
  .then((res) => res.json())
  .then((data) => {
    let departamentos = [];
    let cantidadInstituciones = [];
    data.forEach((el) => {
      departamentos.push(el.departamento.substring(0, 10));
      cantidadInstituciones.push(el.cantidad);
    });
    //pinto el grafico
    const myChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: departamentos,
        datasets: [
          {
            label: "Cantidad Instituciones por Departamento: ",
            data: cantidadInstituciones,
            backgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 206, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(255, 159, 64, 0.2)",
            ],
            borderColor: [
              "rgba(255, 99, 132, 1)",
              "rgba(54, 162, 235, 1)",
              "rgba(255, 206, 86, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(153, 102, 255, 1)",
              "rgba(255, 159, 64, 1)",
            ],
            borderWidth: 1,
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
  });

/*------------------------------------------
Grafico de pastel para urbanas y rurales de las instituciones
-------------------------------------------*/
fetch("backend/getPorZona.php", {
  method: "GET",
  headers: {
    "Content-Type": "application/json",
  },
})
  .then((res) => res.json())
  .then((data) => {
    cantidadUrbanas = data["urbanas"];
    cantidadRurales = data["rurales"];
    // <block:data:3>
    const dataPie = {
      labels: ["Urbanas", "Rurales"],
      datasets: [
        {
          label: "Cantidad de instituciones por zona",
          data: [cantidadUrbanas, cantidadRurales],
          borderWidth: 1,
          backgroundColor: ["#CB4335", "#1F618D"],
        },
      ],
    };

    // </block:data>
    const myChartPie = new Chart(ctxPie, {
      type: "pie",
      data: dataPie,
      options: {
        plugins: {
          legend: {
            onHover: handleHover,
            onLeave: handleLeave,
          },
        },
      },
    });
  });

/*------------------------------------------
Grafico pie 2 para los generos de los estudiantes
-------------------------------------------*/
// <block:setup:1>
const DATA_COUNT = 5;
const NUMBER_CFG = { count: DATA_COUNT, min: 0, max: 100 };

const dataPie2 = {
  labels: ["Red", "Orange", "Yellow", "Green", "Blue"],
  datasets: [
    {
      label: "Dataset 1",
      data: [123,123,1,23,32,8,4,3],
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
const myChartPie2 = new Chart(ctxPie2, {
  type: "doughnut",
  data: dataPie2,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: "top",
      },
      title: {
        display: true,
        text: "Chart.js Doughnut Chart",
      },
    },
  },
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
