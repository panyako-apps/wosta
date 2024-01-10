import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import {createPinia} from 'pinia';

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core';

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

/* import specific icons */
import { faUserSecret, faStar, faTimes, faVideo, faImage, faThumbsUp, faShare, faComment, faEdit, faTrash, faBars, faBookOpen, faFileInvoice, faCheck, faEye, faTrashAlt, faPrint, faCloudMeatball, faEllipsisV, faEllipsisH, faBell, faImages, faEnvelopeCircleCheck, faSignal, faPlusCircle, faTimesCircle, faReply, faChevronCircleRight, faChevronCircleLeft, faHome, faPenSquare, faChevronDown, faChevronCircleDown, faFileText, faLanguage, faTh, faCommentAlt, faChartPie, faHeart, faCartPlus, faChair, faCartShopping, faCartFlatbedSuitcase, faMinus, faPlus, faLock, faUnlock, faSearch, faPhoneFlip, faPlay, faCaretDown, faBuilding, faReceipt, faUsers, faPaperPlane, faBullseye, faEnvelope, faShareAlt, faCaretRight, faQuoteRight, faPlaneDeparture} from '@fortawesome/free-solid-svg-icons'
import { faFacebook, faInstagram, faLinkedin, faPinterest, faTelegram, faTwitter, faWhatsapp } from '@fortawesome/free-brands-svg-icons';

/* add icons to the library */
library.add(
    faBars, 
    faBell,
    faBookOpen, 
    faCartPlus,
    faCartShopping,
    faCartFlatbedSuitcase,
    faChair, 
    faChevronCircleLeft,
    faComment, 
    faCloudMeatball, 
    faChevronCircleRight, 
    faChevronCircleLeft,
    faChevronDown,
    faChevronCircleDown, 
    faCommentAlt, 
    faChartPie, 
    faUserSecret, 
    faImage, 
    faThumbsUp, 
    faShare, 
    faEdit, 
    faTrash,
    faTrashAlt,
    faFileInvoice,
    faCheck,
    faEye,
    faPrint,
    faTrashAlt, 
    faEllipsisV,
    faEllipsisH, 
    faImages,
    faEnvelopeCircleCheck,
    faSignal,
    faPlusCircle,
    faTimesCircle,
    faReply,
    faFacebook, 
    faTwitter, 
    faLinkedin, 
    faWhatsapp, 
    faTelegram,
    faHome,
    faPenSquare,
    faBars,
    faFileText,
    faLanguage, 
    faTh, 
    faHeart,
    faMinus,
    faStar, 
    faTimes, 
    faVideo, 
    faPlus,
    faLock,
    faUnlock, 
    faSearch, 
    faInstagram, 
    faTrashAlt, 
    faPhoneFlip,
    faPlay, 
    faCaretDown, 
    faCaretRight,
    faBuilding,
    faReceipt,
    faUsers, 
    faPaperPlane,
    faBullseye,
    faEnvelope, 
    faShareAlt,
    faPinterest,
    faQuoteRight, 
    faPlaneDeparture
    )



const appName = import.meta.env.VITE_APP_NAME || 'HigherLevelMerchants';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(createPinia())
            .mixin({components: {
                'font-awesome-icon': FontAwesomeIcon
            }})
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
