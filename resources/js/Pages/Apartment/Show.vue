<template>
  <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <box class="md:col-span-7 flex w-full">
      <div v-if="apartment.images.length">
        <section class="overflow-hidden text-gray-700">
          <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
            <div class="flex flex-wrap -m-1 md:-m-2">
              <div v-for="image in apartment.images" :key="image.id" class="flex flex-wrap md:w-1/2">
                <div class="w-full p-1 md:p-2">
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
      </div>
      <div v-else class="w-full text-center font-medium text-gray-500">
        No images
      </div>
    </box>
    <div class="md:col-span-5 flex flex-col gap-4">
      <box>
        <template #header>Basic info from user <span class="font-bold">{{ apartment.owner.name }}</span> </template>
        <price
          :price="apartment.price"
          class="block mb-4 text-2xl font-bold"
        >
          Price
        </price>

        <apartment-space
          :area="apartment.area"
          :baths="apartment.baths"
          :beds="apartment.beds"
          class="text-lg"
        />
        <apartment-address
          :street="apartment.street"
          :street_nr="apartment.street_nr"
          :city="apartment.city"
          :price="apartment.price"
          :code="apartment.code"
          class="text-gray-500"
        />
      </box>
      <box v-if="apartment.sold_at === null">
        <template #header>Monthly payment</template>
        <div>
          <label class="label">Interest range ({{ interestRate }} %)</label>
          <input
            v-model.number="interestRate"
            type="range" min="0.1" :max="maxInterestRate" step="0.1"
            class="w-full appearance-none h-4 bg-gray-200 rounded-lg cursor-pointer dark:bg-gray-700"
          />
        </div>
        <div>
          <label class="label">Duration ( {{ duration }} years)</label>
          <input
            v-model.number="duration"
            type="range" min="3" :max="maxDuration" step="1"
            class="w-full appearance-none h-4 bg-gray-200 rounded-lg cursor-pointer dark:bg-gray-700"
          />
        </div>
        <div class="text-gray-600 dark:text-gray-300 mt-2">
          <div class="text-gray-400">Your monthly payment</div>
          <price
            :price="monthlyPayment"
            class="text-3xl"
          />
          <price
            :price="totalPaid"
            class="font-bold block mt-3 font-medium"
          >
            Total paid:
          </price>
          <price
            :price="totalInterest"
            class="font-bold block mt-3 font-medium"
          >
            Total interested:
          </price>
        </div>
      </box>
      <div v-if="apartment.sold_at === null">
        <offer-make
          v-if="user && offerMade === null"
          :apartment-id="apartment.id"
          :price="apartment.price"
          @offer-price-update="offerPrice"
        />
        <offer-made v-if="offerMade" :offer-made="offerMade" />
      </div>
      <div v-else>
        <box>
          <div class="text-green-600 dark:text-green-200 text-center border border-green-700 border-dashed px-1 py-1 rounded-xl uppercase"> sold </div>
        </box>
      </div>
    </div>
  </div>
</template>

<script setup>
import ApartmentAddress from '@/Components/ApartmentAddress.vue'
import Price from '@/Components/Price.vue'
import ApartmentSpace from '@/Components/ApartmentSpace.vue'
import Box from '@/Components/UI/Box.vue'
import { computed, ref } from 'vue'
import {
    defaultDuration,
    defaultInterestRate,
    maxDuration,
    maxInterestRate,
    useMonthlyPayment,
} from '@/Composables/useMonthlyPayment'
import OfferMake from '@/Pages/Apartment/Show/Components/OfferMake.vue'
import { usePage } from '@inertiajs/vue3'
import OfferMade from '@/Pages/Apartment/Show/Components/OfferMade.vue'

const props = defineProps({
    apartment: Object,
    offerMade: { type: [Object, null] },
})

const interestRate = ref(defaultInterestRate)
const duration = ref(defaultDuration)
const apartmentPrice = ref(props.apartment.price)

const user = computed(() => usePage().props.user)
const offerPrice = (value) => apartmentPrice.value = value

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(apartmentPrice, interestRate, duration)
</script>
