document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    darkMode();
})


function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navResponsive);

    //Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input=>input.addEventListener('click',mostrarMetodosContacto));

    const menuActual = window.location.pathname;

    resaltarNav(menuActual);
}

function mostrarMetodosContacto(e){
    const contactoDiv = document.querySelector('#contacto');

    if (e.target.value==='telefono') {
        contactoDiv.innerHTML=`
        <label for="telefono">Número de teléfono</label>
        <input type="tel" placeholder="Tu teléfono" id="telefono" name="contacto[telefono]">
        
        <p>Elija la fecha y hora para ser contactado</p>

        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="Hora">Hora</label>
        <input type="time" id="Hora" min="09:00" max="18:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML=`
        <label for="email">E-mail</label>
        <input type="email" placeholder="Tu email" id="email" name="contacto[email]" required>
        `;
    }
}

function navResponsive() {
    const navegacion = document.querySelector('.navegacion');

    //If para agregar la class mostrar en el nav, así modificar luego su display
    if (navegacion.classList.contains('mostrar')) {

        navegacion.classList.remove('mostrar');

    }else{

        navegacion.classList.add('mostrar');
    }
}


function darkMode() {
    const preferencia = window.matchMedia('(prefers-color-scheme: dark)');

    if (preferencia.matches) {
        document.body.classList.add('dark-mode')
    }else{
        document.body.classList.remove('dark-mode')
    }

    preferencia.addEventListener('change', function () {
        if (preferencia.matches) {
            document.body.classList.add('dark-mode')
        }else{
            document.body.classList.remove('dark-mode')
        }
    })

    const btnDarkMode = document.querySelector('.dark-mode-btn');

    btnDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode')
    })
}

function resaltarNav(e){
    const navegacion = document.querySelector('.navegacion');
    switch (e) {
        case '/nosotros':
            navegacion.querySelector('.nosotros').classList.add('green');
            break;
        case '/propiedades':
            navegacion.querySelector('.propiedades').classList.add('green');
            break;
        case '/blog':
            navegacion.querySelector('.blog').classList.add('green');
            break;
        case '/contacto':
            navegacion.querySelector('.contacto').classList.add('green');
            break;
        case '/login':
            navegacion.querySelector('.login').classList.add('green');
            break;
        default:
            break;
    }
}
