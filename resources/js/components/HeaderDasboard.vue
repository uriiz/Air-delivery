<template>
    <header>
    <div class="head-dash top_nav">
        <div class="quicks-links">
            <div class="action">
                <img src="https://my.tranzila.com/assets/images/master/pluse_icon.png" alt=""><a href="javascript:void(0)">Quick access</a>
                <ul>
                    <li class=""><a href="https://my.tranzila.com/cash_register">New debit transaction</a></li>
                    <li class=""><a href="https://my.tranzila.com/transactions/txns_list/find">Cancel/Credit/Force transactions</a></li>
                    <li class=""><a href="https://my.tranzila.com/invoices/invoice">New invoice</a></li>                         <!--<li><a href="javascript:void(0)" onclick="menuRedirect('billing','manualinv');">New invoice</a></li>-->
                </ul>
            </div>
        </div>
        <div class="brand_fidbek">
            <div class="fidbek">
                <a href="#">Feedback</a>
            </div>
            <div class="brand">
                Freight-Me
            </div>
        </div>
    </div>
    </header>
</template>
<script>

    export default {
        methods: {
            logOut(){

                window.axios.post(
                    '/log-out',
                ).then((res) => {
                    window.location = "/";
                }).catch((res) => {

                });
            },


        },
        data() {
            return {
                currentUserId:$("#details-helper").data('id'),
                currentUserName:$("#details-helper").data('name'),
                navigation: 'home'
            }
        },
    }

</script>