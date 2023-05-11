var formDpto = document.getElementById("formDpto");
var answerDpto = document.getElementById("answerDpto");
var result = document.getElementById("result");
var result_2 = document.getElementById("result_2");
var tableBody = document.getElementById("tableBody");
var content_scroll = document.getElementById("content_scroll");
const loadingModal = document.getElementById("loading-modal");
const contentResultDpto = document.getElementById("contentResultDpto");

const $fragmentoDataTable = document.createDocumentFragment();

formDpto.addEventListener("submit", (e) => {
  e.preventDefault();
  let datos = new FormData(formDpto);
  let dpto = datos.get("dpto");

  if (dpto === "selecciona") {
    answerDpto.classList.add("show");
    setTimeout(function () {
      answerDpto.classList.remove("show");
    }, 2000);
  } else {
    // Mostrar el modal de carga
    loadingModal.style.display = "block";
    content_scroll.classList.remove("mdk-header-layout__content--scrollable");

    fetch("backend/getCoordenadasDpto.php", {
      method: "POST",
      body: JSON.stringify({
        dpto,
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
        const map = new google.maps.Map(document.getElementById("mapDpto"), {
          zoom: 6,
          center: { lat: 4.691798, lng: -73.869012 },
          //mapTypeId: "hybrid",
        });

        //Variables euxiliares contador y contenido del dataTable
        let contador = 0;
        let contentTable = ``;
        let total_matriculado_acumulado = 0;

        data.forEach((el) => {
          let codigo_dane_sede = el.codigo_dane_sede;
          let sede_id = el.sede_id;
          let est_id = el.est_id;
          let codigo_dane_EE = el.codigo_dane_EE;
          let nombre_EE = el.nombre_EE;
          let nombre_sede = el.nombre_sede;
          let total_matricula = el.total_matricula;
          let zona = el.zona;
          let direccion_sede = el.direccion_sede;
          let departamento = el.departamento;
          let municipio = el.municipio;
          let veredaCorregimiento = el.barrio_vereda;
          if(veredaCorregimiento === ""){
            veredaCorregimiento = "N/A"
          }
          let lat = el.lat;
          let lng = el.lng;

          //String del Marker del mapa
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
            "<p><b>Código Dane Sede: </b>" +
            codigo_dane_sede +
            "</p>" +
            "<p><b>ID Sede: </b>" +
            sede_id +
            "</p>" +
            "<p><b>Nombre Sede: </b><span class='text-danger'>" +
            nombre_sede +
            "</span></p>" +
            "<p><b>Departamento de la sede: </b>" +
            departamento +
            "</p>" +
            "<p><b>Municipio de la sede: </b>" +
            municipio +
            "</p>" +
            "<p><b>Zona sede: </b>" +
            zona +
            "</p>" +
            "<p><b>Barrio/Vereda/Corregimiento: </b>" +
            veredaCorregimiento +
            "</p>" +
            "<p><b>Dirección sede: </b>" +
            direccion_sede +
            "</p>" +
            "<p><b>Total Matriculados en la  sede: </b>" +
            total_matricula +
            "</p>" +
            "<p><b>Latitud de la sede: </b><span class='text-danger'>" +
            lat +
            "</span></p>" +
            "<p><b>Longitud de la sede: </b><span class='text-danger'>" +
            lng +
            "</span></p>" +
            "</div>" +
            "</div>";

          let position = { lat, lng };

          const marker = new google.maps.Marker({
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
          const $tr = document.createElement("tr");
          $tr.innerHTML = `
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
            <td>${total_matricula}</td>
            <td>${lat}</td>
            <td>${lng}</td>
        `;
          $fragmentoDataTable.appendChild($tr);

          contador++;
          total_matriculado_acumulado += total_matricula;
        });

        //Pinto la tabla con los datos correpondientes
        tableBody.innerHTML = "";
        tableBody.appendChild($fragmentoDataTable);

        //Muestro los resultados
        result.classList.add("show");
        result.innerHTML = `
          <i class="material-icons text-success md-48">check_circle</i>
          <div class="media-body pl-2">
              <h4 class="m-0">${contador.toLocaleString()}</h4>
              <span>Instituciones Totales en el Departamento de ${dpto}</span>
          </div>
        `;

        result_2.classList.add("show");
        result_2.innerHTML = `
          <i class="material-icons text-success md-48">check_circle</i>
          <div class="media-body pl-2">
              <h4 class="m-0">${total_matriculado_acumulado.toLocaleString()}</h4>
              <span>Total de Estudiantes Matriculados en el Departamento: ${dpto}</span>
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
        loadingModal.style.display = "none";
        content_scroll.classList.add("mdk-header-layout__content--scrollable");
        contentResultDpto.style.display = "block";
      });
  }
});
