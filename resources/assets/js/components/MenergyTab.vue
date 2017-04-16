<template>
    <div v-show="this.isActive">
        <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        name: { required: true },
        selected: { default: false }
    },
    data() {
        return {
            isActive: false
        }
    },
    created() {
        this.isActive = this.selected;
    }
}
</script>
