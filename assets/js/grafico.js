const ctx = document.getElementById("myChart").getContext("2d");
const ctxPie = document.getElementById("myChartPie").getContext("2d");
const ctxHorizontalBar = document
  .getElementById("myChartHorizontalBar")
  .getContext("2d");

// <block:data:3>
const dataPie = {
  labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
  datasets: [
    {
      label: "# of Votes",
      data: [12, 19, 3, 5, 2, 3],
      borderWidth: 1,
      backgroundColor: [
        "#CB4335",
        "#1F618D",
        "#F1C40F",
        "#27AE60",
        "#884EA0",
        "#D35400",
      ],
    },
  ],
};

// <block:setup:1>
const DATA_COUNT = 7;
const NUMBER_CFG = { count: DATA_COUNT, min: -100, max: 100 };
const months = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
const labelsHorizontalBar = months;
console.log(labelsHorizontalBar)

const dataHorizontalBar = {
  labels: labelsHorizontalBar,
  datasets: [
    {
      label: "Dataset 1",
      data: labelsHorizontalBar.map(() => {
        return [Math.floor(Math.random() * 201) - 100, Math.floor(Math.random() * 201) - 100];
      }),
      borderColor: "#FF1F1F",
      backgroundColor: "#FF1F1F",
    },
    {
      label: "Dataset 2",
      data: labelsHorizontalBar.map(() => {
        return [Math.floor(Math.random() * 201) - 100, Math.floor(Math.random() * 201) - 100];
      }),
      borderColor: "#1F37FF",
      backgroundColor: "#1F37FF",
    },
  ],
};

/*------------------------------------------
gradico de barras
-------------------------------------------*/
const myChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: ["Lunes", "Martes", "Miercoles", "Jueves", "Sabado", "Domingo"],
    datasets: [
      {
        label: "$ Utilidades Diarias",
        data: [120000, 300000, 50000, 500000, 100000, 700000],
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

/*------------------------------------------
gradico de pastel
-------------------------------------------*/
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

/*------------------------------------------
gradico barras horizaontales
-------------------------------------------*/
// </block:data>
const myChartHorizontalBar = new Chart(ctxHorizontalBar, {
  type: 'bar',
  data: dataHorizontalBar,
  options: {
    indexAxis: 'y',
    // Elements options apply to all of the options unless overridden in a dataset
    // In this case, we are setting the border of each horizontal bar to be 2px wide
    elements: {
      bar: {
        borderWidth: 2,
      }
    },
    responsive: true,
    plugins: {
      legend: {
        position: 'right',
      },
      title: {
        display: true,
        text: 'Chart.js Horizontal Bar Chart'
      }
    }
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
