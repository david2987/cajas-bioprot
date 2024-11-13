$(document).ready(function () {
  $("#pdfCaja").click(function (e) {
    e.preventDefault();
    let id = $("#pdfCaja").attr("data-id");

    $.get("/cajas/pdf/" + id, function (data, textStatus, jqXHR) {
      if (data) {
        $("#lectorPdf").attr("src", documentUrl + data);
      }
    });
  });

  $("#botonMovimientoIngreso").click(function (e) {
    e.preventDefault();
    let cajaId = $(this).attr("data-id");
    let urlCajaIngreso = url + "cajamovimiento/create/" + cajaId + "/" + "I";
    $("#agregarMovimientoIngreso").attr("src", urlCajaIngreso);
  });

  $(".buttonDisponibilizar").click(function (e) {
    const url = $(this).attr("data-url");
    $("#cajaIdModal").val($(this).attr("data-id"));
    $("#formDisponibilizar").attr("action", url);
  });

  $("#aceptarDisponibilizar").on("click", function (e) {
    $("#formDisponibilizar").trigger("submit");
    e.preventDefault();
  });

  $(document).on("submit", "#formDisponibilizar", function (evt) {
    $.post(
      $("#formDisponibilizar").attr("action") + "/" + $("#cajaIdModal").val(),
      $("#formDisponibilizar").serialize(),
      function (result) {
        result = JSON.parse(result);

        if (result.ok == "error") {
          mensaje("error", result.mensaje);
        } else {
          mensaje("success", result.mensaje);
        }
        setTimeout(closeMensaje, 5000);
      }
    );
    evt.preventDefault();
  });

  function mensaje(tipoMensaje, mensaje) {
    $(".descripcionAlert").empty();
    switch (tipoMensaje) {
      case "success":
        $("#mensajeAlert").addClass("alert-success");
        $(".descripcionAlert").append(
          "<i class='far fa-check-circle'></i> " + mensaje
        );
        break;

      case "error":
        $("#mensajeAlert").addClass("alert-danger");
        $(".descripcionAlert").append(
          "<i class='fas fa-times'></i> " + mensaje
        );
        break;

      case "info":
        $("#mensajeAlert").addClass("alert-primary");
        $(".descripcionAlert").append(
          "<i class='fas fa-info'></i>> " + mensaje
        );
        break;
    }
    $("#mensajeAlert").removeClass("invisible");
  }

  function closeMensaje() {
    $("#mensajeAlert").addClass("invisible");
    $("#descripcionAlert").empty();
    window.location.reload();
  }

  //****************** Gallery
  let images = [];
  let currentIndex = 0;

  // document.addEventListener("DOMContentLoaded", fetchImages);
  $(".verImagen").on("click", function (e) {
    id = $(this).attr("data-id");
     fetchImages(id);
    e.preventDefault();
  });

  async function  fetchImages(id) {
    let count = 1;
     data = await fetch("/gallery/getImagesCaja/" + id) // Cambia a la URL donde tienes alojada la API
      .then((response) => response.json())
      .then((data) => {
        return data;
        }).catch((error) => console.error("Error fetching images:", error));
        $(".imagenesCarrousel").empty()
    $.map(data, function (imagen) {
      let active = count == 1 ? "active" : "";
      $(".imagenesCarrousel").append( "<div class='carousel-item " + active + " '>" + "<img src='/" + imagen.image_path + "' class='w-75' alt='Imagen Caja' /> " + "</div>");      
      count += 1;
    });
   
  }

  function displayGallery() {
    const galleryContainer = document.getElementById("galleryContainer");
    galleryContainer.innerHTML = ""; // Limpia la galería antes de agregar nuevas imágenes

    images.forEach((image, index) => {
      const imgElement = document.createElement("img");
      imgElement.src = image;
      imgElement.alt = `Image ${index + 1}`;
      imgElement.onclick = () => openCarousel(index); // Abre el carrusel en la imagen clickeada
      galleryContainer.appendChild(imgElement);
    });
  }

  function openCarousel(index) {
    currentIndex = index;
    document.getElementById("carouselModal").style.display = "flex";
    updateCarouselImage();
  }

  function updateCarouselImage() {
    document.getElementById("carouselImage").src = images[currentIndex];
  }

  function changeSlide(step) {
    currentIndex = (currentIndex + step + images.length) % images.length;
    updateCarouselImage();
  }

  function closeCarousel() {
    $("#carouselModal").addClass("invisible");
  }

  $("#closeCarousel").on("click", function (e) {
    closeCarousel();
  });

  /***** */
});
