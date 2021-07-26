const globalStore = {
    state: {
        sideBarOpen: false
    },
    getters: {
        sideBarOpen: state => {
            return state.sideBarOpen
        }
    },
    mutations: {
        toggleSidebar (state) {
            state.sideBarOpen = !state.sideBarOpen
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