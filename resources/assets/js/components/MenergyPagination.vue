<template>
    <nav class="pagination is-centered">
        <a class="pagination-previous" v-if="prev_page_url" @click="onClickPreviousOrNext(prev_page_url)">Précédent</a>
        <a class="pagination-next" v-if="next_page_url" @click="onClickPreviousOrNext(next_page_url)">Suivant</a>
        <ul class="pagination-list">
            <li v-for="i in nb_page">
                <a @click="onClickPage" :data-page="i" :class="['pagination-link', { 'is-current': i == current_page }]">{{ i }}</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        prev_page_url: { required: true },
        next_page_url: { required: true },
        current_page: { required: true },
        nb_page: { required: true }
    },
    methods: {
        onClickPreviousOrNext(url) {
            var parts = url.split("?");
            this.$emit('changePage', parts[1]);
        },
        onClickPage(e) {
            var page = e.target.getAttribute('data-page');
            this.$emit('changePage', 'page=' + page);
        }
    }
}
</script>
