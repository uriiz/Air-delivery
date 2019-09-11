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
                    <router-link :to="{ name: 'appDashboard' }">
                        <img src="/images/icon_5.png" alt="" class="mCS_img_loaded">
                        <div class="noty">
                            <div>
                                New Quotations
                            </div>
                            <div v-if="countOffers>0">
                               <div class="count">
                                   {{countOffers}}
                               </div>
                            </div>
                        </div>
                    </router-link>
                </li>


                <li>
                    <router-link :to="{ name: 'appDashboardEdit' }">
                        <img src="/images/icon_8.png" alt="" class="mCS_img_loaded">
                        <div>My Account</div>
                    </router-link>
                </li>

                <li>
                    <router-link :to="{ name: 'DashboardFinalStep' }">
                        <img src="/images/secure5.png" alt="" class="mCS_img_loaded">
                        <div class="noty">
                            <div>
                                Confirmed Quotation
                            </div>
                            <div v-if="countConfirmOffers > 0">
                                <div class="count">
                                    {{countConfirmOffers}}
                                </div>
                            </div>
                        </div>
                    </router-link>
                </li>

            </ul>
        </nav>
    </div>
</template>

<script>
    export default {

        mounted() {

            this.timeShow();
            this.getOffers();
            this.getConfirmOffers();
        },
        methods: {
            getOffers(){
                window.axios.post(
                    '/app/get-orders',
                ).then((res) => {
                    console.log(res.data)
                    this.$store.commit('newOffers',res.data);
                }).catch((res) => {});
            },

            getConfirmOffers(){

                window.axios.post(
                    '/app/get-confirm-orders',
                ).then((res) => {
                    this.$store.commit('newConfirmOffers',res.data);
                }).catch((res) => {});
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
                return this.$store.getters.getNewOffers.length
            },
            countConfirmOffers(){
                return this.$store.getters.getNewConfirmOffers.length
            },
        },

    }

</script>