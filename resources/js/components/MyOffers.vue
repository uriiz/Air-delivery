<template>
    <div>

        <div class="main-table">
            <div class="filter-inputs">

                <div class="wrap-input">
                    <b-input icon="account" placeholder="From Name" v-model="fromNameSearch"></b-input>
                </div>
                <div class="wrap-input">
                    <b-input icon="account" placeholder="To Name" v-model="toNameSearch"></b-input>
                </div>

                <div class="wrap-input">
                    <select v-model="searchDraft" class="input">
                        <option selected value="-1">Status</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>

            </div>
            <div class="main-table-title">
                <h3>Orders History</h3>
            </div>
            <div class="main-table-box">

                <div class="loader1" v-if="loader">
                    <img src="/images/loader1.png" class="rotating" alt="">
                </div>
                <b-table
                        v-if="!loader"
                        :data="data"
                        detail-key="id"
                        ref="table"
                        :paginated="isPaginated"
                        :per-page="perPage"
                        :openedDetailed="openedRows"
                        detailed
                        >

                    <template slot-scope="props">
                        <b-table-column field="id" label="Order ID">
                            <div @click="openRow(props.row)">
                                #{{ props.row.id }}
                            </div>

                        </b-table-column>

                        <b-table-column field="pretty_time" label="Created" sortable>
                            {{ props.row.pretty_time }}
                        </b-table-column>

                        <b-table-column field="from_name" label="From Name">
                            {{ props.row.from_name }}
                        </b-table-column>

                        <b-table-column field="to_name" label="To Name" >
                            {{ props.row.to_name }}
                        </b-table-column>

                        <b-table-column field="from_date" label="From Date" sortable>
                            {{ props.row.from_date }}
                        </b-table-column>

                        <b-table-column field="to_date" label="To Date" sortable>
                            {{ props.row.to_date }}
                        </b-table-column>

                        <b-table-column label="Status">

                            <div v-if="props.row.submit_action == 'published'">
                                <span class="tag is-success">
                                    Submitted
                                </span>
                            </div>
                            <div v-else>
                                <span class="tag is-warning">
                                    Draft
                                </span>
                            </div>

                        </b-table-column>
                    </template>
                    <template slot="detail" slot-scope="props">
                        <table-extra-data-row
                                :from_address_name="props.row.from_address_name"
                                :from_company_name="props.row.from_company_name"
                                :from_lat="props.row.from_lat"
                                :from_lng="props.row.from_lng"
                                :from_name="props.row.from_name"
                                :from_zip_code="props.row.from_zip_code"
                                :notes="props.row.note"
                                :to_address_name="props.row.to_address_name"
                                :to_company_name="props.row.to_company_name"
                                :to_lat="props.row.to_lat"
                                :to_lng="props.row.to_lng"
                                :to_name="props.row.to_name"
                                :to_zip_code="props.row.to_zip_code"
                                :submit_action="props.row.submit_action"
                                :packages="props.row.packages"
                                :rowId="props.row.id"
                        >

                        </table-extra-data-row>
                    </template>

                </b-table>

            </div>
        </div>

    </div>
</template>


<script>
    const today = new Date()
    export default {

        mounted() {

            this.getUserOffers()

        },
        methods: {
            openRow(row) {
                if(this.openedRows[0] !== row.id) {
                    this.openedRows = [];
                }

                this.$nextTick(() => {
                    this.$refs.table.toggleDetails(row);
                });
            },
            getUserOffers(){
                window.axios.post(
                    '/get-private-offers',
                    {

                    }
                ).then((res) => {
                    this.offers = res.data;
                    console.log(this.offers)
                    this.loader = false;
                }).catch((res) => {

                });
            },

        },
        data() {
            return {
                currentUserId:$("#details-helper").data('id'),
                currentUserName:$("#details-helper").data('name'),
                offers:[],
                fromNameSearch:'',
                toNameSearch:'',
                searchDraft:'-1',
                fromCreateSearch:new Date(today.getFullYear(), today.getMonth(), today.getDate() ),
                toCreateSearch:new Date(today.getFullYear(), today.getMonth(), today.getDate() ),
                isPaginated: true,
                loader: true,
                perPage: 12,
                openedRows:[],
            }
        },
        computed:{
            data(){

            if(this.searchDraft == '-1')
                {
                    return this.offers.filter((offer) => {
                        return offer.from_name.toLowerCase().indexOf(this.fromNameSearch.toLowerCase()) !== -1
                            && offer.to_name.toLowerCase().indexOf(this.toNameSearch.toLowerCase()) !== -1
                    });
                }else{

                return this.offers.filter((offer) => {
                    return offer.from_name.toLowerCase().indexOf(this.fromNameSearch.toLowerCase()) !== -1
                        && offer.to_name.toLowerCase().indexOf(this.toNameSearch.toLowerCase()) !== -1
                        && offer.submit_action == this.searchDraft
                });

              }
            }
        }
    }

</script>