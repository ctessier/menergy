<template>
    <div class="container">
        <div class="tabs is-centered">
            <ul>
                <router-link v-for="route in routes" :to="route.path" tag="li">
                    <a>
                        <span class="icon is-medium"><i class="fa fa-bolt"></i></span>
                        <span>{{ route.name }}</span>
                    </a>
                </router-link>
            </ul>
        </div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: 'app',
        created() {
            this.$router.options.routes.forEach(route => {
                if (route.props && route.props.type) {
                    this.routes.push({
                        name: route.props.type.name,
                        path: route.path
                    })
                }
            })
        },
        data() {
            return {
                routes: []
            }
        }
    }
</script>
