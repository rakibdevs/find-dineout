<template>
    <div class="w-full  px-4">
        <div class="relative grid lg:grid-cols-3 md:grid-cols-3 min-w-0 break-words w-full mb-6 ">
            <div class="col-span-2 sm:hidden md:block">
                <img class="w-3/4 mx-auto" src="/images/restaurent-bg.png">
            </div>
            <div class="flex-auto px-4 lg:px-10 py-10 pt-0 shadow-lg">
                <div class="rounded-t mb-0 px-6 py-6">
                    <div class="text-center mb-3">
                        <h6 class="text-gray-600 text-sm font-bold">
                            Sign In
                        </h6>
                    </div>
                    <hr class="mt-6 border-b-1 border-gray-400" />
                </div>
                <form>
                    <div class="relative w-full mb-3">
                        <label
                            class="block uppercase text-gray-700 text-xs font-bold mb-2"
                            for="grid-password"
                            >Email</label
                            >
                        <input
                            v-model="email"
                            type="email"
                            class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                            placeholder="Email"
                            style="transition: all 0.15s ease 0s;"
                            />
                    </div>
                    <div class="relative w-full mb-3">
                        <label
                            class="block uppercase text-gray-700 text-xs font-bold mb-2"
                            for="grid-password"
                            >Password</label
                            ><input
                            v-model="password"
                            type="password"
                            class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                            placeholder="Password"
                            style="transition: all 0.15s ease 0s;"
                            />
                    </div>
                    <div>
                        <label class="inline-flex items-center cursor-pointer"
                            ><input
                            id="customCheckLogin"
                            type="checkbox"
                            class="form-checkbox border-0 rounded text-gray-800 ml-1 w-5 h-5"
                            style="transition: all 0.15s ease 0s;"
                            /><span class="ml-2 text-sm font-semibold text-gray-700"
                            >Remember me</span
                            ></label
                            >
                    </div>
                    <div class="text-center mt-6">
                        <button
                            class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full"
                            type="button"
                            style="transition: all 0.15s ease 0s;" @click="login"
                            >
                        Sign In
                        </button>
                    </div>
                </form>
                <div class="flex flex-wrap mt-6">
                    <div class="w-1/2">
                        <a href="#" class=""><small>Forgot password?</small></a>
                    </div>
                    <div class="w-1/2 text-right">
                        <a href="#" class=""
                            ><small>Create new account</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>                    
</template>

<script>
    import { mapState, mapMutations } from 'vuex'
    export default{
        data(){
            return{
                email:'',
                password:'',
                remember:''
            }

        },
        methods:{
            ...mapMutations(['isAuth','setUser']),
            login(){
                axios.post('/login', {
                    email: this.email,
                    password: this.password,
                    remember: this.remember,
                }).then(res => {
                    if(res.data.status){
                        this.$store.commit('setAuth', true)
                        this.$store.commit('setUser', res.data.user)
                        this.$notify({
                          title: 'Success',
                          message: 'Successfully logged in',
                          type: 'success'
                        });
                        if(res.data.user.user_type == 'admin'){
                            window.location.pathname = '/admin'
                        }else{
                            window.location.pathname = '/'
                        }
                    }else{
                        this.$notify({
                          title: 'Error',
                          message: res.error,
                          type: 'error'
                        });
                    }
                }).catch(error => {
                    console.log(error)
                    this.$notify({
                      title: 'Error',
                      message: error.error,
                      type: 'error'
                    });
                    
                });
            },
        }
    }
</script>