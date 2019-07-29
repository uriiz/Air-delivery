<template>
    <div class="dashboard-sidebar">
        <div class="dashboard-title"><h3>Dashboard</h3></div>
        <nav>
            <ul>
                <li>
                    <router-link :to="{ name: 'DashboardAdmin' }">
                        <img src="/images/icon_5.png" alt="" class="mCS_img_loaded">
                        <div class="noty">
                            <div>
                                יבואנים
                            </div>
                            <div>

                            </div>
                        </div>
                    </router-link>
                </li>


                <li>
                    <router-link :to="{ name: 'appDashboardEdit' }">
                        <img src="/images/icon_8.png" alt="" class="mCS_img_loaded">
                        <div>משלחים</div>
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
        },
        methods: {
            getOffers(){
                window.axios.post(
                    '/app/get-orders',
                ).then((res) => {
                    this.$store.commit('newOffers',res.data);
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
            }
        },

    }

</script>