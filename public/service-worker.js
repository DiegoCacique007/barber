/* =========================================================
   BARBER - SERVICE WORKER
========================================================= */


/* =========================================================
   INSTALACIÓN
========================================================= */

self.addEventListener('install', () => {

    self.skipWaiting();

});


/* =========================================================
   ACTIVACIÓN
========================================================= */

self.addEventListener('activate', event => {

    event.waitUntil(
        self.clients.claim()
    );

});


/* =========================================================
   RECIBIR NOTIFICACIÓN PUSH
========================================================= */

self.addEventListener('push', event => {

    if (!event.data) {
        return;
    }

    let payload = {};

    try {

        payload = event.data.json();

    } catch (error) {

        payload = {
            title: 'BARBER',
            body: event.data.text(),
        };

    }


    const title =
        payload.title ??
        'BARBER';


    const options = {

        body:
            payload.body ??
            'Tienes una nueva notificación.',

        icon:
            payload.icon ??
            '/favicon.ico',

        badge:
            payload.badge ??
            '/favicon.ico',

        data:
            payload.data ?? {},

        tag:
            payload.tag ??
            'barber-notification',

        renotify: true,

        requireInteraction: false,

        vibrate: [
            200,
            100,
            200
        ],

    };


    event.waitUntil(

        self.registration.showNotification(
            title,
            options
        )

    );

});


/* =========================================================
   CLICK EN LA NOTIFICACIÓN
========================================================= */

self.addEventListener(
    'notificationclick',
    event => {

        event.notification.close();


        const destino =
            event.notification.data?.url ??
            '/admin/citas';


        const urlDestino =
            new URL(
                destino,
                self.location.origin
            ).href;


        event.waitUntil(

            self.clients
                .matchAll({
                    type: 'window',
                    includeUncontrolled: true,
                })
                .then(ventanas => {

                    for (const ventana of ventanas) {

                        if ('navigate' in ventana) {

                            ventana.navigate(
                                urlDestino
                            );

                        }

                        if ('focus' in ventana) {

                            return ventana.focus();

                        }

                    }


                    if (self.clients.openWindow) {

                        return self.clients.openWindow(
                            urlDestino
                        );

                    }

                    return null;

                })

        );

    }
);
