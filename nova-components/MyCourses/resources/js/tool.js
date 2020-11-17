Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'my-courses',
      path: '/my-courses',
      component: require('./components/Tool'),
    },
  ])
})
