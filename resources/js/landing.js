import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);


/* =========================================================
   ELEMENTOS GENERALES
========================================================= */

const navbar = document.getElementById('navbar');
const menu = document.getElementById('landingMenu');
const menuToggle = document.getElementById('menuToggle');

const reducirMovimiento = window.matchMedia(
    '(prefers-reduced-motion: reduce)'
).matches;

const dispositivoTactil = window.matchMedia(
    '(hover: none) and (pointer: coarse)'
).matches;

const tieneMouse = window.matchMedia(
    '(hover: hover) and (pointer: fine)'
).matches;

const esMovil = () => window.innerWidth <= 768;


/* =========================================================
   NAVBAR
========================================================= */

const actualizarNavbar = () => {

    navbar?.classList.toggle(
        'scrolled',
        window.scrollY > 40
    );

};

window.addEventListener(
    'scroll',
    actualizarNavbar,
    { passive: true }
);

actualizarNavbar();


/* =========================================================
   MENÚ MÓVIL
========================================================= */

const abrirMenu = () => {

    if (!menu) return;

    menu.classList.add('show');

    document.body.style.overflow = 'hidden';

    menuToggle?.setAttribute(
        'aria-expanded',
        'true'
    );


    if (
        reducirMovimiento ||
        window.innerWidth > 992
    ) {
        return;
    }


    const enlaces = menu.querySelectorAll('a');


    gsap.killTweensOf(enlaces);

    gsap.fromTo(
        enlaces,
        {
            opacity: 0,
            y: 12
        },
        {
            opacity: 1,
            y: 0,
            duration: .35,
            stagger: .05,
            ease: 'power2.out',
            clearProps: 'transform'
        }
    );

};


const cerrarMenu = () => {

    if (!menu) return;

    menu.classList.remove('show');

    document.body.style.overflow = '';

    menuToggle?.setAttribute(
        'aria-expanded',
        'false'
    );

};


const alternarMenu = () => {

    if (!menu) return;

    const abierto = menu.classList.contains('show');

    if (abierto) {
        cerrarMenu();
    } else {
        abrirMenu();
    }

};


menuToggle?.setAttribute(
    'aria-expanded',
    'false'
);


menuToggle?.addEventListener(
    'click',
    alternarMenu
);


/* =========================================================
   CERRAR MENÚ AL SELECCIONAR OPCIÓN
========================================================= */

document
    .querySelectorAll('.landing-menu a')
    .forEach(link => {

        link.addEventListener('click', () => {

            cerrarMenu();

        });

    });


/* =========================================================
   CERRAR MENÚ CON ESC
========================================================= */

document.addEventListener('keydown', event => {

    if (
        event.key === 'Escape' &&
        menu?.classList.contains('show')
    ) {

        cerrarMenu();

        menuToggle?.focus();

    }

});


/* =========================================================
   CERRAR MENÚ AL REGRESAR A ESCRITORIO
========================================================= */

window.addEventListener('resize', () => {

    if (window.innerWidth > 992) {
        cerrarMenu();
    }

});


/* =========================================================
   ANIMACIONES
========================================================= */

if (!reducirMovimiento) {

    iniciarAnimaciones();

}


/* =========================================================
   INICIO DE ANIMACIONES
========================================================= */

function iniciarAnimaciones() {

    animarNavbar();
    animarHero();
    animarMarquee();
    animarServicios();
    animarExperiencia();
    animarReservacion();
    animarContacto();
    animarFooter();

    if (tieneMouse) {

        animarBotones();
        animarTarjetasServicio();

    }

    animarHeroConScroll();

}


/* =========================================================
   NAVBAR - ENTRADA
========================================================= */

function animarNavbar() {

    if (!navbar) return;


    gsap.from(navbar, {

        y: -35,
        opacity: 0,

        duration: .8,

        ease: 'power3.out',

        clearProps: 'transform'

    });

}


/* =========================================================
   HERO
========================================================= */

