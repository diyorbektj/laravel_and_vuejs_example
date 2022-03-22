<template>
   <div>
       <div>
            <input type="text" class="w-full h-12 border border-gray-300 rounded pl-2 focus:outline-none focus:border-2 focus:border-red-300" v-model="keyword">
       </div>
        <ul v-if="Books.length > 0">
            <TransitionGroup
            name="list" tag="ul"
               >
            <li v-for="book in Books" :key="book.id" >
                <div class="bg-white p-4 w-full h-auto rounded shadow my-4">
  <div>
      <h4>{{ book.name }}</h4>
      <p>{{ book.author }}</p>
  </div>
</div>
                </li>
                </TransitionGroup>
        </ul>
        <transition
        name="test"
        >
        <div class="bg-white p-4 w-full h-auto rounded shadow my-4" v-if="keyword == null">Введите текст для поиска</div>
        </transition>
    </div>
</template>
<script>

export default {
    data() {
        return {
            keyword: null,
            Books: []
        };
    },
    watch: {
        keyword(after, before) {
            this.getResults();
        }
    },
    methods: {
        getResults() {
            axios.get('/api/books/livesearch', { params: { keyword: this.keyword } })
                .then(res => this.Books = res.data)
                .catch(error => {});
        }
    }
}
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
.test-move, /* apply transition to moving elements */
.test-enter-active,
.test-leave-active {
  transition: all 0.5s ease;
}
.test-enter-from,
.test-leave-to {
  opacity: 0;
  transform: translateX(30px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.test-leave-active {
  position: absolute;
}
</style>