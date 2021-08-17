<template>
    <!-- give the sidebar z-50 class so its higher than the navbar if you want to see the logo -->
    <!-- you will need to add a little "X" button next to the logo in order to close it though -->
    <div class="w-1/2 md:w-1/3 lg:w-64 fixed md:top-0 md:left-0 h-screen lg:block text-white bg-indigo-900 border-r z-40" :class="sideBarOpen ? '' : 'hidden'" id="main-nav">

          <div class="w-full h-18 border-b flex px-4 items-center mb-8" style="height:57px;">
            <p class="font-semibold text-3xl text-white-400 pl-4">LOGO</p>
          </div>

          <div class="mb-4 px-4">
            <a href="/admin/" class="w-full flex items-center text-white-400 h-10 pl-4 rounded-lg cursor-pointer">
              <i class="h-6 w-6 text-2xl las la-home"></i>
              <span class="text-white-700 pl-3">Dashboard</span>
            </a>
            <a href="/admin/bookings" class="w-full flex items-center text-white-400 h-10 pl-4 rounded-lg cursor-pointer">
              <i class="h-6 w-6 text-2xl las la-clipboard-list"></i>
              <span class="text-white-700 pl-3">Bookings</span>
            </a>
            <a href="/admin/offers" class="w-full flex items-center text-white-400 h-10 pl-4 rounded-lg cursor-pointer">
              <i class="h-6 w-6 text-2xl las la-gifts"></i>
              <span class="text-white-700 pl-3">Offers</span>
            </a>
            <a href="/admin/restaurents" class="w-full flex items-center text-white-400 h-10 pl-4 rounded-lg cursor-pointer">
              <i class="h-6 w-6 text-2xl las la-utensils"></i>
              <span class="text-white-700 pl-3">Restaurents</span>
            </a>
            <a href="/admin/cuisines" class="w-full flex items-center text-white-400 h-10 pl-4 rounded-lg cursor-pointer">
              <i class="h-6 w-6 text-2xl las la-hamburger"></i>
              <span class="text-white-700 pl-3">Cuisines</span>
            </a>
            <a href="/admin/categories" class="w-full flex items-center text-white-400 h-10 pl-4 rounded-lg cursor-pointer">
              <i class="h-6 w-6 text-2xl las la-coffee"></i>
              <span class="text-white-700 pl-3">Categories</span>
            </a>
            <a href="/admin/features" class="w-full flex items-center text-white-400 h-10 pl-4 rounded-lg cursor-pointer">
              <i class="h-6 w-6 text-2xl  lab la-cc-mastercard"></i>
              <span class="text-white-700 pl-3">Features</span>
            </a>
            <a href="/admin/users" class="w-full flex items-center text-white-400 h-10 pl-4 rounded-lg cursor-pointer">
              <i class="h-6 w-6 text-2xl las la-users"></i>
              <span class="text-white-700 pl-3">Users</span>
            </a>
            <a href="/admin/locations" class="w-full flex items-center text-white-400 h-10 pl-4 rounded-lg cursor-pointer">
              <i class="h-6 w-6 text-2xl las la-map-marker-alt"></i>
              <span class="text-white-700 pl-3">Locations</span>
            </a>
            <a href="/admin/zones" class="w-full flex items-center text-white-400 h-10 pl-4 rounded-lg cursor-pointer">
              <i class="h-6 w-6 text-2xl las la-globe-americas"></i>
              <span class="text-white-700 pl-3">Zone</span>
            </a>
          </div>

        </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
    name: 'Sidebar',
    computed: {
        ...mapState(['sideBarOpen'])
    }
}
</script>
{"mode":"full","isActive":false}