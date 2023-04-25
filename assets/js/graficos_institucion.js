const ctxInstituciones = document
  .getElementById("myChartInstituciones")
  .getContext("2d");
const ctxPieInstituciones = document
  .getElementById("myChartPieInstituciones")
  .getContext("2d");
const ctxConectadasInstituciones = document
  .getElementById("myChartConectadasInstituciones")
  .getContext("2d");

const loadingModalInstituciones = document.getElementById("loading_modal_instituciones");
var content_scroll_instituciones = document.getElementById("content_scroll_instituciones");
loadingModalInstituciones.style.display = "block";
content_scroll_instituciones.classList.remove("mdk-header-layout__content--scrollable");

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
    const myChartInstituciones = new Chart(ctxInstituciones, {
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
          backgroundColor: ["#CB4335", "#1F618D"],
        },
      ],
    };

    // </block:data>
    const myChartPieInstituciones = new Chart(ctxPieInstituciones, {
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
    const myChartConectadasInstituciones = new Chart(
      ctxConectadasInstituciones,
      {
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
      }
    );
    loadingModalInstituciones.style.display = "none";
    content_scroll_instituciones.classList.add("mdk-header-layout__content--scrollable");
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
