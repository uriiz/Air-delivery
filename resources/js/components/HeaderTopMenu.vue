<template>
    <div>
    <nav class="navbar" role="navigation" aria-label="main navigation">

        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
                Freight-Me
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">


            <div class="navbar-end" v-if="!currentUserId">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-primary" @click.prevent="register()">
                            <strong>Sign up</strong>
                        </a>
                        <a class="button is-light" @click="cardModal()">
                            Log in
                        </a>
                    </div>
                </div>
            </div>
            <div v-else>
                <section>
                    <div>

                    </div>
                    <div class="welcome-name show-in-desktop">
                        Logged as &nbsp; <b> {{currentUserName}} </b>
                        <a v-if="role == 1" href="/dashboard/my-offers"  class="button is-primary orange">
                            <span>Dashboard</span>
                        </a>

                        <a v-if="role == 2" href="/app-dashboard" class="button is-primary orange">
                            <span>Dashboard</span>
                        </a>

                        <a v-if="role == 3" href="/admin-dashboard" class="button is-primary orange">
                            <span>Dashboard</span>
                        </a>
                    </div>
                </section>
            </div>
        </div>


    </nav>
        <div class="banner-top">
            <video autoplay muted loop id="main-video">
                <source src="http://haifa-port.s89.upress.link/wp-content/uploads/2019/05/MAERSK-HAMBURG-Short.mp4" type="video/mp4">
                <source src="http://haifa-port.s89.upress.link/wp-content/uploads/2019/05/MAERSK-HAMBURG-Short.mp4" type="video/ogg">
                Your browser does not support the video tag.
            </video>
            <!--<div id="particles-js"></div>-->
            <!--<div class="banner-top-right">-->
                <!--<div class="airplain-par-text">-->
                    <!--<p>lorem impsum dolor</p>-->
                    <!--<p> <strong>content</strong> a long established</p>-->
                    <!--<p> opposed <strong> to using</strong></p>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="banner-top-left">-->
                <!--<img class="airplain-par" src="/images/plain2.png" alt="">-->
            <!--</div>-->
        </div>
    </div>
</template>
<script>
    import Login from './Login'
    import Register from './Register'

    export default {

        mounted() {
            let url = new URL(window.location.href);
            let login = url.searchParams.get("login");
            let register = url.searchParams.get("register");
            if(login){
               this.cardModal()
            }
            if(register){
                this.register()
            }
        },
        methods: {
            logOut(){

                window.axios.post(
                    '/log-out',
                ).then((res) => {
                    window.location = "/";
                }).catch((res) => {

                });
            },
            cardModal() {
                this.$modal.open({
                    parent: this,
                    component: Login,
                    hasModalCard: true
                })
            },
            register(){
                this.$modal.open({
                    parent: this,
                    component: Register,
                    hasModalCard: true
                })
            },
        },
        data() {
            return {
                currentUserId:$("#details-helper").data('id'),
                currentUserName:$("#details-helper").data('name'),
                role:$("#details-helper").data('r'),
                navigation: 'home'
            }
        },
    }

</script>