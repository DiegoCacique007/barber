document.addEventListener('DOMContentLoaded', () => {

    const boton = document.getElementById('activarNotificacionesPush');

    if (!boton) {
        return;
    }

    /* PRUEBA TEMPORAL PARA ANDROID */
    boton.textContent = 'Activar avisos · JS OK';

    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content');

    const vapidPublicKey = document
        .querySelector('meta[name="vapid-public-key"]')
        ?.getAttribute('content');

    const subscribeUrl = boton.dataset.subscribeUrl;


    const base64ToUint8Array = (base64String) => {

        const padding = '='.repeat(
            (4 - base64String.length % 4) % 4
        );

        const base64 = (base64String + padding)
            .replace(/-/g, '+')
            .replace(/_/g, '/');

        const rawData = window.atob(base64);

        return Uint8Array.from(
            [...rawData].map(char => char.charCodeAt(0))
        );
    };


    const texto = (mensaje) => {
        boton.textContent = mensaje;
    };


    const errorVisible = (titulo, error) => {

        console.error(titulo, error);

        const detalle =
            error?.message ??
            error?.name ??
            String(error);

        alert(
            titulo +
            '\n\n' +
            detalle
        );
    };


    const comprobarCompatibilidad = () => {

        if (!window.isSecureContext) {
            throw new Error(
                'La página no está siendo reconocida como HTTPS seguro.'
            );
        }

        if (!('serviceWorker' in navigator)) {
            throw new Error(
                'Este navegador no tiene soporte para Service Worker.'
            );
        }

        if (!('PushManager' in window)) {
            throw new Error(
                'Este navegador no tiene soporte para PushManager.'
            );
        }

        if (!('Notification' in window)) {
            throw new Error(
                'Este navegador no tiene soporte para notificaciones.'
            );
        }

        if (!vapidPublicKey) {
            throw new Error(
                'No se encontró la llave pública VAPID.'
            );
        }

        if (!subscribeUrl) {
            throw new Error(
                'No se encontró la URL para registrar el dispositivo.'
            );
        }
    };


    const guardarEnLaravel = async (subscription) => {

        texto('Guardando...');

        const json = subscription.toJSON();

        const contentEncoding =
            PushManager.supportedContentEncodings?.includes('aes128gcm')
                ? 'aes128gcm'
                : 'aesgcm';

        const response = await fetch(subscribeUrl, {

            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf,
            },

            credentials: 'same-origin',

            body: JSON.stringify({

                endpoint: subscription.endpoint,

                keys: {
                    p256dh: json.keys?.p256dh,
                    auth: json.keys?.auth,
                },

                contentEncoding: contentEncoding,
            }),
        });


        if (!response.ok) {

            const respuesta = await response.text();

            throw new Error(
                `Laravel respondió ${response.status}: ${respuesta}`
            );
        }

        return response.json();
    };


    const activar = async () => {

        try {

            comprobarCompatibilidad();

            boton.disabled = true;

            texto('Solicitando permiso...');


            let permiso = Notification.permission;

            if (permiso === 'default') {

                permiso =
                    await Notification.requestPermission();
            }


            if (permiso !== 'granted') {

                throw new Error(
                    `Permiso de notificaciones: ${permiso}`
                );
            }


            texto('Preparando servicio...');


            const registration =
                await navigator.serviceWorker.register(
                    '/service-worker.js',
                    {
                        scope: '/',
                    }
                );


            await navigator.serviceWorker.ready;


            texto('Registrando celular...');


            let subscription =
                await registration
                    .pushManager
                    .getSubscription();


            if (!subscription) {

                subscription =
                    await registration
                        .pushManager
                        .subscribe({

                            userVisibleOnly: true,

                            applicationServerKey:
                                base64ToUint8Array(
                                    vapidPublicKey
                                ),
                        });
            }


            await guardarEnLaravel(subscription);


            boton.classList.add('push-enabled');

            texto('✓ Avisos activados');

            boton.disabled = true;


        } catch (error) {

            boton.disabled = false;

            texto('Activar avisos');

            errorVisible(
                'No fue posible activar las notificaciones.',
                error
            );
        }
    };


    const comprobar = async () => {

        try {

            comprobarCompatibilidad();


            if (Notification.permission === 'denied') {

                texto('Avisos bloqueados');

                return;
            }


            const registration =
                await navigator.serviceWorker
                    .getRegistration();


            if (!registration) {
                return;
            }


            const subscription =
                await registration
                    .pushManager
                    .getSubscription();


            if (subscription) {

                boton.classList.add('push-enabled');

                texto('✓ Avisos activados');

                boton.disabled = true;
            }

        } catch (error) {

            console.error(
                'Comprobación Push:',
                error
            );
        }
    };


    boton.addEventListener(
        'click',
        activar
    );


    comprobar();
});