function animarHero() {

    const hero = document.querySelector('#inicio');

    if (!hero) return;


    const timeline = gsap.timeline({

        defaults: {
            ease: 'power4.out'
        }

    });


    /* Eyebrow */

    timeline.from(
        '.hero-eyebrow',
        {
            y: 20,
            opacity: 0,
            duration: .65
        },
        .2
    );


    /* Título */

    timeline.from(
        '.hero-title span',
        {
            y: esMovil() ? 55 : 90,
            opacity: 0,

            duration: esMovil()
                ? .75
                : .9,

            stagger: .11,

            ease: 'power4.out'
        },
        .3
    );


    /* Descripción */

    timeline.from(
        '.hero-description',
        {
            y: 25,
            opacity: 0,

            duration: .65
        },
        .72
    );


    /* Botones */

    timeline.from(
        '.hero-actions > *',
        {
            y: 20,
            opacity: 0,

            duration: .55,
            stagger: .1
        },
        .82
    );

}


/* =========================================================
   HERO - EFECTO DE SCROLL SOLO EN ESCRITORIO
========================================================= */

function animarHeroConScroll() {

    if (esMovil()) return;


    const heroContent =
        document.querySelector('.hero-content');

    const hero =
        document.querySelector('#inicio');


    if (!heroContent || !hero) return;


    gsap.to(heroContent, {

        y: 65,
        opacity: .45,

        ease: 'none',

        scrollTrigger: {

            trigger: hero,

            start: 'top top',

            end: 'bottom top',

            scrub: 1.2

        }

    });

}


/* =========================================================
   MARQUEE
========================================================= */

function animarMarquee() {

    const marquee =
        document.querySelector('.marquee-section');


    if (!marquee) return;


    gsap.from(marquee, {

        opacity: 0,

        duration: .8,

        ease: 'power2.out',

        scrollTrigger: {

            trigger: marquee,

            start: 'top 95%',

            once: true

        }

    });

}


/* =========================================================
   SERVICIOS
========================================================= */

function animarServicios() {

    const section =
        document.querySelector('#servicios');


    if (!section) return;


    /* Número y etiqueta */

    gsap.from(
        '#servicios .section-header > div:first-child',
        {

            x: esMovil() ? 0 : -35,
            y: esMovil() ? 25 : 0,

            opacity: 0,

            duration: .75,

            ease: 'power3.out',

            scrollTrigger: {

                trigger:
                    '#servicios .section-header',

                start: 'top 86%',

                once: true

            }

        }
    );


    /* Título */

    gsap.from(
        '#servicios .section-header > div:last-child',
        {

            y: 40,

            opacity: 0,

            duration: .8,

            ease: 'power3.out',

            scrollTrigger: {

                trigger:
                    '#servicios .section-header',

                start: 'top 86%',

                once: true

            }

        }
    );


    /* Tarjetas */

    const cards =
        document.querySelectorAll(
            '#servicios .service-card'
        );


    if (!cards.length) return;


    gsap.from(cards, {

        y: esMovil() ? 40 : 60,

        opacity: 0,

        scale: esMovil()
            ? .985
            : .97,

        duration: .7,

        stagger: esMovil()
            ? .08
            : .12,

        ease: 'power3.out',

        scrollTrigger: {

            trigger:
                '#servicios .services-grid',

            start: 'top 88%',

            once: true

        }

    });

}


/* =========================================================
   TARJETAS - HOVER SOLO CON MOUSE
========================================================= */

