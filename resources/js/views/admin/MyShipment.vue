<template>
    <div class="main-dashboard">
        <header-dashboard></header-dashboard>
        <admin-sidebar></admin-sidebar>
        <div class="main-dashborad-in">
            <div class="main-table">
                <div class="main-table-title"><h3>Forwarders waiting for approval</h3></div>
                <div class="main-table-box">
                    <img v-if="loader" src="/images/loader1.png" class="rotating" alt="">
                    <b-loading :is-full-page="false" :active.sync="loaderEvent" :can-cancel="false"></b-loading>
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
                                    <delete-svg></delete-svg>
                                </div>
                            </b-table-column>

                            <b-table-column field="confirm" label="Confirm">
                                <div class="confirm-company" @click="confirmCompany( props.row.id)" style="cursor:pointer">
                                    <confirm-svg></confirm-svg>
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
                this.loaderEvent = true;
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
                        this.loaderEvent = false;
                        this.$store.commit('deleteUser',id);
                    })
                      }else{
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'כבר יש כתובת דוא"ל כזאת',
                            footer: ''
                        })
                        this.loaderEvent = false;
                    }
                }).catch((res) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'כבר יש כתובת דוא"ל כזאת',
                        footer: ''
                    })
                    this.loaderEvent = false;
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
                loaderEvent:false,
            }
        },
        computed:{
            data(){
                return this.$store.getters.getUsers
            }
        },
    }

</script>