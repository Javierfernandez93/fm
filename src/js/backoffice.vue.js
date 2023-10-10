/* vue */ 
import { NoticeViewer } from '../../src/js/noticeViewer.vue.js?v=2.1.6'

import { NotificationService } from '../../src/js/notification.module.js?v=2.1.6'   
import { ProfitViewer } from '../../src/js/profitViewer.vue.js?v=2.1.6'
import { LandingViewer } from '../../src/js/landingViewer.vue.js?v=2.1.6'
import { ZuumsignupViewer } from '../../src/js/zuumsignupViewer.vue.js?v=2.1.6'

Vue.createApp({
    components : { 
        ProfitViewer, LandingViewer, ZuumsignupViewer, NoticeViewer 
    },
    data() {
        return {
            NotificationService : new NotificationService
        }
    },
}).mount('#app')