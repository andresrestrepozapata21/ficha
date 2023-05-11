const ctx = document.getElementById("myChart").getContext("2d");
const ctxPie = document.getElementById("myChartPie").getContext("2d");
const ctxPie2 = document.getElementById("myChartPie2").getContext("2d");
const ctxConectadas = document
  .getElementById("myChartConectadas")
  .getContext("2d");
const ctxVinculacion = document
  .getElementById("tiempoVinculacion")
  .getContext("2d");
const ctxGeneros = document.getElementById("myChartGeneros").getContext("2d");
const ctxEtnias = document.getElementById("myChartEtnias").getContext("2d");
const ctxInternados = document
  .getElementById("myChartInternados")
  .getContext("2d");

const loadingModalHome = document.getElementById("loading_modal_home");
var content_scroll = document.getElementById("content_scroll_home");

loadingModalHome.style.display = "block";
content_scroll.classList.remove("mdk-header-layout__content--scrollable");

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
            backgroundColor: ["rgba(255, 99, 132, 0.2)"],
            borderColor: ["rgba(255, 99, 132, 1)"],
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
    let cantidadUrbanas = data["urbanas"];
    let cantidadRurales = data["rurales"];
    // <block:data:3>
    const dataPie = {
      labels: ["Urbanas", "Rurales"],
      datasets: [
        {
          label: "Cantidad de instituciones por zona",
          data: [cantidadUrbanas, cantidadRurales],
          borderWidth: 1,
          backgroundColor: [
            "rgba(128, 139, 150, 0.5)",
            "rgba(30, 132, 73, 0.5)",
          ],
          borderColor: ["rgba(128, 139, 150, 1)", "rgba(30, 132, 73, 1)"],
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

    const dataPie2 = {
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
            text: "Rango de Edades",
          },
        },
      },
    });
  });

