<template>
    <div class="main-dashboard">
        <header-dashboard></header-dashboard>
        <admin-sidebar></admin-sidebar>

        <div class="main-dashborad-in">
            <div class="main-table">
                <div class="main-table-title"><h3>Forwarders waiting for approval </h3></div>
                <div class="main-table-box">
                    <img v-if="loader" src="/images/loader1.png" class="rotating" alt="">
                    <b-table
                            :data="data"
                            detail-key="id"
                            ref="table"
                            :paginated="isPaginated"
                            :per-page="perPage"
                            :openedDetailed="openedRows"
                            v-if="!loader"
                            >

                        <template slot-scope="props">
                            <b-table-column field="id" label="ID" width="40" numeric>
                                {{ props.row.id }}
                            </b-table-column>

                            <b-table-column field="name" label="Name">
                                {{ props.row.name }}
                            </b-table-column>

                            <b-table-column field="email" label="Email">
                                {{ props.row.email }}
                            </b-table-column>

                            <b-table-column field="company_name" label="Company Name">
                                {{ props.row.company_name }}
                            </b-table-column>

                            <b-table-column field="company_phone" label="Company Phone">
                                {{ props.row.company_phone }}
                            </b-table-column>

                            <b-table-column field="created_at" label="Registerd">
                                {{ props.row.created_at }}
                            </b-table-column>

                            <b-table-column field="confirm_term" label="Confirm Term">
                                {{ props.row.confirm_term }}
                            </b-table-column>

                            <b-table-column field="phone" label="Phone">
                                {{ props.row.phone }}
                            </b-table-column>

                            <b-table-column label="Delete!">
                                <div style="cursor:pointer" class="delete-user" @click="deleteUser(props.row.id)">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" width="30" height="30" xml:space="preserve">
<g>
<path style="fill:#B8BDC1;" d="M441.379,176.552H70.621c-9.754,0-17.655-7.901-17.655-17.655v-35.31
c0-9.754,7.901-17.655,17.655-17.655h370.759c9.754,0,17.655,7.901,17.655,17.655v35.31
C459.034,168.651,451.134,176.552,441.379,176.552"/>
<path style="fill:#E6E7E8;" d="M76.506,176.552l38.312,319.258c0.768,9.154,8.413,16.19,17.593,16.19h247.172
c9.181,0,16.834-7.036,17.593-16.19l38.321-319.258H76.506z"/>
<g>
<polygon style="fill:#CC4B4C;" points="238.121,105.931 228.781,52.966 79.542,81.682 83.823,105.931 		"/>
<polygon style="fill:#CC4B4C;" points="416.338,105.931 423.727,64.044 308.968,45.647 298.34,105.931 		"/>
</g>
<polygon style="fill:#F0CE49;" points="344.276,0 167.23,15.069 172.42,63.815 228.785,52.966 238.124,105.931 298.337,105.931
308.966,45.647 349.775,52.189 	"/>
<g>
<path style="fill:#B8BDC1;" d="M132.414,512h247.172c9.181,0,16.834-7.036,17.593-16.19l4.785-54.431H110.036l4.785,54.431
C115.58,504.964,123.233,512,132.414,512"/>
<path style="fill:#B8BDC1;" d="M256,397.241c-4.873,0-8.828-3.946-8.828-8.828V229.517c0-4.882,3.955-8.828,8.828-8.828
s8.828,3.946,8.828,8.828v158.897C264.828,393.295,260.873,397.241,256,397.241"/>
<path style="fill:#B8BDC1;" d="M174.638,396.939c-4.529,0-8.386-3.469-8.783-8.06l-13.842-158.296
c-0.433-4.855,3.16-9.137,8.024-9.56c4.864-0.45,9.137,3.178,9.56,8.024l13.842,158.296c0.424,4.855-3.169,9.137-8.024,9.56
C175.159,396.931,174.894,396.939,174.638,396.939"/>
<path style="fill:#B8BDC1;" d="M337.362,396.939c-0.256,0-0.521-0.009-0.777-0.035c-4.855-0.424-8.448-4.705-8.024-9.56
l13.842-158.296c0.424-4.846,4.714-8.474,9.56-8.024c4.864,0.424,8.457,4.705,8.024,9.56L346.146,388.88
C345.748,393.47,341.891,396.939,337.362,396.939"/>
</g>
</g>
</svg>

                                </div>
                            </b-table-column>

                            <b-table-column field="confirm" label="Confirm">

                                <div class="confirm-company" @click="confirmCompany( props.row.id)" style="cursor:pointer">
                                    <svg width="30" height="30" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 506.4 506.4" style="enable-background:new 0 0 506.4 506.4;" xml:space="preserve">
