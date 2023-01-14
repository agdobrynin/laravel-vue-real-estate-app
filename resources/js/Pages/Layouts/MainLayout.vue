<template>
  <div>
    <Link href="/">Main page</Link>
    |
    <Link href="/show">Show page</Link>
    |
    <Link href="/apartment">Show apartments</Link>
    |
    <Link href="/apartment/create">Create apartment</Link>

    <div v-if="flashSuccess" class="success">
      {{ flashSuccess }}
    </div>
    <hr />
    <slot />
  </div>
</template>

<script setup>
import {Link, usePage} from '@inertiajs/inertia-vue3'
import {computed} from 'vue'

const page = usePage()

const flashSuccess = computed(() => page.props.value.flash.success)
</script>

<style scoped>
.success {
    color: white;
    background-color: #178f17;
    border: #085d08 solid;
    padding: 0.5rem;
}
</style>
