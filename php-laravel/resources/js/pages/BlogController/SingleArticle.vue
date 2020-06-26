<template>
<div>
  <h2 class="text-4xl font-bold text-center mb-8">{{ $store.state.articles.active.title }}</h2>
  <p>{{ $store.state.articles.active.content }}</p>

  <hr class="my-8 border-red-500">

  <p>
    <span class="italic text-gray-600 font-hairline">
      Published {{ dayJs($store.state.articles.active.created_at).format('d MMM YYYY') }}
    </span>
    <span class="px-2">—</span>
    <span class="hover:underline">{{ $store.state.author }}</span>
  </p>
</div>
</template>

<script>
import dayJs from 'dayjs'

export default {
    methods: {
        dayJs
    }
};
</script>
