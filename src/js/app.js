document.addEventListener('DOMContentLoaded', function() {
    eventListeners();
    darkMode();
})


function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navResponsive)
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
