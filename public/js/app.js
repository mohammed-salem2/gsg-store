import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Echo.private('orders')
    .listen('.order.created' , function(event){
        alert(`New Order Created ${event.order.number}`)
    })
