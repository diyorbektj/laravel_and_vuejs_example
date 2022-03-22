<template>
<header class="bg-[#3dbbec] w-full h-16 text-white text-xl">
<div class="max-w-screen-xl mx-auto flex justify-between pt-4">
    <div>Laravel</div>
    <div>TEST</div>
    <div>
        tesf
    </div>
</div>
</header>
<div class="max-w-screen-xl mx-auto">
        <!--<nav class="navbar navbar-expand-lg navbar-light bg-light">-->
          <!--  <div class="collapse navbar-collapse">-->
                <!-- for logged-in user-->
               <!-- <div class="navbar-nav" v-if="isLoggedIn">
                    <router-link to="/dashboard" class="nav-item nav-link">Dashboard</router-link>
                    <router-link to="/books" class="nav-item nav-link">Books</router-link>
                    <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout</a>
                </div>-->
                <!-- for non-logged user-->
               <!-- <div class="navbar-nav" v-else>
                    <router-link to="/" class="nav-item nav-link">Home</router-link>
                    <router-link to="/login" class="nav-item nav-link">login</router-link>
                    <router-link to="/register" class="nav-item nav-link">Register
                    </router-link>
                    <router-link to="/about" class="nav-item nav-link">About</router-link>
                </div>
            </div>
        </nav>-->
        <br/>
        <router-view />
        
    <NotificationGroup group="foo">
  <div
    class="fixed inset-0 flex items-start justify-end p-6 px-4 py-6 pointer-events-none"
  >
    <div class="w-full max-w-sm">
      <Notification
        v-slot="{ notifications }"
        enter="transform ease-out duration-300 transition"
        enter-from="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-4"
        enter-to="translate-y-0 opacity-100 sm:translate-x-0"
        leave="transition ease-in duration-500"
        leave-from="opacity-100"
        leave-to="opacity-0"
        move="transition duration-500"
        move-delay="delay-300"
      >
        <div
          class="flex w-full max-w-sm mx-auto mt-4 overflow-hidden bg-white rounded-lg shadow-md"
          v-for="notification in notifications"
          :key="notification.id"
        >
          <div class="flex items-center justify-center w-12 bg-green-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
            </svg>
          </div>

          <div class="px-4 py-2 -mx-3">
            <div class="mx-3">
              <span class="font-semibold text-green-500">{{ notification.title }}</span>
              <p class="text-sm text-gray-600">{{ notification.text }}</p>
            </div>
          </div>
        </div>
      </Notification>
    </div>
  </div>
</NotificationGroup>
</div>
</template>

<script>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
export default {
components: {
      Menu,
      MenuButton,
      MenuItems,
      MenuItem,
    },
    name: "App",
    data() {
        return {
            isLoggedIn: false,
        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    methods: {
        logout(e) {
            console.log('ss')
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    
}
</script>