<template>
    <div v-show="this.isActive">
        <menergy-form @success="pushData"></menergy-form>
        <table class="table is-striped">
            <thead>
                <th>Date de la relève</th>
                <th>Relève (en {{ type.unity }})</th>
            </thead>
            <tbody>
                <tr v-if="isFetching">
                    <td class="has-text-centered" colspan="2">
                        <span class="tag is-primary">Récuparation des données...</span>
                    </td>
                </tr>
                <tr v-for="measure in data">
                    <td>{{ measure.date }}</td>
                    <td>{{ measure.value }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        type: { type: Object, required: true },
        selected: { default: false }
    },
    data() {
        return {
            isActive: false,
            isFetching: false,
            data: []
        }
    },
    created() {
        this.isActive = this.selected;
        if (this.isActive) {
            this.fetchData();
        }
    },
    methods: {
        fetchData() {
            if (this.data.length === 0) {
                this.isFetching = true;
                axios.get('/types/' + this.type.id)
                    .then(response => {
                        this.data = response.data;
                        this.isFetching = false;
                    })
                    .catch(errors => {
                        alert('An error occurred. See logs');
                        console.log(errors);
                        this.isFetching = false;
                    });
            }
        },
        pushData(data) {
            this.data.unshift(data);
        }
    }
}
</script>