/*------------------------------------------
Grafico para sabes la cantidad de insticuciones conectadas o no
-------------------------------------------*/
fetch("backend/getConectadas.php", {
  method: "GET",
  headers: {
    "Content-Type": "application/json",
  },
})
  .then((res) => res.json())
  .then((data) => {
    //pinto el grafico
    const myChartConectadas = new Chart(ctxConectadas, {
      type: "bar",
      data: {
        labels: ["Conectividad"],
        datasets: [
          {
            label: "Instituciones Conectadas",
            data: [data["conectadas"]],
            backgroundColor: ["rgba(75, 192, 192, 0.2)"],
            borderColor: ["rgba(75, 192, 192, 1)"],
            borderWidth: 1,
          },
          {
            label: "Instituciones No Conectadas",
            data: [data["noConectadas"]],
            backgroundColor: ["rgba(153, 102, 255, 0.2)"],
            borderColor: ["rgba(153, 102, 255, 1)"],
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

    const dataPievinculacion = {
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
    const myChartPieVinculacion = new Chart(ctxVinculacion, {
      type: "doughnut",
      data: dataPievinculacion,
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
    loadingModalHome.style.display = "none";
    content_scroll.classList.add("mdk-header-layout__content--scrollable");
  });

/*------------------------------------------
Grafico cantidad de generos de estudiantes en colombia
-------------------------------------------*/
fetch("backend/getGeneros.php", {
  method: "GET",
  headers: {
    "Content-Type": "application/json",
  },
})
  .then((res) => res.json())
  .then((data) => {
    //pinto el grafico
    const myChartGeneros = new Chart(ctxGeneros, {
      type: "bar",
      data: {
        labels: ["Generos en Colombia"],
        datasets: [
          {
            label: "Femenino",
            data: [data["femenino"]],
            backgroundColor: ["rgba(255, 99, 132, 0.2)"],
            borderColor: ["rgba(255, 99, 132, 1)"],
            borderWidth: 1,
          },
          {
            label: "Masculino",
            data: [data["masculino"]],
            backgroundColor: ["rgba(54, 162, 235, 0.2)"],
            borderColor: ["rgba(54, 162, 235, 1)"],
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
Grafico cantidad de Etnias de estudiantes en colombia
-------------------------------------------*/
fetch("backend/getEtnias.php", {
  method: "GET",
  headers: {
    "Content-Type": "application/json",
  },
})
  .then((res) => res.json())
  .then((data) => {
    //pinto el grafico
    const myChartEtnias = new Chart(ctxEtnias, {
      type: "bar",
      data: {
        labels: ["Etnias de Estudiantes en Colombia"],
        datasets: [
          {
            label: "Afrodescendientes",
            data: [data["afrodescendientes"]],
            backgroundColor: ["rgba(255, 99, 132, 0.2)"],
            borderColor: ["rgba(255, 99, 132, 1)"],
            borderWidth: 1,
          },
          {
            label: "Indígenas",
            data: [data["indigenas"]],
            backgroundColor: ["rgba(54, 162, 235, 0.2)"],
            borderColor: ["rgba(54, 162, 235, 1)"],
            borderWidth: 1,
          },
          {
            label: "Wayu",
            data: [data["wayu"]],
            backgroundColor: ["rgba(255, 206, 86, 0.2)"],
            borderColor: ["rgba(255, 206, 86, 1)"],
            borderWidth: 1,
          },
          {
            label: "Negritudes",
            data: [data["negritudes"]],
            backgroundColor: ["rgba(75, 192, 192, 0.2)"],
            borderColor: ["rgba(75, 192, 192, 1)"],
            borderWidth: 1,
          },
          {
            label: "Palenquero",
            data: [data["palenquero"]],
            backgroundColor: ["rgba(153, 102, 255, 0.2)"],
            borderColor: ["rgba(153, 102, 255, 1)"],
            borderWidth: 1,
          },
          {
            label: "Raizales",
            data: [data["raizales"]],
            backgroundColor: ["rgba(255, 159, 64, 0.2)"],
            borderColor: ["rgba(255, 159, 64, 1)"],
            borderWidth: 1,
          },
          {
            label: "Rom",
            data: [data["rom"]],
            backgroundColor: ["rgba(22, 160, 133, 0.2)"],
            borderColor: ["rgba(22, 160, 133, 1)"],
            borderWidth: 1,
          },
          {
            label: "Otras Etnias",
            data: [data["otras_etnias"]],
            backgroundColor: ["rgba(198, 128, 128, 0.2)"],
            borderColor: ["rgba(198, 128, 128, 1)"],
            borderWidth: 1,
          },
          {
            label: "No Aplica",
            data: [data["no_aplica"]],
            backgroundColor: ["rgba(130, 224, 170, 0.2)"],
            borderColor: ["rgba(130, 224, 170, 1)"],
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
Grafico cantidad de internados de estudiantes en colombia
-------------------------------------------*/
fetch("backend/getInternados.php", {
  method: "GET",
  headers: {
    "Content-Type": "application/json",
  },
})
  .then((res) => res.json())
  .then((data) => {
    //pinto el grafico
    const myChartInternados = new Chart(ctxInternados, {
      type: "bar",
      data: {
        labels: ["Interandos de Estudiantes en Colombia"],
        datasets: [
          {
            label: "Internados",
            data: [data["internado"]],
            backgroundColor: ["rgba(255, 99, 132, 0.2)"],
            borderColor: ["rgba(255, 99, 132, 1)"],
            borderWidth: 1,
          },
          {
            label: "Semi-Internado",
            data: [data["semi_internado"]],
            backgroundColor: ["rgba(54, 162, 235, 0.2)"],
            borderColor: ["rgba(54, 162, 235, 1)"],
            borderWidth: 1,
          },
          {
            label: "Ninguno",
            data: [data["ninguno"]],
            backgroundColor: ["rgba(255, 206, 86, 0.2)"],
            borderColor: ["rgba(255, 206, 86, 1)"],
            borderWidth: 1,
          },
          {
            label: "No Reportado",
            data: [data["no_reportado"]],
            backgroundColor: ["rgba(75, 192, 192, 0.2)"],
            borderColor: ["rgba(75, 192, 192, 1)"],
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
