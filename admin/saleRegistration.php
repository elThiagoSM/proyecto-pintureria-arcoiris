<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Ventas</title>
    <link rel="stylesheet" href="./styles/saleRegistrationStyles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include './components/slidebar.php'; ?>

    <div class="sale-registration-container">
        <?php include './components/header.php'; ?>

        <div class="sale-registration-content">
            <h2>Gráfico de Ventas</h2>
            <canvas id="ventasChart" width="400" height="200"></canvas>

            <script>
                // Obtener los datos de ventas desde el archivo PHP
                fetch('codes/codeSaleRegistration.php')
                    .then(response => response.json())
                    .then(data => {
                        // Extraer fechas y valores de venta
                        const fechas = data.map(venta => venta.fecha);
                        const valores = data.map(venta => venta.valor);

                        // Configuración del gráfico
                        const ctx = document.getElementById('ventasChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: fechas,
                                datasets: [{
                                    label: 'Valor de Ventas',
                                    data: valores,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                    fill: true
                                }]
                            },
                            options: {
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Fecha'
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Valor de Venta ($)'
                                        },
                                        beginAtZero: true
                                    }
                                },
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top'
                                    },
                                    title: {
                                        display: true,
                                        text: 'Registro de Ventas'
                                    }
                                }
                            }
                        });
                    })
                    .catch(error => console.error('Error al cargar los datos:', error));
            </script>
        </div>
    </div>

</body>

</html>