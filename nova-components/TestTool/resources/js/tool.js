Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'TestTool',
      path: '/TestTool',
      component: require('./components/Tool'),
    },
  ])
})
