Nova.booting((Vue, router, store) => {
    Vue.config.devtools = true
    Vue.component('activity-scores', require('./components/Tool'))
})
