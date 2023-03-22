function initMap() {
  fetch("http://localhost/FICHA/dev/backend/getCoordenadas.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((res) => res.json())
    .then((data) => {
      //Obtuvo el JSON, entonces ahora dibuje el mapa
      locations = data;
      console.log(data);

      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 6,
        center: { lat: 4.691798, lng: -73.869012 },
        //mapTypeId: "hybrid",
      });

      for (i = 0; i <= data.length - 1; i++) {
        let codigo_dane = data[i]["codigo_dane_sede"];
        let sede_id = data[i]["sede_id"];
        let nombre_EE = data[i]["nombre_EE"];
        let nombre_sede = data[i]["nombre_sede"];
        let total_matricula = data[i]["total_matricula"];
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
          '<br>' +
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
      }
    });
}

window.initMap = initMap;
