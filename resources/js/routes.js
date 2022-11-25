
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default
let logout = require('./components/auth/logout.vue').default

//End Aithetication
let home = require('./components/home.vue').default

//Pokemon Component
let all_pokemon = require('./components/pokemon/index.vue').default

let userslist = require('./components/users/index.vue').default

/*
    path, component & name should be the same inorder to work
*/

export const routes = [
    { path: '/', component: login, name: '/' },
    { path: '/register', component: register, name: 'register' },
    { path: '/logout', component: logout, name: 'forget' },
    { path: '/home', component: home, name: 'home' },

    //employee routes
    { path: '/all_pokemon', component: all_pokemon, name: 'all_pokemon' },


    //Users
    { path: '/userslist', component: userslist, name: 'userslist' },
]