function animarTarjetasServicio() {

    document
        .querySelectorAll('.service-card')
        .forEach(card => {

            const imagen =
                card.querySelector(
                    '.service-image img'
                );

            const precio =
                card.querySelector(
                    '.service-price'
                );

            const flecha =
                card.querySelector(
                    '.service-arrow'
                );


            card.addEventListener(
                'mouseenter',
                () => {

                    gsap.to(card, {

                        y: -8,

                        duration: .3,

                        ease: 'power2.out'

                    });


                    if (imagen) {

                        gsap.to(imagen, {

                            scale: 1.065,

                            duration: .55,

                            ease: 'power3.out'

                        });

                    }


                    if (precio) {

                        gsap.to(precio, {

                            y: -4,

                            duration: .3,

                            ease: 'power2.out'

                        });

                    }


                    if (flecha) {

                        gsap.to(flecha, {

                            x: 5,

                            duration: .25,

                            ease: 'power2.out'

                        });

                    }

                }
            );


            card.addEventListener(
                'mouseleave',
                () => {

                    gsap.to(card, {

                        y: 0,

                        duration: .3,

                        ease: 'power2.out'

                    });


                    if (imagen) {

                        gsap.to(imagen, {

                            scale: 1,

                            duration: .55,

                            ease: 'power3.out'

                        });

                    }


                    if (precio) {

                        gsap.to(precio, {

                            y: 0,

                            duration: .3,

                            ease: 'power2.out'

                        });

                    }


                    if (flecha) {

                        gsap.to(flecha, {

                            x: 0,

                            duration: .25,

                            ease: 'power2.out'

                        });

                    }

                }
            );

        });

}


/* =========================================================
   EXPERIENCIA
========================================================= */

function animarExperiencia() {

    const section =
        document.querySelector(
            '.experience-section'
        );


    if (!section) return;


    const timeline =
        gsap.timeline({

            scrollTrigger: {

                trigger: section,

                start: 'top 82%',

                once: true

            }

        });


    timeline.from(
        '.experience-number',
        {

            x: esMovil() ? 0 : -35,

            y: esMovil() ? 20 : 0,

            opacity: 0,

            duration: .7,

            ease: 'power3.out'

        }
    );


    timeline.from(
        '.experience-content .section-eyebrow',
        {

            y: 15,

            opacity: 0,

            duration: .4

        },
        '-=.45'
    );


    timeline.from(
        '.experience-content h2',
        {

            y: 40,

            opacity: 0,

            duration: .75,

            ease: 'power3.out'

        },
        '-=.25'
    );


    timeline.from(
        '.experience-content p',
        {

            y: 25,

            opacity: 0,

            duration: .6

        },
        '-=.4'
    );


    timeline.fromTo(
        '.experience-line',
        {

            scaleX: 0,

            transformOrigin: 'left center'

        },
        {

            scaleX: 1,

            duration: .9,

            ease: 'power3.inOut'

        },
        '-=.25'
    );


    timeline.from(
        '.experience-quote',
        {

            x: esMovil() ? 0 : 40,

            y: esMovil() ? 25 : 0,

            opacity: 0,

            duration: .7,

            ease: 'power3.out'

        },
        '-=.6'
    );

}


/* =========================================================
   RESERVACIÓN
========================================================= */

function animarReservacion() {

    const section =
        document.querySelector(
            '.booking-section'
        );


    if (!section) return;


    /* Información */

    gsap.from(
        '.booking-info',
        {

            x: esMovil() ? 0 : -45,

            y: esMovil() ? 35 : 0,

            opacity: 0,

            duration: .8,

            ease: 'power3.out',

            scrollTrigger: {

                trigger: section,

                start: 'top 82%',

                once: true

            }

        }
    );


    /* Formulario */

    gsap.from(
        '.booking-form-wrapper',
        {

            x: esMovil() ? 0 : 45,

            y: esMovil() ? 35 : 0,

            opacity: 0,

            duration: .8,

            ease: 'power3.out',

            scrollTrigger: {

                trigger:
                    '.booking-form-wrapper',

                start: 'top 88%',

                once: true

            }

        }
    );


    /* Campos */

    gsap.from(
        '.booking-form .form-premium',
        {

            y: 22,

            opacity: 0,

            duration: .48,

            stagger: esMovil()
                ? .06
                : .09,

            ease: 'power2.out',

            scrollTrigger: {

                trigger:
                    '.booking-form',

                start: 'top 90%',

                once: true

            }

        }
    );


    /* Botón */

    gsap.from(
        '.booking-button',
        {

            y: 18,

            opacity: 0,

            duration: .5,

            ease: 'power2.out',

            scrollTrigger: {

                trigger:
                    '.booking-button',

                start: 'top 95%',

                once: true

            }

        }
    );

}


