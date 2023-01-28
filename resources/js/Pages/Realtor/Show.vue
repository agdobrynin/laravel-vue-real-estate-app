<template>
  <menu-realtor />
  <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
      <div class="w-full text-center font-medium text-gray-500">
        No offers
      </div>
    </Box>
    <div v-else class="md:col-span-7 flex flex-col gap-1">
      <offer-item
        v-for="offer in offers"
        :key="offer.id"
        :apartment-price="apartment.price"
        :offer="offer"
        :is-sold="Boolean(apartment.sold_at)"
      />
    </div>
    <div class="md:col-span-5">
      <box>
        <template #header>Apartment info</template>
        <div class="mb-4">
          <price
            :price="apartment.price"
            class="text-2xl mb-4"
          >
            Start price:
          </price>
        </div>
        <apartment-space
          :area="apartment.area"
          :baths="apartment.baths"
          :beds="apartment.beds"
          :show-icons="true"
          class="text-lg"
        />
        <apartment-address
          class="block mt-4"
          :city="apartment.city"
          :street_nr="apartment.street_nr"
          :street="apartment.street"
          :code="apartment.code"
        />
      </box>
      <offer-item
        v-if="acceptedOffer"
        :key="acceptedOffer.id"
        :apartment-price="apartment.price"
        :offer="acceptedOffer"
        :is-sold="true"
        class="mt-4"
      />
    </div>
  </div>
</template>

<script setup>
import MenuRealtor from '@/Pages/Realtor/Components/MenuRealtor.vue'
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'
import ApartmentAddress from '@/Components/ApartmentAddress.vue'
import { computed } from 'vue'
import ApartmentSpace from '@/Components/ApartmentSpace.vue'
import OfferItem from '@/Pages/Realtor/Show/Components/OfferItem.vue'

const props = defineProps({
    apartment: { type: Object, required: true },
})

const hasOffers = computed(() => props.apartment.offers.length)
const acceptedOffer = computed(() => props.apartment.offers.find((offer) => !!offer.accepted_at))
const offers = computed(() => {
    return acceptedOffer?.value
        ? props.apartment.offers.filter((offer) => offer.rejected_at)
        : props.apartment.offers
})
</script>
