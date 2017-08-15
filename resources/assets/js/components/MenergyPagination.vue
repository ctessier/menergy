<template>
    <nav class="pagination is-centered">
        <router-link :to="getUrl(current_page - 1)" class="pagination-previous" v-if="current_page > 1">Précédent</router-link>
        <router-link :to="getUrl(current_page + 1)" class="pagination-next" v-if="current_page < nb_page">Suivant</router-link>
        <ul class="pagination-list">
            <li v-for="i in nb_page">
                <router-link :to="getUrl(i)" :class="['pagination-link', { 'is-current': i == current_page }]">{{ i }}</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        base_url: { type: String, required: true },
        current_page: { required: true },
        nb_page: { required: true }
    },
    methods: {
        getUrl(page) {
            return this.base_url + '/' + page;
        }
    }
}
</script>
