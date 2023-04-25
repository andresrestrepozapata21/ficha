const ctxGenerosEstu = document
  .getElementById("myChartGenerosEstu")
  .getContext("2d");
const ctxEtniasEstu = document
  .getElementById("myChartEtniasEstu")
  .getContext("2d");
const ctxInternadosEstu = document
  .getElementById("myChartInternadosEstu")
  .getContext("2d");

const loadingModalEstudiantes = document.getElementById("loading_modal_estudiantes");
var content_scroll_estudiantes = document.getElementById(
  "content_scroll_estudiantes"
);
loadingModalEstudiantes.style.display = "block";
content_scroll_estudiantes.classList.remove(
  "mdk-header-layout__content--scrollable"
);

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
    const myChartGenerosEstu = new Chart(ctxGenerosEstu, {
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
    const myChartEtniasEstu = new Chart(ctxEtniasEstu, {
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
    loadingModalEstudiantes.style.display = "none";
    content_scroll_estudiantes.classList.add("mdk-header-layout__content--scrollable");
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
    const myChartInternadosEstu = new Chart(ctxInternadosEstu, {
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
