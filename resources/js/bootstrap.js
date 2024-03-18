/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: pusherKey,
    cluster: pusherCluster ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${pusherCluster}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});
window.Echo.channel('order-placed').listen('RTOrderPlacedNotificationEvent', (e) => {
    console.log(e);

    let html = `<ul class="list-group list-group-flush">
                       <li class="list-group-item list-group-item-action dropdown-notifications-item">
                             <div class="d-flex">
                             <div class="flex-shrink-0 me-3">
                             <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-success"
                                ><i class="ti ti-shopping-cart"></i
                                    ></span>
                             </div>
                             </div>
                             <div class="flex-grow-1">
                                   <a href="/admin/orders/${e.orderId}" style="color: #5d596c;">
                                   <h6 class="mb-1">${e.message} 🛒</h6>
                                   <p class="mb-0">${e.userName}. ${e.orderGrandTotal}₺'lik yeni sipariş verdi.</p>
                                        <small class="text-muted">${e.date}</small>
                                   </a>
                             </div>
                             <div class="flex-shrink-0 dropdown-notifications-actions">
                                 <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span
                                 ></a>
                                 <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                 ><span class="ti ti-x"></span></a>
                             </div>
                             </div>
                               </li>
                               </ul>`;
    let badge = `<div class="spinner-grow text-danger rt-badge" role="status"></div>`;
    $('.rt-notification').prepend(html);
    $('.badge-nt').append(badge).css({"padding-right": "0","margin-right": "-0.32rem"});
    $('.badge-notifications').remove();

});
