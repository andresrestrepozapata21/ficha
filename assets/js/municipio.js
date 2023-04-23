var formMunicipio = document.getElementById("formMunicipio");
var answerMunicipio = document.getElementById("answerMunicipio");
var resultM = document.getElementById("resultMunicipio");
var resultM_2 = document.getElementById("resultMunicipio_2");
var resultM_3 = document.getElementById("resultMunicipio_3");
var tableBody = document.getElementById("tableBody");
var content_scroll = document.getElementById("content_scroll");
const loadingModalTown = document.getElementById("loading-modal");
const contentResultMunicipio = document.getElementById("contentResultMunicipio");

formMunicipio.addEventListener("submit", (e) => {
  e.preventDefault();
  let datos = new FormData(formMunicipio);
  let dpto = datos.get("dpto");
  let municipio = datos.get("municipio");

  if (dpto === "selecciona" || municipio === "selecciona") {
    answerMunicipio.classList.add("show");
    setTimeout(function () {
      answerMunicipio.classList.remove("show");
    }, 2000);
  } else {
    // Mostrar el modal de carga
    loadingModalTown.style.display = "block";
    content_scroll.classList.remove("mdk-header-layout__content--scrollable");

    fetch("backend/getCoordenadasMunicipio.php", {
      method: "POST",
      body: JSON.stringify({
        municipio: municipio,
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

        const map = new google.maps.Map(
          document.getElementById("mapMunicipio"),
          {
            zoom: 6,
            center: { lat: 4.691798, lng: -73.869012 },
            //mapTypeId: "hybrid",
          }
        );

        let contador = 0;
        let contentTable = ``;
        let total_matriculado_acumulado = 0;
        let total_docentes_acumulado = 0;

        for (i = 0; i <= data.length - 1; i++) {
          let codigo_dane = data[i]["codigo_dane_sede"];
          let sede_id = data[i]["sede_id"];
          let nombre_EE = data[i]["nombre_EE"];
          let nombre_sede = data[i]["nombre_sede"];
          let total_matricula = data[i]["total_matricula"];
          let numero_docentes = data[i]["numero_docentes"];
          let zona = data[i]["zona"];
          let direccion_sede = data[i]["direccion_sede"];
          let departamento = data[i]["departamento"];
          let municipio = data[i]["municipio"];
          let lat = data[i]["lat"];
          let lng = data[i]["lng"];
          let contentString =
            '<div id="content">' +
            '<div id="siteNotice">' +
            "</div>" +
            '<div style="width: 100%;"><h4 id="firstHeading" class="firstHeading" style="margin-top: 20px;width: 95%;margin: 0 auto;text-align: center;">Información</h4></div>' +
            '<div id="bodyContent">' +
            "<br>" +
            "<p><b>Código Dane: </b>" +
            codigo_dane +
            "</p>" +
            "<p><b>ID de la EE: </b>" +
            sede_id +
            "</p>" +
            "<p><b>Nombre EE: </b><span class='text-danger'>" +
            nombre_EE +
            "</span></p>" +
            "</p>" +
            "<p><b>Nombre Sede: </b><span class='text-danger'>" +
            nombre_sede +
            "</span></p>" +
            "<p><b>Total Matriculados en la  EE: </b>" +
            total_matricula +
            "</p>" +
            "<p><b>Número de Docentes: </b><span class='text-danger'>" +
            numero_docentes +
            "</span></p>" +
            "<p><b>Zona EE: </b>" +
            zona +
            "</p>" +
            "<p><b>Dirección EE: </b>" +
            direccion_sede +
            "</p>" +
            "<p><b>Departamento de la EE: </b>" +
            departamento +
            "</p>" +
            "<p><b>Municipio de la EE: </b>" +
            municipio +
            "</p>" +
            "<p><b>Latitud de la EE: </b><span class='text-danger'>" +
            lat +
            "</span></p>" +
            "<p><b>Longitud de la EE: </b><span class='text-danger'>" +
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
              color: '#222222',
              fontSize: '15px',
              fontWeight: 'bold',
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
          contentTable += `
          <tr>
            <td>${codigo_dane}</td>
            <td>${sede_id}</td>
            <td>${nombre_EE}</td>
            <td>${nombre_sede}</td>
            <td>${total_matricula}</td>
            <td>${numero_docentes}</td>
            <td>${zona}</td>
            <td>${direccion_sede}</td>
            <td>${departamento}</td>
            <td>${municipio}</td>
            <td>${lat}</td>
            <td>${lng}</td>
          </tr>
        `;

          contador++;
          total_matriculado_acumulado += total_matricula;
          total_docentes_acumulado += numero_docentes;
        }

        //Pinto la tabla con los datos correpondientes
        tableBody.innerHTML = "";
        tableBody.innerHTML = contentTable;

        //Muestro los resultados estadisticos
        resultM.classList.add("show");
        resultM.innerHTML = `
          <i class="material-icons text-success md-48">check_circle</i>
          <div class="media-body pl-2">
              <h4 class="m-0">${contador.toLocaleString()}</h4>
              <span>Instituciones Totales en el Municipio de ${municipio}</span>
          </div>
        `;
        resultM_2.classList.add("show");
        resultM_2.innerHTML = `
          <i class="material-icons text-success md-48">check_circle</i>
          <div class="media-body pl-2">
              <h4 class="m-0">${total_matriculado_acumulado.toLocaleString()}</h4>
              <span>Total de Estudiantes Matriculados en el Municipio de ${municipio}</span>
          </div>
        `;
        resultM_3.classList.add("show");
        resultM_3.innerHTML = `
          <i class="material-icons text-success md-48">check_circle</i>
          <div class="media-body pl-2">
              <h4 class="m-0">${total_docentes_acumulado.toLocaleString()}</h4>
              <span>Total de Docentes en el Municipio de ${municipio}</span>
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
        loadingModalTown.style.display = "none";
        content_scroll.classList.add("mdk-header-layout__content--scrollable");
        contentResultMunicipio.style.display = "block";
      });
  }
});
