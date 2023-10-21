/* vue */
import { AddvcardViewer } from '../../src/js/addvcardViewer.vue.js?v=2.1.7'
import { StorageViewer } from '../../src/js/storageViewer.vue.js?v=2.1.7'

Vue.createApp({
    components: {
        AddvcardViewer, StorageViewer
    },
    data() {
        return {
            
        }
    },
    watch: {
    },
    methods: {
        openModal: function(catalog_tag_template)
        {
            this.$refs.storage.openModal(catalog_tag_template)
        }
    },
    mounted() {
    },
}).mount('#app')