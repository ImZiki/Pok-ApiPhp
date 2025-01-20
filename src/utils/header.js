document.addEventListener("DOMContentLoaded", function () {
    // Obtener el nombre del archivo actual
    const currentPage = window.location.pathname.split("/").pop();

    // Función para actualizar el menú de navegación
    function updateHeader() {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "header-links.php?page=" + currentPage, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                document.getElementById("nav-links").innerHTML = xhr.responseText;
            } else {
                console.error("Error al cargar los enlaces del header");
            }
        };
        xhr.send();
    }

    updateHeader();
});
