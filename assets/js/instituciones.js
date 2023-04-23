document.getElementById("campo").addEventListener("keyup", getCodigos);
var formInstitucion = document.getElementById("formInstitucion");
var answerInsti = document.getElementById("answerInsti");
var content_scroll = document.getElementById("content_scroll");
var info = document.getElementById("info");
var resultInst = document.getElementById("resultInst");
var resultInst_2 = document.getElementById("resultInst_2");
var resultInst_3 = document.getElementById("resultInst_3");
const loadingModalInstitution = document.getElementById(
  "loading-modal-institution"
);
const contentResultInstitucion = document.getElementById(
  "contentResultInstitucion"
);

function getCodigos() {
  let inputCP = document.getElementById("campo").value;
  let lista = document.getElementById("lista");

  if (inputCP.length > 0) {
    let url = "backend/getInstituciones.php";
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

function mostrar(cp, nombre_sede) {
  lista.style.display = "none";
  $("#cp").val(cp);
  $("#campo").val(nombre_sede);
}

formInstitucion.addEventListener("submit", (e) => {
  e.preventDefault();
  let datos = new FormData(formInstitucion);
  let cp = datos.get("cp");
  let institucion = datos.get("campo");

  if (cp === "") {
    answerInsti.classList.add("show");
    setTimeout(function () {
      answerInsti.classList.remove("show");
    }, 2000);
    return;
  }

  // Mostrar el modal de carga
  loadingModalInstitution.style.display = "block";
  content_scroll.classList.remove("mdk-header-layout__content--scrollable");

  fetch("backend/getCoordenadasInsitucion.php", {
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
      //Obtuvo el JSON, entonces ahora dibuje el mapa
      locations = data;

      let lat = data[0]["lat"];
      let lng = data[0]["lng"];

      const map = new google.maps.Map(
        document.getElementById("mapInstitucion"),
        {
          zoom: 12,
          center: { lat: lat, lng: lng },
          //mapTypeId: "hybrid",
        }
      );

      let contador = 0;
      let contentInfo = ``;
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
        <div class="col-12 d-flex">
            <div class="col-6 my-3 ">
                <label class="">ID</label>
                <input type="text" class="form-control" value="${codigo_dane}" readonly>
            </div>
            <div class="col-6 my-3 ">
                <label class="">Código Dane</label>
                <input type="text" class="form-control" value="${sede_id}" readonly>
            </div>
        </div>
        <div class="col-12 d-flex">
            <div class="col-6 my-3 ">
                <label class="">Nombre EE</label>
                <input type="text" class="form-control" value="${nombre_EE}" readonly>
            </div>
            <div class="col-6 my-3 ">
                <label class="">Nombre Sede</label>
                <input type="text" class="form-control" value="${nombre_sede}" readonly>
            </div>
        </div>
        <div class="col-12 d-flex">
            <div class="col-6 my-3 ">
                <label class="">Total Matriculados en la Sede</label>
                <input type="text" class="form-control" value="${total_matricula}" readonly>
            </div>
            <div class="col-6 my-3 ">
                <label class="">Total Docentes en la Sede</label>
                <input type="text" class="form-control" value="${numero_docentes}" readonly>
            </div>
        </div>
        <div class="col-12 d-flex">
            <div class="col-6 my-3 ">
                <label class="">Zona Sede</label>
                <input type="text" class="form-control" value="${zona}" readonly>
            </div>
            <div class="col-6 my-3 ">
                <label class="">Dirección Sede</label>
                <input type="text" class="form-control" value="${direccion_sede}" readonly>
            </div>
        </div>
        <div class="col-12 d-flex">
            <div class="col-6 my-3 ">
                <label class="">Departamento de la Sede</label>
                <input type="text" class="form-control" value="${departamento}" readonly>
            </div>
            <div class="col-6 my-3 ">
                <label class="">Municipio de la Sede</label>
                <input type="text" class="form-control" value="${municipio}" readonly>
            </div>
        </div>
        <div class="col-12 d-flex">
            <div class="col-6 my-3 ">
                <label class="">Latitud de la Sede</label>
                <input type="text" class="form-control" value="${lat}" readonly>
            </div>
            <div class="col-6 my-3 ">
                <label class="">Longitud de la Sede</label>
                <input type="text" class="form-control" value="${lng}" readonly>
            </div>
        </div>
      `;

        contador++;
        total_matriculado_acumulado += total_matricula;
        total_docentes_acumulado += numero_docentes;
      }

      //Pinto la tabla con los datos correpondientes
      info.innerHTML = "";
      info.innerHTML = contentInfo;

      //Mostramos los resultado estadisticos
      resultInst.classList.add("show");
      resultInst.innerHTML = `
          <i class="material-icons text-success md-48">check_circle</i>
          <div class="media-body pl-2">
              <h4 class="m-0">Institución:</h4>
              <span>${institucion}</span>
          </div>
        `;
      resultInst_2.classList.add("show");
      resultInst_2.innerHTML = `
          <i class="material-icons text-success md-48">check_circle</i>
          <div class="media-body pl-2">
              <h4 class="m-0">${total_matriculado_acumulado.toLocaleString()}</h4>
              <span>Total de Estudiantes Matriculados</span>
          </div>
        `;
      resultInst_3.classList.add("show");
      resultInst_3.innerHTML = `
          <i class="material-icons text-success md-48">check_circle</i>
          <div class="media-body pl-2">
              <h4 class="m-0">${total_docentes_acumulado.toLocaleString()}</h4>
              <span>Total de Docentes</span>
          </div>
        `;

      // Ocultar el modal de carga
      loadingModalInstitution.style.display = "none";
      content_scroll.classList.add("mdk-header-layout__content--scrollable");
      contentResultInstitucion.style.display = "block";

      $("#cp").val("");
      $("#campo").val("");
    });
});
