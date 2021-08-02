import queryString from 'query-string';
export default {
    data () {
        return {/*
            isAuth: window.Auth.isAuth || false,
            authUser: window.Auth.authUser || null,*/
            isEditing: false,
            isUpdating: false,
            params: [],
            mainUri: window.location.protocol + "//" + window.location.host + window.location.pathname,
            pagination:{
                page:1,
                from:null,
                to:null,
                total:0,
                links:[],
            }
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
        },
        createdParams(){
            this.params = queryString.parse(location.search);
        },
        setParams(queries){

            this.params = queries;
        },
        setQueryString(){
            const stringified = queryString.stringify(this.params);
            let newurl = decodeURIComponent(this.mainUri + '?' + stringified);
            window.history.pushState({path: newurl}, '', newurl);
            return decodeURIComponent(stringified)
        },
        getPagination(data){
            this.pagination.page = data.current_page;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
            this.pagination.total = data.total;
            this.pagination.next_page_url = data.next_page_url;
            this.pagination.links = data.links;

            return this.pagination

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
