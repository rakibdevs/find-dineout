<template>
	<div class="max-w-md mx-auto my-10">
        <div class="text-center">
            <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">Sign in</h1>
        </div>
        <div class="m-7">
            <form action="">
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Email</label>
                    <input type="email" :v-model="email" id="email" placeholder="example@domain.com" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                </div>
                <div class="mb-6">
                    <div class="flex justify-between mb-2">
                        <label for="password" class="text-sm text-gray-600 dark:text-gray-400">Password</label>
                        <a href="#!" class="text-sm text-gray-400 focus:outline-none focus:text-indigo-500 hover:text-indigo-500 dark:hover:text-indigo-300">Forgot password?</a>
                    </div>
                    <input type="password" :v-model="password" id="password" placeholder="Your Password" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                </div>
                <div class="mb-6">
                    <button type="button" class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">Sign in</button>
                </div>
                <!-- <p class="text-sm text-center text-gray-400">Don&#x27;t have an account yet? <a href="#!" class="text-indigo-400 focus:outline-none focus:underline focus:text-indigo-500 dark:focus:border-indigo-800">Sign up</a>.</p> -->
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            email: '',
            password: '',
            remember: '',
        }
    },
    computed: {
        isInvalid () {
            var reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/;
            return ((!reg.test(this.email)) || this.password.length < 5);
        },
    },

    methods: {
        login () {
            axios.post('/login', {
                email: this.email,
                password: this.password,
                remember: this.remember,
            }).then(() => {
                location.reload();
            }).catch(error => {
                //this.runToast(this.__('Error!'), error.response.data.errors.email[0], 'danger');
            });
        }
    }
}
</script>