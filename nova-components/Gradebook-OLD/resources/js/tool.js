    Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'gradebook',
      path: '/gradebook',
      component: require('./components/Tool'),
    },
  ])
})
