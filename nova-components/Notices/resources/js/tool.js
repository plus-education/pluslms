Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'notices',
      path: '/notices',
      component: require('./components/Tool'),
    },
  ])
})
