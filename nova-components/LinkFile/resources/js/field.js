Nova.booting((Vue, router, store) => {
  Vue.component('index-link-file', require('./components/IndexField'))
  Vue.component('detail-link-file', require('./components/DetailField'))
  Vue.component('form-link-file', require('./components/FormField'))
})
