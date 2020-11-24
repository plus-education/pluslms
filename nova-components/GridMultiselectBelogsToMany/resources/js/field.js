Nova.booting((Vue, router, store) => {
  Vue.component('index-grid-multiselect-belogs-to-many', require('./components/IndexField'))
  Vue.component('detail-grid-multiselect-belogs-to-many', require('./components/DetailField'))
  Vue.component('form-grid-multiselect-belogs-to-many', require('./components/FormField'))
})
