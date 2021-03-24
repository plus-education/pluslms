Nova.booting((Vue, router, store) => {
    Vue.config.devtools = true
    Vue.component('teacher-topic-comment', require('./components/Tool'))
})
