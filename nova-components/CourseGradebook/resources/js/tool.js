Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'course-gradebook',
      path: '/course-gradebook',
      component: require('./components/Tool'),
    },
  ])
})
