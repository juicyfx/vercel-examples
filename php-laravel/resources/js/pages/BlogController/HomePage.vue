<template>
    <div>
        <ul>
            <li v-for="article in $store.state.articles.recents" :key="article.slug" class="p-8">
                <span class="text-sm font-bold uppercase">
                    {{ dayJs(article.created_at).format('MMMM YYYY') }}
                </span>
                <h2>
                    <RouterLink
                        :to="{ name: 'BlogController@SingleArticle', params: { article: article.slug }}"
                        class="text-2xl font-bold hover:underline cursor-pointer pt-2 pb-4">
                        {{ article.title }}
                    </RouterLink>
                </h2>
                <p>{{ article.excerpt }}</p>
                <div class="pt-4">
                    <RouterLink
                        :to="{ name: 'BlogController@SingleArticle', params: { article: article.slug }}"
                        class="hover:underline cursor-pointer text-red-600">
                        Read
                    </RouterLink>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import dayJs from "dayjs";

export default {
    methods: {
        dayJs
    }
};
</script>
