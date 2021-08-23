const globalStore = {
    state: {
        sideBarOpen: false,
        isAuth:false,
        user: ''
    },
    getters: {
        sideBarOpen: state => state.sideBarOpen,
        isAuth: state => state.isAuth,
        user: state => state.user
    },
    mutations: {
        toggleSidebar (state) {
            state.sideBarOpen = !state.sideBarOpen
        },
        setAuth(state, status) {
            state.isAuth = status
        },
        setUser(state, user)
        {
            state.user = user
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