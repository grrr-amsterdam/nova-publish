Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: "publish",
      path: "/publish",
      component: require("./components/Tool"),
    },
  ]);
});
