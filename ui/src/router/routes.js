const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      { path: "", component: () => import("pages/home/index.vue") }
    ],
  },

  {
    path: '/',
    component: () => import('layouts/auth.vue'),
    children: [
      { name: 'login', path: '/login', component: () => import('pages/auth/login.vue') },
      { name: 'register', path: '/register', component: () => import('pages/auth/register.vue') }
    ]
  },
  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/Error404.vue"),
  },
];

export default routes;
