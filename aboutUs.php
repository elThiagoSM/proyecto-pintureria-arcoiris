<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros</title>
    <link rel="stylesheet" href="css/aboutUsStyles.css">
</head>

<body>
    <?php include 'components/header.php'; ?>

    <div class="about-us">
        <button id="language-btn" class="language-btn" onclick="switchLanguage()">Switch to English</button>
        <div class="about-us-container">
            <div id="main-container">
                <h1 class="main-title" data-translate="title">PHAE DESARROLLO</h1>
                <div id="about-us">
                    <div class="about-us-text">
                        <p data-translate="intro">
                            PHAE es una empresa dedicada al desarrollo de software, la
                            renovación y automatización de procesos, con el objetivo de ayudar
                            a las empresas y emprendedores a optimizar su funcionamiento,
                            mejorar su competitividad y alcanzar sus objetivos de negocio.
                            Ofrecemos una amplia gama de servicios, incluyendo:
                        </p>
                        <div id="logo-container">
                            <img
                                src="assets/imgs/logoPHAE/Logo-Transparente-Negro.png"
                                alt="logo Phae" class="logo-img" />
                        </div>
                    </div>
                    <ul class="services-list">
                        <li class="service-item" data-translate="service1">
                            Desarrollo de software personalizado: Creamos soluciones de
                            software a medida que se adaptan a las necesidades específicas de
                            cada cliente, utilizando las últimas tecnologías y metodologías de
                            desarrollo.
                        </li>
                        <li class="service-item" data-translate="service2">
                            Renovación de sistemas informáticos: Actualizamos y modernizamos
                            los sistemas informáticos existentes para mejorar su rendimiento,
                            seguridad y eficiencia.
                        </li>
                        <li class="service-item" data-translate="service3">
                            Automatización de procesos: Diseñamos e implementamos soluciones
                            de automatización para optimizar procesos repetitivos, reducir
                            costos y aumentar la productividad.
                        </li>
                        <li class="service-item" data-translate="service4">
                            Consultoría en tecnología: Brindamos asesoría especializada a las
                            empresas para ayudarlas a identificar las soluciones tecnológicas
                            más adecuadas para sus necesidades y objetivos.
                        </li>
                    </ul>
                </div>
            </div>

            <div id="team-members">
                <h2 class="section-title team" data-translate="teamTitle">MIEMBROS</h2>
                <div class="members-container">
                    <div class="member">
                        <div class="member-photo">
                            <img
                                src="assets/imgs/nosotros/may-foto.png"
                                alt="Foto Feliciano May Moreira" />
                        </div>
                        <div class="member-info">
                            <h3>Feliciano May Moreira</h3>
                            <h4>felicianomay735@gmail.com</h4>
                        </div>
                    </div>
                    <div class="member">
                        <div class="member-photo">
                            <img
                                src="assets/imgs/nosotros/quintana-foto.png"
                                alt="Foto Sebastián Tabaré Quintana Ribeiro" />
                        </div>
                        <div class="member-info">
                            <h3>Sebastián Tabaré Quintana Ribeiro</h3>
                            <h4>tabaquintana@gmail.com</h4>
                        </div>
                    </div>
                    <div class="member">
                        <div class="member-photo">
                            <img
                                src="assets/imgs/nosotros/silveira-foto.png"
                                alt="Foto Thiago Silveira Machado" />
                        </div>
                        <div class="member-info">
                            <h3>Thiago Silveira Machado</h3>
                            <h4>thiagosm2019@gmail.com</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div id="contact-info">
                <h2 class="section-title contact" data-translate="contactTitle">DATOS DE CONTACTO</h2>
                <div class="contact-details">
                    <h4 data-translate="email">CORREO: phaedesarrollo@gmail.com</h4>
                    <h4 data-translate="address">DIRECCION: José Pedro Varela 441, 50000, Salto</h4>
                </div>
            </div>

            <div id="mission-vision">
                <h2 class="section-title mission-vision" data-translate="missionTitle">MISIÓN y VISIÓN DE LA EMPRESA</h2>
                <div class="mission">
                    <h3>Misión:</h3>
                    <p data-translate="mission">
                        Brindar soluciones innovadoras de software y de alta calidad que
                        satisfagan las necesidades específicas de nuestros clientes,
                        impulsando su crecimiento y optimizando sus procesos.
                    </p>
                </div>
                <div class="vision">
                    <h3>Visión:</h3>
                    <p data-translate="vision">
                        Ser la empresa líder en desarrollo de software, renovación y
                        automatización de procesos, reconocida por la calidad de sus
                        servicios, su enfoque personalizado y su compromiso con el éxito
                        de sus clientes.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php include 'components/footer.php'; ?>
    <script src="js/languageSwitcher.js"></script>
</body>

</html>