const globalStore = {
    state: {
        sideBarOpen: false,
        isAuth:false,
        hasRole: '',
    },
    getters: {
        sideBarOpen: state => state.sideBarOpen,
        isAuth: state => state.isAuth,
        hasRole: state => state.hasRole
    },
    mutations: {
        toggleSidebar (state) {
            state.sideBarOpen = !state.sideBarOpen
        },
        setAuth(state, status) {
            state.isAuth = status
        },
        setRole(state, role)
        {
            state.hasRole = role
        }
    },
    actions: {
        toggleSidebar(context) {
            context.commit('toggleSidebar')
        }
    }
}

import { createStore, createLogger } from 'vuex';


const debug = process.env.NODE_ENV !== 'production'

const Store = createStore({
  modules: {globalStore},
  strict: debug
})

export default Store;