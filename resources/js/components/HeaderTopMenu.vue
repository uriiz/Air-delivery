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
            <div class="navbar-start">
                <a class="navbar-item">
                    Home
                </a>

                <a class="navbar-item">
                    Documentation
                </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        More
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            About
                        </a>
                        <a class="navbar-item">
                            Jobs
                        </a>
                        <a class="navbar-item">
                            Contact
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item">
                            Report an issue
                        </a>
                    </div>
                </div>
            </div>

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
                    <div class="welcome-name show-in-desktop">
                        Logged as &nbsp; <b> {{currentUserName}} </b>
                    </div>
                    <b-dropdown
                            v-model="navigation"
                            position="is-bottom-left"
                            aria-role="menu">
                        <a
                                class="navbar-item"
                                slot="trigger"
                                role="button">
                            <span>Menu</span>
                            <b-icon icon="menu-down"></b-icon>
                        </a>

                        <b-dropdown-item class="show-in-mobile" custom aria-role="menuitem">
                            Logged as <b>Rafael Beraldo</b>
                        </b-dropdown-item>
                        <hr class="dropdown-divider show-in-mobile">
                        <b-dropdown-item has-link aria-role="menuitem">
                            <a href="https://google.com" target="_blank">
                                <b-icon icon="link"></b-icon>
                                Google (link)
                            </a>
                        </b-dropdown-item>
                        <b-dropdown-item value="home" aria-role="menuitem">
                            <b-icon icon="home"></b-icon>
                            Home
                        </b-dropdown-item>
                        <b-dropdown-item value="products" aria-role="menuitem">
                            <b-icon icon="cart"></b-icon>
                            Products
                        </b-dropdown-item>
                        <b-dropdown-item value="blog" disabled aria-role="menuitem">
                            <b-icon icon="book-open"></b-icon>
                            Blog
                        </b-dropdown-item>
                        <hr class="dropdown-divider" aria-role="menuitem">
                        <b-dropdown-item value="settings">
                            <b-icon icon="settings"></b-icon>
                            Settings
                        </b-dropdown-item>
                        <b-dropdown-item value="logout" @click="logOut" aria-role="menuitem">
                            <b-icon icon="logout"></b-icon>
                            Logout
                        </b-dropdown-item>
                    </b-dropdown>

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
                navigation: 'home'
            }
        },
    }

</script>