<template>
    <div class="main-dashboard">
        <header-dashboard></header-dashboard>
        <sidebar></sidebar>
        <div class="main-dashborad-in">
            <main-form-single :id="pageId"></main-form-single>
        </div>
    </div>
</template>

<script>
    export default {

        mounted(){

        },
        methods: {

        },
        data() {
            return {
                currentUserId:$("#details-helper").data('id'),
                currentUserName:$("#details-helper").data('name'),
                pageId:this.$route.params.id,
            }
        },
    }

</script>