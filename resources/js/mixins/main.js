export default {
    data () {
        return {/*
            isAuth: window.Auth.isAuth || false,
            authUser: window.Auth.authUser || null,*/
            isEditing: false,
            isUpdating: false,
        }
    },

    methods: {
        addParameterToURL (url, param) {
            url += (url.split('?')[1] ? '&':'?') + param;
            return url;
        },
        startUpdating () {
            this.isUpdating = true;
        },
        stopUpdating () {
            this.isUpdating = false;
        }
        /*showLoginModal () {
            window.events.$emit('showLoginModal');
        },
        showRegisterModal () {
            window.events.$emit('showRegisterModal');
        },*/
       /* runToast (subject, message, type = 'primary', withSound = false) {
            window.events.$emit('runToast', subject, message, type, withSound);
        }*/
    }
}
