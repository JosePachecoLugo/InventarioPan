<?php
include "../includes/header.php";
?>
<!-- Enlace a la biblioteca SheetJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

<!-- Función para generar el archivo Excel y descargarlo -->
<script>
    function generarReporteExcel() {
        const ws = XLSX.utils.table_to_sheet(document.getElementById('tablaReporte'));
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'ReporteVentas');
        XLSX.writeFile(wb, 'reporte_ventas.xlsx');
        // Limpiar la tabla en la base de datos
        limpiarTablaEnBD();
    
        // Limpiar la tabla en el HTML
        document.getElementById('reporteVentas').innerHTML = '';
    }

    function limpiarTablaEnBD() {
    fetch('limpiarTabla.php')
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
    }
</script>

<link rel="stylesheet" href="tablaindex.css">
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="generarReporteExcel()"><i class="fas fa-download fa-sm text-white-50"></i> Generar reporte del dìa</a>
    </div>


    <!-- Content Row -->
    
    <div id="reporteVentas"></div>

    <script src="tablaindex.js"></script>

</div>
</div>

<!-- End of Main Content -->
<?php include "../includes/footer.php";
?>