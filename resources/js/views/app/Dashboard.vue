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
                this.getOffers()
            },
        methods: {

            getOffers(){
                window.axios.post(
                    '/app/get-orders',
                ).then((res) => {

                    this.$store.commit('newOffers',res.data);
                }).catch((res) => {});
            },

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