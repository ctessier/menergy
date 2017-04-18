<template>
    <div>
        <div class="tabs is-centered">
            <ul>
                <li v-for="tab in tabs" :class="{ 'is-active': tab.isActive }">
                    <a @click="toTab(tab)">
                        <span class="icon is-medium"><i class="fa fa-bolt"></i></span>
                        <span>{{ tab.type.name }}</span>
                    </a>
                </li>
            </ul>
        </div>
        <div>
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tabs: []
        };
    },
    created() {
        this.tabs = this.$children;
    },
    methods: {
        toTab(tab) {
            this.tabs.forEach(currentTab => {
                currentTab.isActive = (currentTab.type.name == tab.type.name);
            });
            tab.fetchData();
        }
    }
}
</script>