<circle style="fill:#54B265;" cx="253.2" cy="253.2" r="249.2"/>
                                        <path style="fill:#F4EFEF;" d="M372.8,200.4l-11.2-11.2c-4.4-4.4-12-4.4-16.4,0L232,302.4l-69.6-69.6c-4.4-4.4-12-4.4-16.4,0
	L134.4,244c-4.4,4.4-4.4,12,0,16.4l89.2,89.2c4.4,4.4,12,4.4,16.4,0l0,0l0,0l10.4-10.4l0.8-0.8l121.6-121.6
	C377.2,212.4,377.2,205.2,372.8,200.4z"/>
                                        <path d="M253.2,506.4C113.6,506.4,0,392.8,0,253.2S113.6,0,253.2,0s253.2,113.6,253.2,253.2S392.8,506.4,253.2,506.4z M253.2,8
	C118,8,8,118,8,253.2s110,245.2,245.2,245.2s245.2-110,245.2-245.2S388.4,8,253.2,8z"/>
                                        <path d="M231.6,357.2c-4,0-8-1.6-11.2-4.4l-89.2-89.2c-6-6-6-16,0-22l11.6-11.6c6-6,16.4-6,22,0l66.8,66.8L342,186.4
	c2.8-2.8,6.8-4.4,11.2-4.4c4,0,8,1.6,11.2,4.4l11.2,11.2l0,0c6,6,6,16,0,22L242.8,352.4C239.6,355.6,235.6,357.2,231.6,357.2z
	 M154,233.6c-2,0-4,0.8-5.6,2.4l-11.6,11.6c-2.8,2.8-2.8,8,0,10.8l89.2,89.2c2.8,2.8,8,2.8,10.8,0l132.8-132.8c2.8-2.8,2.8-8,0-10.8
	l-11.2-11.2c-2.8-2.8-8-2.8-10.8,0L234.4,306c-1.6,1.6-4,1.6-5.6,0l-69.6-69.6C158,234.4,156,233.6,154,233.6z"/>

</svg>
                                </div>
                            </b-table-column>
                        </template>
                        <template slot="detail" slot-scope="props">

                            <div class="order-admin-details" v-for="(o,index) in props.row.offers">

                                <div class="sep-custom" style="background:#ff7800;color:#fff ">{{index+1}}</div>
                                <div>
                                    <p>
                                        <strong>מספר מזהה:</strong>
                                        {{o.id}}
                                    </p>
                                    <p>
                                        <strong>נוצרה:</strong>
                                        {{o.created_at}}
                                    </p>

                                    <p>
                                        <strong>מחברה:</strong>
                                        {{o.from_company_name}}
                                    </p>

                                    <p>
                                        <strong>לחברה:</strong>
                                        {{o.to_company_name}}
                                    </p>

                                    <p>
                                        <strong>הערות:</strong>
                                        {{o.note}}
                                    </p>

                                    <p>
                                        <strong>סטטוס ההצעה:</strong>
                                        {{o.submit_action}}
                                    </p>

                                    <p>
                                        <strong>מתאריך:</strong>
                                        {{o.from_date}}
                                    </p>

                                    <p>
                                        <strong>עד תאריך:</strong>
                                        {{o.to_date}}
                                    </p>

                                    <p>
                                        <strong>מאיפה:</strong>
                                        {{o.from_address_name}}
                                    </p>

                                    <p>
                                        <strong>לאן:</strong>
                                        {{o.to_address_name}}
                                    </p>
                                </div>
                            </div>
                        </template>

                    </b-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
            mounted() {
                this.getUsers();
            },
        methods: {

            confirmCompany(id){

                window.axios.post(
                    '/register-with-admin',
                    {
                        'id':id,
                    }
                ).then((res) => {

                    if(res.data == 1){
                    Swal.fire({
                        title: 'החברה רשומה באתר',
                        text: "אמור הישלח אליו אימייל",
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Ok',

                    }).then((result) => {
                        this.$store.commit('deleteUser',id);
                    })
                      }else{
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'כבר יש כתובת דוא"ל כזאת',
                            footer: ''
                        })
                    }
                }).catch((res) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'כבר יש כתובת דוא"ל כזאת',
                        footer: ''
                    })
                });


            },
            deleteUser(id){
                Swal.fire({
                    title: 'בטוח?',
                    text: "ברגע שמוחקים אין אפשרות לשחזר",
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'Ok',

                }).then((result) => {
                    if(result.value == 1){
                        window.axios.post(
                            '/admin/delete-user',{id:id}
                        ).then((res) => {
                            this.$store.commit('deleteUser',id);
                        }).catch((res) => {});
                    }
                })
            },
            getUsers(){
                window.axios.post(
                    '/admin/get-waiting',
                ).then((res) => {
                    this.$store.commit('users',res.data);
                    this.loader = false
                }).catch((res) => {});
            },
        },
        data() {
            return {
                currentUserId:$("#details-helper").data('id'),
                currentUserName:$("#details-helper").data('name'),
                isPaginated: true,
                perPage: 40,
                openedRows:[],
                loader:true,
            }
        },
        computed:{
            data(){
                return this.$store.getters.getUsers
            }
        },
    }

</script>