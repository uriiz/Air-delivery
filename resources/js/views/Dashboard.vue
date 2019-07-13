<template>
    <div class="main-dashboard">
        <header-dashboard></header-dashboard>
        <sidebar></sidebar>
    </div>
</template>

<script>
    export default {
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