/* =========================================================
   CONTACTO
========================================================= */

function animarContacto() {

    const section =
        document.querySelector(
            '.contact-section'
        );


    if (!section) return;


    gsap.from(
        '.contact-grid > div',
        {

            y: 40,

            opacity: 0,

            duration: .7,

            stagger: esMovil()
                ? .08
                : .13,

            ease: 'power3.out',

            scrollTrigger: {

                trigger: section,

                start: 'top 84%',

                once: true

            }

        }
    );


    /* Datos */

    const contactoItems =
        document.querySelectorAll(
            '.contact-item'
        );


    if (contactoItems.length) {

        gsap.from(
            contactoItems,
            {

                x: esMovil() ? 0 : 20,

                y: esMovil() ? 15 : 0,

                opacity: 0,

                duration: .45,

                stagger: .07,

                ease: 'power2.out',

                scrollTrigger: {

                    trigger:
                        '.contact-details',

                    start: 'top 88%',

                    once: true

                }

            }
        );

    }


    /* Horarios */

    const horarios =
        document.querySelectorAll(
            '.schedule-row'
        );


    if (horarios.length) {

        gsap.from(
            horarios,
            {

                x: esMovil() ? 0 : 20,

                y: esMovil() ? 12 : 0,

                opacity: 0,

                duration: .42,

                stagger: .055,

                ease: 'power2.out',

                scrollTrigger: {

                    trigger: '.schedule',

                    start: 'top 88%',

                    once: true

                }

            }
        );

    }

}


/* =========================================================
   FOOTER
========================================================= */

function animarFooter() {

    const footer =
        document.querySelector(
            '.landing-footer'
        );


    if (!footer) return;


    gsap.from(
        footer,
        {

            y: 30,

            opacity: 0,

            duration: .75,

            ease: 'power3.out',

            scrollTrigger: {

                trigger: footer,

                start: 'top 94%',

                once: true

            }

        }
    );


    const redes =
        document.querySelectorAll(
            '.footer-social a'
        );


    if (!redes.length) return;


    gsap.from(
        redes,
        {

            y: 10,

            opacity: 0,

            duration: .4,

            stagger: .06,

            ease: 'power2.out',

            scrollTrigger: {

                trigger: footer,

                start: 'top 92%',

                once: true

            }

        }
    );

}


/* =========================================================
   BOTONES - HOVER SOLO EN COMPUTADORA
========================================================= */

function animarBotones() {

    document
        .querySelectorAll(
            '.btn-premium, .btn-ghost, .nav-reservar'
        )
        .forEach(button => {

            button.addEventListener(
                'mouseenter',
                () => {

                    gsap.to(button, {

                        y: -3,

                        duration: .2,

                        ease: 'power2.out'

                    });

                }
            );


            button.addEventListener(
                'mouseleave',
                () => {

                    gsap.to(button, {

                        y: 0,

                        duration: .2,

                        ease: 'power2.out'

                    });

                }
            );

        });

}


/* =========================================================
   FORMULARIO DE CITAS
========================================================= */

const fechaInput =
    document.getElementById('fecha');

const horaInput =
    document.getElementById('hora');

const horariosContainer =
    document.getElementById(
        'horariosDisponibles'
    );

const botonReservar =
    document.getElementById(
        'botonReservar'
    );

let peticionActual = null;


/* =========================================================
   ESTADO DEL BOTÓN
========================================================= */

const actualizarBoton = () => {

    if (!botonReservar) return;

    botonReservar.disabled =
        !horaInput?.value;

};


/* =========================================================
   CARGAR HORARIOS
========================================================= */

