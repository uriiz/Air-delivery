<template>
    <div class="main-dashboard">
        <header-dashboard></header-dashboard>
        <admin-sidebar></admin-sidebar>
        <div class="main-dashborad-in">
            <div class="main-table">
                <div class="main-table-title"><h3>Importers</h3></div>
                <div class="main-table-box">
                    <img v-if="loader" src="/images/loader1.png" class="rotating" alt="">
                    <b-table
                            :data="data"
                            detail-key="id"
                            ref="table"
                            v-if="!loader"
                            :paginated="isPaginated"
                            :per-page="perPage"
                            :openedDetailed="openedRows"
                            detailed
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

                            <b-table-column field="logo" label="Logo">
                                <img style="width:30px" :src="props.row.logo" alt="">
                            </b-table-column>

                            <b-table-column field="company_name" label="Company Name">
                                {{ props.row.company_name }}
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
                                <div style="cursor: pointer" class="delete-user" @click="deleteUser(props.row.id)">
                                    <delete-svg></delete-svg>
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
                    '/admin/get-users',
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
            },
        },
    }
</script>