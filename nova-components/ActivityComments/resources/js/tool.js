Nova.booting((Vue, router, store) => {
    Vue.config.devtools = true
    Vue.use(require('vue-moment'));
    Vue.component('activity-comments', require('./components/Tool'))
})
