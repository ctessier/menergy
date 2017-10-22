<template>
    <nav class="pagination is-centered">
        <router-link :to="getUrl(currentPage - 1)" class="pagination-previous" v-if="currentPage > 1">Précédent</router-link>
        <router-link :to="getUrl(currentPage + 1)" class="pagination-next" v-if="currentPage < nbPages">Suivant</router-link>
        <ul class="pagination-list">
            <li v-for="i in nbPages">
                <router-link :to="getUrl(i)" :class="['pagination-link', { 'is-current': i == currentPage }]">{{ i }}</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        baseUrl: { type: String, required: true },
        currentPage: { type: Number, required: true },
        nbPages: { type: Number, required: true }
    },
    methods: {
        getUrl(page) {
            return this.baseUrl + '/' + page;
        }
    }
}
</script>