async function cargarHorarios(
    fecha,
    horaAnterior = ''
) {

    if (
        !fecha ||
        !horariosContainer ||
        !horaInput
    ) {
        return;
    }


    /* Cancelar consulta anterior */

    peticionActual?.abort();

    peticionActual =
        new AbortController();


    /* Reiniciar selección */

    horaInput.value = '';

    actualizarBoton();


    horariosContainer.classList.add(
        'loading'
    );


    horariosContainer.innerHTML = `
        <span class="horarios-mensaje">
            Consultando horarios...
        </span>
    `;


    try {

        const url =
            horariosContainer.dataset.url ||
            '/horarios-disponibles';


        const response =
            await fetch(
                `${url}?fecha=${encodeURIComponent(fecha)}`,
                {

                    signal:
                    peticionActual.signal,

                    headers: {
                        'Accept':
                            'application/json'
                    }

                }
            );


        if (!response.ok) {

            throw new Error(
                'No fue posible consultar los horarios.'
            );

        }


        const data =
            await response.json();


        const horarios =
            data.horarios ?? [];


        /* Sin horarios */

        if (!horarios.length) {

            horariosContainer.innerHTML = `
                <span class="horarios-mensaje">
                    No hay horarios disponibles para esta fecha.
                </span>
            `;

            return;

        }


        horariosContainer.innerHTML = '';


        /* Crear botones */

        horarios.forEach(
            (horario, index) => {

                const button =
                    document.createElement(
                        'button'
                    );


                button.type = 'button';

                button.className =
                    'horario-btn';

                button.textContent =
                    horario.texto;

                button.dataset.hora =
                    horario.valor;


                /* Restaurar valor anterior */

                if (
                    horario.valor ===
                    horaAnterior
                ) {

                    button.classList.add(
                        'selected'
                    );

                    horaInput.value =
                        horario.valor;

                }


                /* Seleccionar */

                button.addEventListener(
                    'click',
                    () => {

                        horariosContainer
                            .querySelectorAll(
                                '.horario-btn'
                            )
                            .forEach(btn => {

                                btn.classList.remove(
                                    'selected'
                                );

                            });


                        button.classList.add(
                            'selected'
                        );


                        horaInput.value =
                            horario.valor;


                        actualizarBoton();


                        /* Animación táctil */

                        if (!reducirMovimiento) {

                            gsap.fromTo(
                                button,
                                {
                                    scale: .94
                                },
                                {
                                    scale: 1,
                                    duration: .28,
                                    ease: 'back.out(2)'
                                }
                            );

                        }

                    }
                );


                horariosContainer
                    .appendChild(button);


                /* Entrada */

                if (!reducirMovimiento) {

                    gsap.from(
                        button,
                        {

                            opacity: 0,

                            y: 10,

                            duration: .28,

                            delay:
                                index * .03,

                            ease: 'power2.out'

                        }
                    );

                }

            }
        );


        actualizarBoton();

    }

    catch (error) {

        if (
            error.name !==
            'AbortError'
        ) {

            horariosContainer.innerHTML = `
                <span class="horarios-mensaje">
                    No fue posible consultar los horarios.
                </span>
            `;

        }

    }

    finally {

        horariosContainer.classList.remove(
            'loading'
        );

    }

}


/* =========================================================
   CAMBIO DE FECHA
========================================================= */

fechaInput?.addEventListener(
    'change',
    () => {

        cargarHorarios(
            fechaInput.value
        );

    }
);


/* =========================================================
   RECUPERAR FECHA/HORA DESPUÉS DE VALIDACIÓN
========================================================= */

if (fechaInput?.value) {

    cargarHorarios(

        fechaInput.value,

        horaInput?.value || ''

    );

}


/* =========================================================
   ESTADO INICIAL
========================================================= */

actualizarBoton();


/* =========================================================
   REAJUSTAR SCROLLTRIGGER
========================================================= */

window.addEventListener('load', () => {

    ScrollTrigger.refresh();

});


/* =========================================================
   CAMBIO DE ORIENTACIÓN
========================================================= */

window.addEventListener(
    'orientationchange',
    () => {

        cerrarMenu();


        setTimeout(() => {

            ScrollTrigger.refresh();

        }, 300);

    }
);
