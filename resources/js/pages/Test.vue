<template>
  <div class="min-h-screen bg-gradient-to-r from-[#1d52ff] to-[#a30ee9] flex items-center justify-center">
    <TransitionRoot :show="show"
    enter="transition transform duration-1000 ease-out" 
    enter-from="translate-x-4 opacity-0" 
    enter-to="translate-x-0 opacity-100"
    leave="transition transform duration-500 ease-in"
    leave-from="opacity-100"
    leave-to="opacity-0"
    >
    <div class="bg-white rounded-2xl shadow-xl flex items-center p-4 w-96 space-x-4">
      <img class="h-16 w-16 rounded-full ring ring-offset-2 ring-red-500" src="/images/test.jpg" alt="">
    <div>
      <h2 class="font-medium text-gray-900">TEST</h2>
      <p class="mt-0.5 text-gray-500">HE I'm DIYORBEK I'm 19 y.o</p>
      </div>
      </div>
    </TransitionRoot>
  </div>
  <div class="absolute top-0 my-4 inset-x-0 w-full flex items-center justify-center">
    <div v-if="show == false">
      <button @click="show = true" class="bg-blue-200  px-4 py-1.5 rounded-lg font-medium">
      TEst
    </button>
    </div>
    <div v-if="show == true">
      <button @click="show = false" class="bg-blue-200  px-4 py-1.5 rounded-lg font-medium">
      TEst
    </button>
    </div>
  </div>
</template>

<script>
import { ref } from "vue";
import { TransitionRoot, TransitionChild } from "@headlessui/vue";
export default {
  components: { TransitionRoot, TransitionChild },
  setup() {
    const show = ref(true);
    return {
      show,
    };
  },
}
</script>