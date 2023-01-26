<template>
  <menu-realtor />
  <box>
    <template #header>Upload new images</template>
    <form @submit.prevent="uploadForm">
      <section class="flex items-center gap-4 my-4">
        <input
          type="file"
          class="input-file"
          multiple
          @input="addFiles"
        />
        <button
          type="submit"
          class="button-normal disabled:opacity-50 disabled:cursor-not-allowed"
          :disabled="!canUpload"
        >
          Upload
        </button>
        <button
          type="reset"
          class="button-outline disabled:opacity-50 disabled:cursor-not-allowed"
          @click="resetForm"
        >
          Clear
        </button>
      </section>
      <div v-if="formErrors.length">
        <div v-for="(error, index) in formErrors" :key="index" class="input-error">
          {{ error }}
        </div>
      </div>
      <div class="mt-10">
        <Link class="button-outline font-light" :href="route('apartment.show', {apartment: apartment.id})">
          Preview apartment
        </Link>
      </div>
    </form>
  </box>
  <box v-if="apartment.images.length" class="mt-8">
    <template #header>Uploaded images</template>
    <section class="overflow-hidden text-gray-700">
      <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
        <div class="flex flex-wrap -m-1 md:-m-2">
          <div v-for="image in apartment.images" :key="image.id" class="flex flex-wrap md:w-1/3 lg:w-1/4">
            <div class="w-full p-1 md:p-2 relative">
              <Link
                :href="route('realtor.apartment.image.destroy', {apartment: apartment.id, image: image.id})"
                as="button"
                method="delete"
                class="absolute top-2 right-2 button-danger text-sm sm:text-base font-light opacity-70 hover:opacity-100"
              >
                Delete
              </Link>
              <img
                :alt="image.filename"
                :src="image.src"
                class="block object-cover object-center w-full h-full rounded-lg"
              />
            </div>
          </div>
        </div>
      </div>
    </section>
  </box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { Link, useForm } from '@inertiajs/vue3'
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'
import NProgress from 'nprogress'
import MenuRealtor from '@/Pages/Realtor/Components/MenuRealtor.vue'

const props = defineProps({
    apartment: Object,
})

const form = useForm({
    images: [],
})

const formErrors = computed(() => Object.values(form.errors))

const canUpload = computed(() => form.images.length)

const resetForm = () => {
    form.reset('images')
    form.errors = {}
}

router.on('progress', (eventProgress) => {
    if (eventProgress.detail.progress.percentage) {
        NProgress.set((eventProgress.detail.progress.percentage / 100) * 0.9)
    }
})

const uploadForm = () => {
    form.errors = {}
    form.post(
        route('realtor.apartment.image.store', { apartment: props.apartment.id }),
        {
            onSuccess: () => form.reset('images'),
        },
    )
}

const addFiles = (eventInput) => {
    for (const image of eventInput.target.files) {
        form.images.push(image)
    }
}
</script>

