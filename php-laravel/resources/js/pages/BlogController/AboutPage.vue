<template>
<div class="p-8">
    <h1 class="text-4xl">About Me</h1>
    <p
        class="py-2"
        v-for="paragraph in $store.state.bio"
        :key="paragraph">
        {{ paragraph }}
    </p>
</div>
</template>
