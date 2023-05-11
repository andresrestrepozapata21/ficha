document.getElementById("campo").addEventListener("keyup", getCodigos);
var formEntidad = document.getElementById("formEntidad");
var answerEntidad = document.getElementById("answerEntidad");
var content_scroll = document.getElementById("content_scroll");
var info = document.getElementById("tableBody");
var resultEntidad = document.getElementById("resultEntidad");
var resultEntidad_2 = document.getElementById("resultEntidad_2");
var resultEntidad_3 = document.getElementById("resultEntidad_3");
const loadingModalEntidad = document.getElementById(
  "loading-modal-entidad"
);
const contentResultEntidad = document.getElementById(
  "contentResultEntidad"
);

function getCodigos() {
  let inputCP = document.getElementById("campo").value;
  let lista = document.getElementById("lista");

  if (inputCP.length > 0) {
    let url = "backend/getEntidades.php";
    let formData = new FormData();
    formData.append("campo", inputCP);

    fetch(url, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        lista.style.display = "block";
        lista.innerHTML = data;
      });
  } else {
    lista.style.display = "none";
  }
}

function mostrar(cp, nombre_EE) {
  lista.style.display = "none";
  $("#cp").val(cp);
  $("#campo").val(nombre_EE);
}

formEntidad.addEventListener("submit", (e) => {
  e.preventDefault();
  let datos = new FormData(formEntidad);
  let cp = datos.get("cp");
  let institucion = datos.get("campo");

  if (cp === "") {
    answerEntidad.classList.add("show");
    setTimeout(function () {
      answerEntidad.classList.remove("show");
    }, 2000);
    return;
  }

  // Mostrar el modal de carga
  loadingModalEntidad.style.display = "block";
  content_scroll.classList.remove("mdk-header-layout__content--scrollable");

  fetch("backend/getCoordenadasEntidad.php", {
    method: "POST",
    body: JSON.stringify({
      cp: cp,
    }),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((res) => res.json())
    .then((data) => {
      //Destruyo los datos que esten inicializados en el DataTable para que dicha tabla se actualice
      var table = $("#data-table").DataTable();
      table.destroy();

      //Obtuvo el JSON, entonces ahora dibuje el mapa
      locations = data;

      let lat = data[0]["lat"];
      let lng = data[0]["lng"];

      const map = new google.maps.Map(
        document.getElementById("mapInstitucion"),
        {
            zoom: 6,
            center: { lat: 4.691798, lng: -73.869012 },
          //mapTypeId: "hybrid",
        }
      );

      let contador = 0;
      let contentInfo = ``;
      let total_matriculado_acumulado = 0;
      let total_docentes_acumulado = 0;

      for (i = 0; i <= data.length - 1; i++) {
        let codigo_dane_EE = data[i]["codigo_dane_EE"];
        let est_id = data[i]["est_id"];
        let nombre_EE = data[i]["nombre_EE"];
        let codigo_dane_sede = data[i]["codigo_dane_sede"];
        let sede_id = data[i]["sede_id"];
        let nombre_sede = data[i]["nombre_sede"];
        let total_matricula = data[i]["total_matricula"];
        let numero_docentes = data[i]["numero_docentes"];
        let zona = data[i]["zona"];
        let direccion_sede = data[i]["direccion_sede"];
        let veredaCorregimiento = data[i]["BARRIO_VEREDA"];
        if (veredaCorregimiento === "") {
          veredaCorregimiento = "N/A";
        }
        let departamento = data[i]["departamento"];
        let municipio = data[i]["municipio"];

        let contentString =
          '<div id="content">' +
          '<div id="siteNotice">' +
          "</div>" +
          '<div style="width: 100%;"><h4 id="firstHeading" class="firstHeading" style="margin-top: 20px;width: 95%;margin: 0 auto;text-align: center;">Información</h4></div>' +
          '<div id="bodyContent">' +
          "<br>" +
          "<p><b>Código Dane EE: </b>" +
          codigo_dane_EE +
          "</p>" +
          "<p><b>ID EE: </b>" +
          est_id +
          "</p>" +
          "<p><b>Nombre EE: </b><span class='text-danger'>" +
          nombre_EE +
          "</span></p>" +
          "</p>" +
          "<p><b>Código Dane Sede: </b>" +
          codigo_dane_sede +
          "</p>" +
          "<p><b>ID Sede: </b>" +
          sede_id +
          "</p>" +
          "<p><b>Nombre Sede: </b><span class='text-danger'>" +
          nombre_sede +
          "</span></p>" +
          "<p><b>Departamento: </b>" +
          departamento +
          "</p>" +
          "<p><b>Municipio: </b>" +
          municipio +
          "</p>" +
          "<p><b>Zona: </b>" +
          zona +
          "</p>" +
          "<p><b>Barrio/Vereda/Corregimiento: </b>" +
          veredaCorregimiento +
          "</p>" +
          "<p><b>Dirección: </b>" +
          direccion_sede +
          "</p>" +
          "<p><b>Número de Docentes: </b>" +
          numero_docentes +
          "</p>" +
          "<p><b>Total Matriculados: </b>" +
          total_matricula +
          "</p>" +
          "<p><b>Latitud: </b><span class='text-danger'>" +
          lat +
          "</span></p>" +
          "<p><b>Longitud: </b><span class='text-danger'>" +
          lng +
          "</span></p>" +
          "</div>" +
          "</div>";
        let latitud = data[i]["lat"];
        let longitud = data[i]["lng"];
        let position = { lat: latitud, lng: longitud };

        const marker = new google.maps.Marker({
          label: {
            text: nombre_sede.substring(0, 2),
            color: "#222222",
            fontSize: "15px",
            fontWeight: "bold",
          },
          position: position,
          map,
          title: "Uluru (Ayers Rock)",
        });

        marker.addListener("click", () => {
          infowindow.open({
            anchor: marker,
            map,
          });
        });

        const infowindow = new google.maps.InfoWindow({
          content: contentString,
          maxWidth: 1000,
          ariaLabel: "Uluru",
        });

        //Guarpo en una variable cada fila del dataTable con la informacion de las sedes
        contentInfo += `
        <tr>
          <td>${codigo_dane_EE}</td>
          <td>${est_id}</td>
          <td>${nombre_EE}</td>
          <td>${codigo_dane_sede}</td>
          <td>${sede_id}</td>
          <td>${nombre_sede}</td>
          <td>${departamento}</td>
          <td>${municipio}</td>
          <td>${zona}</td>
          <td>${veredaCorregimiento}</td>
          <td>${direccion_sede}</td>
          <td>${numero_docentes}</td>
          <td>${total_matricula}</td>
          <td>${lat}</td>
          <td>${lng}</td>
        </tr>
      `;

        contador++;
        total_matriculado_acumulado += total_matricula;
        total_docentes_acumulado += numero_docentes;
      }

      //Pinto la tabla con los datos correpondientes
      info.innerHTML = "";
      info.innerHTML = contentInfo;

      //Mostramos los resultado estadisticos
      resultEntidad.classList.add("show");
      resultEntidad.innerHTML = `
          <i class="material-icons text-success md-48">check_circle</i>
          <div class="media-body pl-2">
              <h4 class="m-0">Institución:</h4>
              <span>${institucion}</span>
          </div>
        `;
      resultEntidad_2.classList.add("show");
      resultEntidad_2.innerHTML = `
          <i class="material-icons text-success md-48">check_circle</i>
          <div class="media-body pl-2">
              <h4 class="m-0">${total_matriculado_acumulado.toLocaleString()}</h4>
              <span>Total de Estudiantes Matriculados</span>
          </div>
        `;
      resultEntidad_3.classList.add("show");
      resultEntidad_3.innerHTML = `
          <i class="material-icons text-success md-48">check_circle</i>
          <div class="media-body pl-2">
              <h4 class="m-0">${total_docentes_acumulado.toLocaleString()}</h4>
              <span>Total de Docentes</span>
          </div>
        `;

      //Inicio el .dataTable para que se aplique el dataTable a la tabla correspondiente pero antes destruyo la inicializacion para que no me salte error
      $("#data-table").dataTable({
        language: {
          sProcessing: "Procesando...",
          sLengthMenu: "Mostrar _MENU_ registros",
          sZeroRecords: "No se encontraron resultados",
          sEmptyTable: "Ningún dato disponible en esta tabla",
          sInfo:
            "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          sInfoEmpty:
            "Mostrando registros del 0 al 0 de un total de 0 registros",
          sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
          sInfoPostFix: "",
          sSearch: "Buscar:",
          sUrl: "",
          sInfoThousands: ",",
          sLoadingRecords: "Cargando...",
          oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior",
          },
          oAria: {
            sSortAscending:
              ": Activar para ordenar la columna de manera ascendente",
            sSortDescending:
              ": Activar para ordenar la columna de manera descendente",
          },
          buttons: {
            copy: "Copiar",
            colvis: "Visibilidad",
          },
        },
      });

      // Ocultar el modal de carga
      loadingModalEntidad.style.display = "none";
      content_scroll.classList.add("mdk-header-layout__content--scrollable");
      contentResultEntidad.style.display = "block";

      $("#cp").val("");
      $("#campo").val("");
    });
});
