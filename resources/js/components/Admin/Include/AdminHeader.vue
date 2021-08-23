<template>
    <div class="sticky top-0 z-40">
        <div class="w-full h-15 px-6 bg-white  flex items-center justify-between">
            <!-- left navbar -->
            <div class="flex">
                <div class="w-1/2 md:w-1/3 lg:w-64"></div>
                <div class="inline-block lg:hidden flex items-center mr-4">
                    <button class="hover:text-blue-500 hover:border-white focus:outline-none navbar-burger" @click="toggleSidebar()">
                        <svg class="h-5 w-5" v-bind:style="{ fill: 'black' }" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                    </button>
                </div>

                <!-- search bar -->
                <div class="relative text-gray-600">
                    <input type="search" name="serch" placeholder="Search restaurents..." class="bg-white h-10 w-full xl:w-64 px-5 rounded-lg border text-sm focus:outline-none">
                    <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                        <i class="las la-search"></i>
                    </button>
                </div>
            </div>

            <!-- right navbar -->
            <div class="flex items-center relative p-2">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 20 20" width="20" class="fill-current mr-3 hover:text-blue-500"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z"/></svg> -->
                <i class="text-4xl font-normal text-gray-500 las la-user-circle cursor-pointer" @click="dropDownOpen = !dropDownOpen"></i>
            </div>

        </div>
        <!-- dropdown menu -->
        <div :class="dropDownOpen ? '' : 'hidden'" class="absolute bg-gray-100 border border-t-0 shadow-xl text-gray-700 rounded-b-lg w-48 right-0 mr-6" >
            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Account</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Settings</a>
            <a href="/logout" class="block px-4 py-2 hover:bg-gray-200">Logout</a>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
    name: 'Navbar',
    computed: {
        ...mapState(['sideBarOpen','isAuth','hasRole'])
    },
    data() {
        return {
            dropDownOpen: false
        }
    },
    methods: {
        toggleSidebar() {
            this.$store.dispatch('toggleSidebar')
        }
    }
}
</script>
{"mode":"full","isActive":false}