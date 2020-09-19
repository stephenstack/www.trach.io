import VueRouter from 'vue-router';


function loadView(view) {
    return () => import(/* webpackChunkName: "view-[request]" */ `./views/${view}.vue`);
}

let routes = [
	// { path: '/', component: loadView("Dashboard") },
	{ path: '/', component: loadView("Dashboard") },
	{ path: '/app', component: loadView("Dashboard") },
	{ path: '/useractions', component: loadView("UserActions") },
	{ path: '/useractions/:id', component: loadView("UserActions") },
	{ path: '/shifthistory', component: loadView("ShiftHistory") },
	{ path: '/shifthistory/:id', component: loadView("ShiftHistory") },
	{ path: '/team', component: loadView("Team") },
	{ path: '/reports', component: loadView("Reports") },
	{ path: '/notes', component: loadView("Notes") },
	{ path: '/notifications', component: loadView("Notifications") },
	{ path: '/settings', component: loadView("Settings") },
	{ path: '/support', component: loadView("Support") },
	{ path: '/support-contact', component: loadView("SupportContact") },
	{ path: '/copyright', component: loadView("Copyright") },
	/* PAGENOTFOUND */
	{ path: "*", component: loadView("PageNotFound") }
]

export default new VueRouter({
	mode: 'hash',
	routes,
	linkActiveClass: 'active',
})
