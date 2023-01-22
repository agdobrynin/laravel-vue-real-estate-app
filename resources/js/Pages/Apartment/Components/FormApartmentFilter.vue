<template>
  <form @submit.prevent="filter">
    <div class="mb-8 mt-4 flex flex-wrap gap-8">
      <div class="flex flex-nowrap items-center">
        <InputWithLabel
          v-model.number="filterData.priceMin"
          placeholder="Price from" input-class="input-filter-l w-28"
          :maska-options="MASK_PRICE"
        />
        <InputWithLabel
          v-model.number="filterData.priceMax"
          placeholder="Price to" input-class="input-filter-r w-28"
          :maska-options="MASK_PRICE"
        />
      </div>
      <div class="flex flex-nowrap items-center">
        <SelectWithLabel
          v-model.number="filterData.beds"
          placeholder="Beds" input-class="input-filter-l w-28" :options="bedOptions"
        />
        <SelectWithLabel
          v-model.number="filterData.baths"
          placeholder="Baths" input-class="input-filter-r w-28" :options="bathOptions"
        />
      </div>
      <div class="flex flex-nowrap items-center">
        <InputWithLabel
          v-model.number="filterData.areaMin"
          placeholder="Square from" input-class="input-filter-l w-28"
          :maska-options="MASK_NUMBER"
        />
        <InputWithLabel
          v-model.number="filterData.areaMax"
          placeholder="Square to" input-class="input-filter-r w-28"
          :maska-options="MASK_NUMBER"
        />
      </div>
      <div class="flex gap-4">
        <button type="submit" class="button-normal">Apply</button>
        <button type="reset" class="button-outline" @click="filterClear">Clear</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import InputWithLabel from '@/Components/UI/InputWithLabel.vue'
import SelectWithLabel from '@/Components/UI/SelectWithLabel.vue'
import {useForm} from '@inertiajs/inertia-vue3'
import {MASK_NUMBER, MASK_PRICE} from '@/Utils/mask'

const props = defineProps({filters: Object})

const bathOptions = [
    {value: 1, text: '1 bath'},
    {value: 2, text: '2 baths'},
    {value: 3, text: '3 baths'},
    {value: 4, text: '4 baths and more'},
]
const bedOptions = [
    {value: 1, text: '1 bed'},
    {value: 2, text: '2 beds'},
    {value: 3, text: '3 beds'},
    {value: 4, text: '4 beds and more'},
]

const filterData = useForm({
    priceMin: props.filters?.priceMin || null,
    priceMax: props.filters?.priceMax || null,
    beds: props.filters?.beds || null,
    baths: props.filters?.baths || null,
    areaMin: props.filters?.areaMin || null,
    areaMax: props.filters?.areaMax || null,
})

const filter = () => {
    filterData.get(route('apartment.index'), {preserveState: true, preserveScroll: true})
}
const filterClear = () => {
    filterData.priceMin = null
    filterData.priceMax = null
    filterData.beds = null
    filterData.baths = null
    filterData.areaMin = null
    filterData.areaMax = null
    filter()
}
</script>
