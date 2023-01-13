<template>
    <div>
        <Link href="/">Main page</Link>
        |
        <Link href="/show">Show page</Link>
        |
        {{ timer }}
        <hr>
        <slot></slot>
    </div>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import {ref} from "vue";
const timer = ref(0);

setInterval(() => timer.value++, 1000);
</script>
