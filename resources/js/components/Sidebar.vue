<template>
    <div class="dashboard-sidebar">
        <div class="dashboard-title"><h3>Dashboard</h3></div>

        <div class="user-profile">

            <div :style="{ 'background-image': 'url(' + currentUserLogo + ')' }"
                 class="user-image-bg">
            </div>
            <h2>{{dateShowTex}}<br>
                <span>
                    {{currentUserName}}
                </span>
            </h2>
            <p>Your last login, 13.07.2019, 01:33</p>
            <a class="dash-log-out" href="#"  @click.prevent="logOut">
                <b-icon icon="logout"></b-icon>
                <div>Logout</div>
            </a>
        </div>
        <nav>
            <ul>
                <li>
                    <router-link :to="{ name: 'dashboard' }">
                        <img src="/images/icon_5.png" alt="" class="mCS_img_loaded">
                        <div class="noty">
                        <div>
                            New Quotation
                        </div>
                        <div>
                            <div class="count">
                                {{countOffers}}
                            </div>
                        </div>
                    </div>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'addOffer' }">
                        <img src="/images/icon_2.png" alt="" class="mCS_img_loaded">
                        <div>Send New Quotation</div>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'myOffer' }">
                        <img src="/images/secure5.png" alt="" class="mCS_img_loaded">
                        <div>My Offers</div>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'profile' }">
                        <img src="/images/icon_8.png" alt="" class="mCS_img_loaded">
                        <div>My Account</div>
                    </router-link>
                </li>

            </ul>
        </nav>
    </div>
</template>

<script>
    export default {

        mounted() {

           this.timeShow()
            this.getOffers()
        },
        methods: {
            getOffers(){
                window.axios.post(
                    '/get-price-offer',
                ).then((res) => {
                    this.$store.commit('newOffersUser',res.data);
                }).catch((res) => {console.log(res.data)});
            },
            timeShow(){

                var data = [
                        [22, 'Working late'],
                        [18, 'Good evening'],
                        [12, 'Good afternoon'],
                        [5,  'Good morning'],
                        [0,  'Good Night']
                    ],
                    hr = new Date().getHours();
                for (var i = 0; i < data.length; i++) {
                    if (hr >= data[i][0]) {
                        console.log(data[i][1])
                        this.dateShowTex = data[i][1]
                        break;
                    }
                }
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
                currentUserLogo:$("#details-helper").data('logo'),
                dateShowTex:'',
            }
        },

        computed:{
            countOffers(){
                return this.$store.getters.getNewOffersUser.length
            }
        },
    }

</script>