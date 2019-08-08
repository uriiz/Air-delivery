<template>
    <div class="main-dashboard">
        <header-dashboard></header-dashboard>
        <admin-sidebar></admin-sidebar>
        <div class="main-dashborad-in">
            <div class="main-table">
                <div class="main-table-title"><h3>Feeds</h3></div>
                <div class="main-table-box">
                    <img v-if="loader" src="/images/loader1.png" class="rotating" alt="">
                    <b-table
                            :data="data"
                            v-if="!loader"
                            detail-key="id"
                            ref="table"
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

                            <b-table-column field="created_at" label="Created" sortable>
                                {{ props.row.created_at }}
                            </b-table-column>

                            <b-table-column label="Delete!">
                                <div style="cursor: pointer" class="delete-user" @click="deleteUser(props.row.id)">
                                    <delete-svg></delete-svg>
                                </div>
                            </b-table-column>
                        </template>
                        <template slot="detail" slot-scope="props">
                            <div v-html="props.row.content" class="content"></div>
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
                this.getFeeds();
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
                            '/admin/delete-feed',{id:id}
                        ).then((res) => {
                            this.$store.commit('deleteUser',id);
                        }).catch((res) => {});
                    }
                })
            },
            getFeeds(){
                window.axios.post(
                    '/admin/get-feeds',
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