import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const navbar = document.getElementById('navbar');
const menu = document.getElementById('landingMenu');
const menuToggle = document.getElementById('menuToggle');

window.addEventListener('scroll', () => {
    navbar?.classList.toggle('scrolled', window.scrollY > 40);
});

menuToggle?.addEventListener('click', () => menu?.classList.toggle('show'));

document.querySelectorAll('.landing-menu a').forEach(link => {
    link.addEventListener('click', () => menu?.classList.remove('show'));
});

gsap.from('.hero-title span', {
    y: 100,
    opacity: 0,
    duration: 1,
    stagger: .12,
    ease: 'power4.out'
});

gsap.from('.hero .reveal', {
    y: 30,
    opacity: 0,
    duration: .8,
    stagger: .15,
    delay: .4,
    ease: 'power3.out'
});

gsap.utils.toArray('.service-card').forEach((card, index) => {
    gsap.from(card, {
        scrollTrigger: { trigger: card, start: 'top 88%' },
        y: 60,
        opacity: 0,
        duration: .7,
        delay: index * .05,
        ease: 'power3.out'
    });
});

gsap.utils.toArray(
    '.section-header, .experience-content, .booking-info, .booking-form-wrapper, .contact-grid'
).forEach(element => {
    gsap.from(element, {
        scrollTrigger: { trigger: element, start: 'top 85%' },
        y: 45,
        opacity: 0,
        duration: .8,
        ease: 'power3.out'
    });
});

const fechaInput = document.getElementById('fecha');
const horaInput = document.getElementById('hora');
const horariosContainer = document.getElementById('horariosDisponibles');
const botonReservar = document.getElementById('botonReservar');

let peticionActual = null;

const actualizarBoton = () => {
    if (botonReservar) botonReservar.disabled = !horaInput?.value;
};

async function cargarHorarios(fecha, horaAnterior = '') {
    if (!fecha || !horariosContainer || !horaInput) return;

    peticionActual?.abort();
    peticionActual = new AbortController();

    horaInput.value = '';
    actualizarBoton();

    horariosContainer.classList.add('loading');
    horariosContainer.innerHTML = '<span class="horarios-mensaje">Consultando horarios...</span>';

    try {
        const url = horariosContainer.dataset.url || '/horarios-disponibles';
        const response = await fetch(`${url}?fecha=${encodeURIComponent(fecha)}`, {
            signal: peticionActual.signal,
            headers: { 'Accept': 'application/json' }
        });

        if (!response.ok) throw new Error('No fue posible consultar los horarios.');

        const data = await response.json();
        const horarios = data.horarios ?? [];

        if (!horarios.length) {
            horariosContainer.innerHTML = '<span class="horarios-mensaje">No hay horarios disponibles para esta fecha.</span>';
            return;
        }

        horariosContainer.innerHTML = '';

        horarios.forEach(horario => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'horario-btn';
            button.textContent = horario.texto;
            button.dataset.hora = horario.valor;

            if (horario.valor === horaAnterior) {
                button.classList.add('selected');
                horaInput.value = horario.valor;
            }

            button.addEventListener('click', () => {
                horariosContainer.querySelectorAll('.horario-btn')
                    .forEach(btn => btn.classList.remove('selected'));

                button.classList.add('selected');
                horaInput.value = horario.valor;
                actualizarBoton();
            });

            horariosContainer.appendChild(button);
        });

        actualizarBoton();

    } catch (error) {
        if (error.name !== 'AbortError') {
            horariosContainer.innerHTML = '<span class="horarios-mensaje">No fue posible consultar los horarios.</span>';
        }
    } finally {
        horariosContainer.classList.remove('loading');
    }
}

fechaInput?.addEventListener('change', () => cargarHorarios(fechaInput.value));

if (fechaInput?.value) {
    cargarHorarios(fechaInput.value, horaInput?.value || '');
}

actualizarBoton();
