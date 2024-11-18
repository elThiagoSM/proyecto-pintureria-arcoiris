const translations = {
  es: {
    title: "PHAE DESARROLLO",
    intro: `PHAE es una empresa dedicada al desarrollo de software, la renovación y automatización de procesos, con el objetivo de ayudar a las empresas y emprendedores a optimizar su funcionamiento, mejorar su competitividad y alcanzar sus objetivos de negocio.`,
    service1:
      "Desarrollo de software personalizado: Creamos soluciones de software a medida que se adaptan a las necesidades específicas de cada cliente, utilizando las últimas tecnologías y metodologías de desarrollo.",
    service2:
      "Renovación de sistemas informáticos: Actualizamos y modernizamos los sistemas informáticos existentes para mejorar su rendimiento, seguridad y eficiencia.",
    service3:
      "Automatización de procesos: Diseñamos e implementamos soluciones de automatización para optimizar procesos repetitivos, reducir costos y aumentar la productividad.",
    service4:
      "Consultoría en tecnología: Brindamos asesoría especializada a las empresas para ayudarlas a identificar las soluciones tecnológicas más adecuadas para sus necesidades y objetivos.",
    teamTitle: "MIEMBROS",
    contactTitle: "DATOS DE CONTACTO",
    email: "CORREO: phaedesarrollo@gmail.com",
    address: "DIRECCION: José Pedro Varela 441, 50000, Salto",
    missionTitle: "MISIÓN y VISIÓN DE LA EMPRESA",
    mission:
      "Brindar soluciones innovadoras de software y de alta calidad que satisfagan las necesidades específicas de nuestros clientes, impulsando su crecimiento y optimizando sus procesos.",
    vision:
      "Ser la empresa líder en desarrollo de software, renovación y automatización de procesos, reconocida por la calidad de sus servicios, su enfoque personalizado y su compromiso con el éxito de sus clientes.",
  },
  en: {
    title: "PHAE DEVELOPMENT",
    intro: `PHAE is a company dedicated to software development, process renewal, and automation, aiming to help businesses and entrepreneurs optimize their operations, improve competitiveness, and achieve business goals.`,
    service1:
      "Custom software development: We create tailored software solutions adapted to the specific needs of each client, using the latest technologies and development methodologies.",
    service2:
      "IT system upgrades: We update and modernize existing IT systems to improve their performance, security, and efficiency.",
    service3:
      "Process automation: We design and implement automation solutions to optimize repetitive processes, reduce costs, and increase productivity.",
    service4:
      "Technology consulting: We provide specialized advice to companies to help them identify the most suitable technological solutions for their needs and goals.",
    teamTitle: "TEAM MEMBERS",
    contactTitle: "CONTACT INFORMATION",
    email: "EMAIL: phaedevelopment@gmail.com",
    address: "ADDRESS: José Pedro Varela 441, 50000, Salto",
    missionTitle: "COMPANY MISSION AND VISION",
    mission:
      "To provide innovative, high-quality software solutions that meet our clients' specific needs, driving their growth and optimizing their processes.",
    vision:
      "To be the leading company in software development, renewal, and process automation, recognized for the quality of its services, personalized approach, and commitment to the success of its clients.",
  },
};

function switchLanguage() {
  const lang = document.documentElement.lang === "es" ? "en" : "es";
  document.documentElement.lang = lang;

  document.querySelectorAll("[data-translate]").forEach((el) => {
    const key = el.getAttribute("data-translate");
    el.textContent = translations[lang][key];
  });

  document.getElementById("language-btn").textContent =
    lang === "es" ? "Switch to English" : "Cambiar a Español";
}
