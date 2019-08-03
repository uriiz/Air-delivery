<template>
    <div class="main-dashboard">
        <header-dashboard></header-dashboard>
        <admin-sidebar></admin-sidebar>

        <div class="main-dashborad-in">
            <div class="main-table">
                <div class="main-table-title"><h3>Pending offers </h3></div>
                <div class="main-table-box">
                    <b-table
                            v-if="data.length > 0"
                            :data="data"
                            detail-key="id"
                            ref="table"
                            :paginated="isPaginated"
                            :per-page="perPage"
                            :openedDetailed="openedRows"
                            detailed
                    >

                        <template slot-scope="props">
                            <b-table-column field="id" label="Quotation ID">
                                <div @click="openRow(props.row)">
                                    #{{ props.row.id }}
                                </div>
                            </b-table-column>

                            <b-table-column field="pretty_time" label="Created" sortable>
                                {{ props.row.created_at }}
                            </b-table-column>


                            <b-table-column field="from_date" label="From Date" sortable>
                                {{ props.row.from_date }}
                            </b-table-column>

                            <b-table-column field="to_date" label="To Date" sortable>
                                {{ props.row.to_date }}
                            </b-table-column>

                            <b-table-column field="to_date" label="From" >
                                {{ props.row.from_name }}
                            </b-table-column>

                            <b-table-column field="to_date" label="To" >
                                {{ props.row.to_name }}
                            </b-table-column>

                            <b-table-column field="to_date" label="Watch" >
                           <span @click="showPrices(props.row.responses,props.row.id)" class="tag is-success action">
                               watch/confirm offers
                           </span>
                            </b-table-column>
                        </template>
                        <template slot="detail" slot-scope="props">
                            <extra-data-price
                                    :from_address_name="props.row.from_address_name"
                                    :from_company_name="props.row.from_company_name"
                                    :to_company_name="props.row.to_company_name"
                                    :from_lat="props.row.from_lat"
                                    :from_lng="props.row.from_lng"
                                    :from_zip_code="props.row.from_zip_code"
                                    :notes="props.row.note"
                                    :to_address_name="props.row.to_address_name"
                                    :to_lat="props.row.to_lat"
                                    :to_lng="props.row.to_lng"
                                    :to_zip_code="props.row.to_zip_code"
                                    :packages="props.row.packages"
                                    :response="props.row.responses"
                                    :rowId="props.row.id"
                            >

                            </extra-data-price>
                        </template>

                    </b-table>
                    <div v-else>
                        <p>there is no new offer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    import ConfirmOffers from '../../components/admin/ConfirmOffers'
    export default {
            mounted() {
                this.confirmOffers();
            },
        methods: {

            showPrices(data,id){
                this.$modal.open({
                    parent: this,
                    component: ConfirmOffers,
                    props:{response:data,id:id},
                    hasModalCard: true
                })
            },

            confirmOffers(){
                window.axios.post(
                    '/confirm-admin',
                ).then((res) => {
                    console.log(res.data)
                    this.data = res.data
                }).catch((res) => {

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

        },
        data() {
            return {
                currentUserId:$("#details-helper").data('id'),
                currentUserName:$("#details-helper").data('name'),
                isPaginated: true,
                perPage: 40,
                openedRows:[],
                data:[],
            }
        },
        computed:{

        },
    }

</script>