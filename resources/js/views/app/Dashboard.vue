<template>
    <div class="main-dashboard">
        <header-dashboard></header-dashboard>
        <sidebar-app></sidebar-app>
        <offer-app></offer-app>
    </div>
</template>

<script>
    export default {
        mounted() {

        },
        methods: {
        },
        data() {
            return {
                currentUserId:$("#details-helper").data('id'),
                currentUserName:$("#details-helper").data('name'),
            }
        },
        computed:{
        },
    }

</script>