<template>
    <header>
    <div class="head-dash top_nav">
        <div class="mobile-trigger" @click="openMenu">
            <div class="hamburger hamburger--slider js-hamburger">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
        </div>
        <div class="quicks-links">
            <div class="action">
                <img src="https://my.tranzila.com/assets/images/master/pluse_icon.png" alt=""><a href="javascript:void(0)">Quick access</a>
                <ul>
                    <li class=""><a href="#">New debit transaction</a></li>
                    <li class=""><a href="#">Cancel/Credit/Force transactions</a></li>
                    <li class=""><a href="#">New invoice</a></li>
                </ul>
            </div>
        </div>
        <div class="brand_fidbek">
            <div class="fidbek">
                <a @click.prevent="feedBackTrigger" href="#">Feedback</a>
            </div>
            <div class="brand">
                Freight-Me
            </div>
        </div>
    </div>
    </header>
</template>
<script>
    import FeedBack from './FeedBack'
    export default {
        methods: {
            openMenu(){

                    $('.dashboard-sidebar').toggleClass('show');
                    $('.hamburger').toggleClass('is-active');

            },
            feedBackTrigger(){
                this.$modal.open({
                    parent: this,
                    component: FeedBack,
                    hasModalCard: true
                })
            },
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