import { gsap } from 'gsap';

document.addEventListener('DOMContentLoaded', () => {

    const wrapper = document.querySelector('.login-wrapper');
    const brand = document.querySelector('.login-brand');
    const formArea = document.querySelector('.login-form-area');

    const badge = document.querySelector('.brand-badge');
    const brandTitle = document.querySelector('.brand-title h1');
    const brandText = document.querySelector('.brand-title p');
    const brandFooter = document.querySelector('.brand-footer');

    const loginTitle = document.querySelector('.login-form-content h2');
    const loginSubtitle = document.querySelector('.login-subtitle');

    const fields = document.querySelectorAll('.login-field');
    const remember = document.querySelector('.login-remember');
    const button = document.querySelector('.btn-barber');
    const backHome = document.querySelector('.back-home');
    const alert = document.querySelector('.alert-barber');

    const inputs = document.querySelectorAll('.barber-input');

    /*
    |--------------------------------------------------------------------------
    | Respeta configuración de accesibilidad
    |--------------------------------------------------------------------------
    */

    const reduceMotion = window.matchMedia(
        '(prefers-reduced-motion: reduce)'
    ).matches;

    if (reduceMotion) {
        gsap.set([
            wrapper,
            brand,
            formArea,
            badge,
            brandTitle,
            brandText,
            brandFooter,
            loginTitle,
            loginSubtitle,
            fields,
            remember,
            button,
            backHome,
            alert
        ], {
            clearProps: 'all'
        });

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | ANIMACIÓN PRINCIPAL
    |--------------------------------------------------------------------------
    */

    const timeline = gsap.timeline({
        defaults: {
            ease: 'power3.out'
        }
    });


    /*
    |--------------------------------------------------------------------------
    | TARJETA COMPLETA
    |--------------------------------------------------------------------------
    */

    timeline.from(wrapper, {
        opacity: 0,
        scale: 0.97,
        y: 25,
        duration: 0.7
    });


    /*
    |--------------------------------------------------------------------------
    | PANEL IZQUIERDO
    |--------------------------------------------------------------------------
    */

    timeline.from(brand, {
        x: -45,
        opacity: 0,
        duration: 0.65
    }, '-=0.45');


    /*
    |--------------------------------------------------------------------------
    | PANEL DERECHO
    |--------------------------------------------------------------------------
    */

    timeline.from(formArea, {
        x: 45,
        opacity: 0,
        duration: 0.65
    }, '<');


    /*
    |--------------------------------------------------------------------------
    | CONTENIDO DE LA MARCA
    |--------------------------------------------------------------------------
    */

    timeline.from([
        badge,
        brandTitle,
        brandText
    ], {
        opacity: 0,
        y: 20,
        duration: 0.5,
        stagger: 0.10
    }, '-=0.30');


    /*
    |--------------------------------------------------------------------------
    | FOOTER IZQUIERDO
    |--------------------------------------------------------------------------
    */

    timeline.from(brandFooter, {
        opacity: 0,
        y: 10,
        duration: 0.4
    }, '-=0.20');


    /*
    |--------------------------------------------------------------------------
    | TÍTULO DEL LOGIN
    |--------------------------------------------------------------------------
    */

    timeline.from([
        loginTitle,
        loginSubtitle
    ], {
        opacity: 0,
        y: 15,
        duration: 0.45,
        stagger: 0.08
    }, '-=0.45');


    /*
    |--------------------------------------------------------------------------
    | CAMPOS
    |--------------------------------------------------------------------------
    */

    timeline.from(fields, {
        opacity: 0,
        y: 18,
        duration: 0.45,
        stagger: 0.10
    }, '-=0.25');


    /*
    |--------------------------------------------------------------------------
    | RECORDAR SESIÓN
    |--------------------------------------------------------------------------
    */

    timeline.from(remember, {
        opacity: 0,
        y: 10,
        duration: 0.35
    }, '-=0.20');


    /*
    |--------------------------------------------------------------------------
    | BOTÓN
    |--------------------------------------------------------------------------
    */

    timeline.from(button, {
        opacity: 0,
        y: 14,
        duration: 0.45
    }, '-=0.15');


    /*
    |--------------------------------------------------------------------------
    | VOLVER AL SITIO
    |--------------------------------------------------------------------------
    */

    timeline.from(backHome, {
        opacity: 0,
        y: 8,
        duration: 0.35
    }, '-=0.20');


    /*
    |--------------------------------------------------------------------------
    | ALERTA DE ERROR
    |--------------------------------------------------------------------------
    */

    if (alert) {

        gsap.from(alert, {
            opacity: 0,
            y: -10,
            duration: 0.35,
            delay: 0.35
        });

        gsap.fromTo(
            formArea,
            {
                x: -6
            },
            {
                x: 6,
                duration: 0.07,
                repeat: 5,
                yoyo: true,
                delay: 0.65,
                clearProps: 'x'
            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | INTERACCIÓN DE INPUTS
    |--------------------------------------------------------------------------
    */

    inputs.forEach(input => {

        input.addEventListener('focus', () => {

            gsap.to(input, {
                scale: 1.01,
                duration: 0.18,
                ease: 'power2.out'
            });

        });


        input.addEventListener('blur', () => {

            gsap.to(input, {
                scale: 1,
                duration: 0.18,
                ease: 'power2.out'
            });

        });

    });


    /*
    |--------------------------------------------------------------------------
    | INTERACCIÓN DEL BOTÓN
    |--------------------------------------------------------------------------
    */

    button?.addEventListener('mouseenter', () => {

        gsap.to(button, {
            scale: 1.015,
            duration: 0.18,
            ease: 'power2.out'
        });

    });


    button?.addEventListener('mouseleave', () => {

        gsap.to(button, {
            scale: 1,
            duration: 0.18,
            ease: 'power2.out'
        });

    });


    /*
    |--------------------------------------------------------------------------
    | CHECKBOX
    |--------------------------------------------------------------------------
    */

    const checkbox = document.getElementById('remember');

    checkbox?.addEventListener('change', () => {

        gsap.fromTo(
            checkbox,
            {
                scale: 0.8
            },
            {
                scale: 1,
                duration: 0.3,
                ease: 'back.out(2)'
            }
        );

    });

});
