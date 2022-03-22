<template>
    <div class="bg-white w-full h-auto rounded-md p-4">
    
        <div class="flex justify-between">
           
             <div class="text-xl font-bold">All Books</div>
            <div><button type="button" class="bg-[#0b9ed8] w-auto h-auto p-2 rounded text-white hover:outline hover:outline-offset-2 outline-[#6ed5fd]" @click="setIsOpen(true)">Add Book</button></div>
        </div>
<div class="h-px w-full bg-gray-300 my-4"></div>
        <ul>
            <TransitionGroup
            name="list" tag="ul"
               >
                <li class="pt-4" v-for="book in test" :key="book.id">
                <div class="shadow-md rounded p-4 flex justify-between">
                    <div>
                      <p> {{ book.id }} </p>
                       <p> {{ book.name }} </p>
                       <p>{{ book.author }}</p>
                       <p>{{ book.created_at}}</p>
                    </div>
                    <div>
                        <button class="text-[#0b9ed8]"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
  <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
</svg></button>

<button class="text-red-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
</svg></button>
                    </div>
                </div>
            </li>
            </TransitionGroup>
        </ul>
    </div>
    <Dialog
    :open="isOpen"
    @close="setIsOpen"
    class="fixed inset-0 z-10 overflow-y-auto"
  >
    <div class="flex items-center justify-center min-h-screen">
      <DialogOverlay class="fixed inset-0 bg-black opacity-40" />

      <div class="relative max-w-xl container mx-auto bg-white rounded-[8px]">
        <DialogTitle class="flex justify-between text-xl p-4 bg-gray-200 rounded-t-[8px]">
            <div>AddBook</div>
            <div @click="setIsOpen(false)">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-red-500" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
</svg>
            </div>
        </DialogTitle>
        
        <div>
            <form @submit.prevent="addBook">
                    <div class="p-4">
                        <div class="my-4">
                        <strong class="text-[17px]">Name:</strong>
                        <input type="text" class="w-full h-12 border border-gray-300 rounded pl-2 focus:outline-none focus:border-2 focus:border-red-300" v-model="book.name">
                    </div>
                    <div class="my-4">
                        <strong class="text-[17px]">Author:</strong>
                        <input type="text" class="w-full h-12 border border-gray-300 rounded pl-2 focus:outline-none focus:border-2 focus:border-red-300" v-model="book.author">
                    </div>
                    </div>
                   <div class="bg-gray-300 h-px w-full"></div>
                    <div class="flex justify-end p-4 bg-gray-200 rounded-b-[8px]">
                        <button class="bg-white border border-gray-400 p-2 rounded mx-2">Отменить</button>
                        <button type="submit" class="bg-[#008521] w-auto h-auto rounded text-white p-2 hover:outline hover:outline-offset-2 outline-[#00c531]" @close="setIsOpen" @click="onClickTop">Add Book</button>

                        </div>
                </form>
                 </div>
        </div>
    </div>
  </Dialog>
</template>

<script>
import LaravelVuePagination from 'laravel-vue-pagination';

  import { ref } from "vue";
  import {
    Dialog,
    DialogOverlay,
    DialogTitle,
    DialogDescription,
  } from "@headlessui/vue";
export default {
    computed: {
    test: function() {
      return _.orderBy(this.books, 'id', 'desc');
    }
  },
    components: { Dialog, DialogOverlay, DialogTitle, DialogDescription },
     data() {
        return {
            book: {},
            books: [],
            message: false,
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/books?page=11')
                .then(response => {
                    this.books = response.data.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
        methods:{
        deleteBook(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/books/delete/${id}`)
                    .then(response => {
                        let i = this.books.map(item => item.id).indexOf(id); // find index of your object
                        this.books.splice(i, 1)
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        },
         addBook() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/books/add', this.book)
                    .then(response => {
                        this.books.push(response.data.data);
                        this.message = true;
                        console.log(this.message);
                        this.book = {
                        };
                        console.log(this.book);
                    })

                    .catch(function (error) {
                        console.error(error);
                    });
            })

        }
    },

    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    },
    setup() {

      let isOpen = ref(false);
      return {
        isOpen,
        setIsOpen(value) {
          isOpen.value = value;
        },
        handleDeactivate() {
          // ...
        }
      };
    },
    mounted(){
    }

};
</script>
<style>
.list-move, /* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
  position: absolute;
}
</style>