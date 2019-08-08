<template>
    <div class="main-dashboard">
        <header-dashboard></header-dashboard>
        <sidebar></sidebar>
        <dashboard-user></dashboard-user>
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
    }

</script>