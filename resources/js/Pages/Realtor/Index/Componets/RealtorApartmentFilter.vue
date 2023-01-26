<template>
  <form>
    <div class="flex flex-wrap gap-4">
      <div class="flex flex-nowrap items-center gap-2">
        <input
          id="realtor-apartment-filter"
          v-model="filters.deleted"
          type="checkbox"
          class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
        />
        <label for="realtor-apartment-filter">With soft deleted apartment</label>
      </div>
      <div class="flex flex-nowrap items-center">
        <select-with-label
          v-model="filters.by"
          input-class="input-filter-l w-24"
          :options="sortableFields"
        />
        <select-with-label
          v-model="filters.order"
          input-class="input-filter-r w-40"
          :options="orderOptions"
        />
      </div>
    </div>
  </form>
</template>

<script setup>
import { computed, reactive, watch } from 'vue'
import { router } from '@inertiajs/vue3'
import { debounce } from 'lodash'
import SelectWithLabel from '@/Components/UI/SelectWithLabel.vue'

const SORT_DESC = 'desc'
const SORT_ASC = 'asc'

const props = defineProps({
    filters: Object,
})

const filters = reactive({
    deleted: props.filters.deleted || false,
    by: props.filters.by || 'price',
    order: props.filters.order || SORT_DESC,
})

const sortableFields = [
    { value: 'price', text: 'Price' },
    { value: 'created_at', text: 'Created' },
]

const sortableOptionsPrice = [
    { value: SORT_ASC, text: 'Cheapest' },
    { value: SORT_DESC, text: 'Most expensive' },
]

const sortableOptionsCreatedAt = [
    { value: SORT_DESC, text: 'From newest to old' },
    { value: SORT_ASC, text: 'From oldest to new' },
]

const orderOptions = computed(() => filters.by === 'price' ? sortableOptionsPrice : sortableOptionsCreatedAt)
const updateByFilter = () => router.get(
    route('realtor.apartment.index'),
    filters,
    { preserveScroll: true, preserveState: true },
)

watch(filters, debounce(updateByFilter, 1000))
</script>
