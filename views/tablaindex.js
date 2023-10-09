document.addEventListener('DOMContentLoaded', () => {
    obtenerDatosVentas();
});

function obtenerDatosVentas() {
    fetch('obtenerDatosVentas.php')
        .then(response => response.json())
        .then(data => mostrarDatosVentas(data))
        .catch(error => console.error('Error:', error));
}

function mostrarDatosVentas(datos) {
    const reporteVentas = document.getElementById('reporteVentas');

    if (datos.length === 0) {
        reporteVentas.innerHTML = '<p>No hay datos de ventas disponibles.</p>';
        return;
    }

    let totalVentas = 0;

    let tablaHTML = '<table id="tablaReporte">';
    tablaHTML += '<tr><th>Código de Producto</th><th>Cantidad Vendida</th><th>Total Vendido</th><th>Fecha</th></tr>';

    datos.forEach(venta => {
        tablaHTML += `<tr><td>${venta.codigo_producto}</td><td>${venta.cantidadVendida}</td><td>$${venta.total_vendido}</td><td>${venta.fecha_venta}</td></tr>`;
        totalVentas += parseFloat(venta.total_vendido);
    });

    tablaHTML += `<tr><td colspan="2"><b>Total de Ventas:</b></td><td colspan="2"><b>$${totalVentas.toFixed(2)}</b></td></tr>`;
    tablaHTML += '</table>';
    
    reporteVentas.innerHTML = tablaHTML;
}


