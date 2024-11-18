<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./styles/dashboardStyles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php
    include './components/slidebar.php';
    include '../database/database.php'; // Conexión a la base de datos

    // Consultas para las métricas
    $totalClientes = $conn->query("SELECT COUNT(*) as total FROM clientes")->fetch_assoc()['total'];
    $ventasCompletadas = $conn->query("SELECT COUNT(*) as total FROM ventas WHERE estado = 'completado'")->fetch_assoc()['total'];
    $ingresosMes = $conn->query("
        SELECT SUM(valor_de_venta) as total 
        FROM ventas 
        WHERE MONTH(fecha_de_venta) = MONTH(CURRENT_DATE()) 
        AND estado = 'completado'
    ")->fetch_assoc()['total'];
    $ventasEnProceso = $conn->query("SELECT COUNT(*) as total FROM ventas WHERE estado = 'en proceso'")->fetch_assoc()['total'];

    // Consultas para los gráficos
    $ventasMensuales = $conn->query("
        SELECT MONTHNAME(fecha_de_venta) as mes, SUM(valor_de_venta) as total 
        FROM ventas 
        WHERE YEAR(fecha_de_venta) = YEAR(CURRENT_DATE()) 
        AND estado = 'completado'
        GROUP BY MONTH(fecha_de_venta)
        ORDER BY MONTH(fecha_de_venta)
    ");

    $pagos = $conn->query("
        SELECT forma_de_pago, COUNT(*) as total 
        FROM ventas 
        WHERE estado = 'completado'
        GROUP BY forma_de_pago
    ");

    // Preparar datos para JavaScript
    $meses = [];
    $totalesVentas = [];
    while ($row = $ventasMensuales->fetch_assoc()) {
        $meses[] = $row['mes'];
        $totalesVentas[] = $row['total'];
    }

    $formasPago = [];
    $pagosTotales = [];
    while ($row = $pagos->fetch_assoc()) {
        $formasPago[] = $row['forma_de_pago'];
        $pagosTotales[] = $row['total'];
    }
    ?>

    <div class="dashboard-container">
        <?php include './components/header.php'; ?>

        <div class="dashboard-content">
            <div class="stats-section">
                <div class="card">
                    <h3>Total de Clientes</h3>
                    <p><?php echo $totalClientes; ?></p>
                </div>
                <div class="card">
                    <h3>Ventas Completadas</h3>
                    <p><?php echo $ventasCompletadas; ?></p>
                </div>
                <div class="card">
                    <h3>Ingresos del Mes</h3>
                    <p>$<?php echo number_format($ingresosMes ?: 0, 2); ?></p>
                </div>
                <div class="card">
                    <h3>Ventas en Proceso</h3>
                    <p><?php echo $ventasEnProceso; ?></p>
                </div>
            </div>

            <div class="charts-section">
                <canvas id="lineChart"></canvas>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($meses); ?>,
                datasets: [{
                    label: 'Ventas Mensuales',
                    data: <?php echo json_encode($totalesVentas); ?>,
                    borderColor: '#4e7aff',
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });

        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($formasPago); ?>,
                datasets: [{
                    data: <?php echo json_encode($pagosTotales); ?>,
                    backgroundColor: ['#28a745', '#ffc107']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    </script>
</body>

</html>