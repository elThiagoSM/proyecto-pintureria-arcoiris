<?php
// Verificar si las cookies están configuradas y si el usuario es un administrador
if (!isset($_COOKIE['id_usuario']) || $_COOKIE['clasificacion'] !== 'Administrador') {
    // Si no es administrador o no está autenticado, redirigir al inicio de sesión
    header("Location: loginAdmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="./styles/userRegistrationStyles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include './components/slidebar.php'; ?>

    <div class="user-registration-container">
        <?php include './components/header.php'; ?>

        <div class="user-registration-content">
            <h2>Gráfico de Usuarios Registrados</h2>
            <canvas id="usuariosChart" width="400" height="200"></canvas>

            <script>
                // Obtener los datos de usuarios desde el archivo PHP
                fetch('./codes/loadUserRegistration.php')
                    .then(response => response.json())
                    .then(data => {
                        // Extraer fechas y conteos de usuarios por clasificación
                        const fechas = data.map(usuario => usuario.fecha);
                        const conteoClientes = data.map(usuario => usuario.cliente);
                        const conteoAdministradores = data.map(usuario => usuario.administrador);

                        // Configuración del gráfico
                        const ctx = document.getElementById('usuariosChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: fechas,
                                datasets: [{
                                        label: 'Clientes Registrados',
                                        data: conteoClientes,
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        borderWidth: 1,
                                        fill: true
                                    },
                                    {
                                        label: 'Administradores Registrados',
                                        data: conteoAdministradores,
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        borderColor: 'rgba(255, 99, 132, 1)',
                                        borderWidth: 1,
                                        fill: true
                                    }
                                ]
                            },
                            options: {
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Fecha de Registro'
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Cantidad de Usuarios'
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
                                        text: 'Registro de Usuarios por Clasificación'
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