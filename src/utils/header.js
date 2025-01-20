document.addEventListener("DOMContentLoaded", async function () {
    const currentPage = window.location.pathname.split("/").pop() || "index.php";

    try {
        const response = await fetch("./header-links.php?page=" + currentPage);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        document.getElementById("nav-links").innerHTML = await response.text();
    } catch (error) {
        console.error("Error al cargar los enlaces del header:", error);
    }
});
