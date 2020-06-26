<template>
<div class="p-8">
    <h1 class="text-4xl">Contact Me</h1>
    <p
        class="py-2"
        v-for="paragraph in $store.state.contact"
        :key="paragraph">
        {{ paragraph }}
    </p>
</div>
</template>
