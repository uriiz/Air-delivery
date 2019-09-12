<template>
    <div class="main-dashborad-in">
        <div class="main-table">

            <div class="main-table-title"><h3>New Quotations</h3></div>
            <div class="main-table-box">
                <div class="loader1" v-if="loader">
                    <img src="/images/loader1.png" class="rotating" alt="">
                    <p>There is no new Quotation... </p>
                </div>
                <b-table
                        v-if="!loader && data.length > 0"
                        :data="data"
                        detail-key="id"
                        ref="table"
                        :paginated="isPaginated"
                        :per-page="perPage"
                        :openedDetailed="openedRows"
                        detailed
                        :row-class="onRowClass"
                >

                    <template slot-scope="props">
                        <b-table-column field="id" label="Quotation ID">
                            <div @click="openRow(props.row)">
                                #{{ props.row.id }}
                            </div>
                        </b-table-column>

                        <b-table-column field="pretty_time" label="Created" sortable>
                            {{ props.row.pretty_time }}
                        </b-table-column>

                        <b-table-column field="from_date" label="Pick Up Date" sortable>
                            {{ props.row.from_date }}
                        </b-table-column>

                        <b-table-column field="from_country_name" label="From" sortable>
                            {{ props.row.from_country_name }}
                        </b-table-column>

                        <b-table-column field="to_country_name" label="To" sortable>
                            {{ props.row.to_country_name }}
                        </b-table-column>

                        <b-table-column label="Status" >
                            <div v-if="props.row.submit_action == 'published'">
                                <span class="tag is-warning">
                                    Published
                                </span>
                            </div>
                            <div v-if="props.row.submit_action == 'complete'">
                                <span class="tag is-success">
                                    Complete
                                </span>
                            </div>

                            <div v-if="props.row.submit_action == 'expired'">
                                <span class="tag is-danger">
                                    Expired
                                </span>
                            </div>
                        </b-table-column>

                        <b-table-column field="to_date" label="Set Your Offer" >
                           <span @click="setOffer(props.row.id)" class="tag is-success action">
                               Set Your Quotation !
                           </span>
                        </b-table-column>

                        <b-table-column label="Delete!" >
                            <div style="cursor: pointer" class="delete-user" @click="deleteOffer(props.row.id)">
                                <delete-svg></delete-svg>
                            </div>
                        </b-table-column>
                    </template>
                    <template slot="detail" slot-scope="props">
                        <table-extra-data-row
                                :from_address_name="checkIfCity(props.row.from_city_name) + ',' +props.row.from_country_name "
                                :from_company_name="props.row.from_company_name"
                                :to_company_name="props.row.to_company_name"
                                :from_lat="props.row.from_lat"
                                :from_lng="props.row.from_lng"
                                :from_zip_code="props.row.from_zip_code"
                                :notes="props.row.note"
                                :commodity="props.row.commodity"
                                :to_address_name="checkIfCity(props.row.to_city_name) + ',' +props.row.to_country_name"
                                :to_lng="props.row.to_lng"
                                :to_zip_code="props.row.to_zip_code"
                                :packages="props.row.packages"
                                :rowId="props.row.id"
                                :type="type"
                        >
                        </table-extra-data-row>
                    </template>
                </b-table>
            </div>
        </div>
    </div>
</template>

<script>
    import SetOffer from './SetOffer'
    import Swal from 'sweetalert2'
    export default {
        mounted() {
            this.getCountries()
        },
        methods: {
            checkIfCity(city){

                if(!city){
                    return ''
                }
                return city;
            },
            deleteOffer(id){
                Swal.fire({
                    title: 'sure?',
                    text: "There will be no turning back ):",
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if(result.value == 1){
                        window.axios.post(
                            '/app/delete-offer-custom',{id:id}
                        ).then((res) => {
                            this.$store.commit('deleteAppOffer',id);
                        }).catch((res) => {});
                    }
                })
            },
            setOffer(id){
                this.$modal.open({
                    parent: this,
                    component: SetOffer,
                    props:{id:id,},
                    hasModalCard: true
                })
            },
            filterData(){

            },
            openRow(row) {
                if(this.openedRows[0] !== row.id) {
                    this.openedRows = [];
                }

                this.$nextTick(() => {
                    this.$refs.table.toggleDetails(row);
                });
            },

            getCountries(){
                window.axios.post(
                    '/get-countries',
                ).then((res) => {
                    this.countries = res.data;
                }).catch((res) => {});
            },

                filterCounries(){

                if(this.fromCountryName != -1 || this.toCountryName != -1) {
                    return this.$store.getters.getNewOffers.filter((offer) => {
                        if(this.fromCountryName != -1 &&  this.toCountryName == -1){
                            return offer.from_country_name == this.fromCountryName
                        }
                        if(this.fromCountryName == -1 &&  this.toCountryName != -1){
                            return offer.to_country_name == this.toCountryName
                        }
                        if(this.fromCountryName != -1 &&  this.toCountryName != -1){
                            return offer.to_country_name == this.toCountryName
                                && offer.from_country_name == this.fromCountryName

                        }
                        return this.offers
                    });
                }else{
                    return this.$store.getters.getNewOffers
                }
            },
            onRowClass: function (row, index) {
               return 'row-status-'+row.submit_action ;
            },
            filterPack(filters){
                if(this.packageType != -1)
                {

                    let packArr = [];
                    let ids = [];
                    let arrFilterIds = [];

                    for(let j = 0; j < filters.length; j++) {

                        for (let i = 0; i < filters[j].packages.length; i++) {
                            if (filters[j].packages[i].package_type == this.packageType) {
                                packArr.push(filters[j])
                            }
                        }

                    }


                    for(let x =0;x<packArr.length;x++){

                        if(ids.includes(packArr[x].id)){

                        }else{
                            arrFilterIds.push(packArr[x])
                        }
                        ids.push(packArr[x].id)
                    }

                    return arrFilterIds;

                }
                return filters;
            },
        },
        data() {
            return {
                currentUserId:$("#details-helper").data('id'),
                currentUserName:$("#details-helper").data('name'),
                offers:[],
                isPaginated: true,
                type: 'forwarder',
                perPage: 12,
                openedRows:[],
                fromCountryName:'-1',
                toCountryName:'-1',
                countries:[],
                packageType:'-1',
            }
        },
        computed:{
            loader(){
               if(this.$store.getters.getNewOffers.length > 0){
                   return false
               }else{
                   return true
               }
            },

            data(){
                let filters =  this.filterCounries();
                filters = this.filterPack(filters);
                return filters;
            }
        },
    }

</script>