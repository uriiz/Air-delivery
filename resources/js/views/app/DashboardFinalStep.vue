<template>
    <div class="main-dashboard">
        <header-dashboard></header-dashboard>
        <sidebar-app></sidebar-app>
    <div class="main-dashborad-in">
        <div class="main-table">
            <div class="filter-inputs">
                <div class="wrap-input">
                    <select @change="filterData" v-model="fromCountryName" class="input">
                        <option selected value="-1">From Country</option>
                        <option v-for="(c,index) in countries" :value="c.name">
                            {{c.name}}
                        </option>
                    </select>
                </div>
                <div class="wrap-input">
                    <select @change="filterData" v-model="toCountryName" class="input">
                        <option selected value="-1">To Country</option>
                        <option v-for="(c,index) in countries" :value="c.name">
                            {{c.name}}
                        </option>
                    </select>
                </div>
                <div class="wrap-input">
                    <select @change="filterData" v-model="packageType" class="input">
                        <option selected value="-1">Package Type</option>
                        <option value="General Cargo">General Cargo</option>
                        <option value="Cooling">Cooling</option>
                        <option value="Radioactive">Radioactive</option>
                        <option value="Food">Food</option>
                        <option value="Medicines">Medicines</option>
                    </select>
                </div>
            </div>
            <div class="main-table-title"><h3>Contacts</h3></div>
            <div class="main-table-box">
                <div class="loader1" v-if="loader">
                    <img src="/images/loader1.png" class="rotating" alt="">
                </div>
                <div v-if="!loader && data.length == 0">
                    <p>There is no new Confirmed Quotation... </p>
                    <a class="pretty-link" href="/app-dashboard">
                        New Quotation
                    </a>
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
                >
                    <template slot-scope="props">
                        <b-table-column field="id" label="Quotation ID">
                            <div @click="openRow(props.row)">
                                #{{ props.row.id }}
                            </div>
                        </b-table-column>

                        <b-table-column label="Price">
                           <div>
                               <strong>Cost:</strong>
                               {{ props.row.response.price_offer }}
                               {{ props.row.response.currency }}
                           </div>
                            <div>
                                <strong>Extra Cost:</strong>
                                {{ props.row.response.price_offer_extra }}
                                {{ props.row.response.currency_extra }}
                            </div>
                        </b-table-column>

                        <b-table-column field="from_date" label="From Date" sortable>
                            {{ props.row.from_date }}
                        </b-table-column>

                        <b-table-column field="to_date" label="To Date" sortable>
                            {{ props.row.to_date }}
                        </b-table-column>

                        <b-table-column label="From">
                            {{ props.row.from_country_name }}
                        </b-table-column>

                        <b-table-column label="To">
                            {{ props.row.to_country_name }}
                        </b-table-column>

                        <b-table-column label="Delete!">
                            <div style="cursor: pointer" class="delete-user" @click="deleteOfferFunction(props.row.response_id)">
                                <delete-svg></delete-svg>
                            </div>
                        </b-table-column>

                        <b-table-column field="to_date" label="Contact Details" >
                           <span @click="setOffer(props.row.id,props.row.details)" class="tag is-success action">
                               Contact Details
                           </span>
                        </b-table-column>
                    </template>
                    <template slot="detail" slot-scope="props">
                        <table-extra-data-row
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
                                :rowId="props.row.id"
                        >
                        </table-extra-data-row>
                    </template>
                </b-table>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    import SetOffer from '../../components/app/ConfirmedOffer'
    import Swal from 'sweetalert2'
    export default {
        mounted() {
            this.getCountries()
        },
        methods: {
            setOffer(id,details){
                this.$modal.open({
                    parent: this,
                    component: SetOffer,
                    props:{id:id,details:details},
                    hasModalCard: true
                })
            },
            filterData(){

            },
            deleteOfferFunction(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Once deleted, it is not possible to restore",
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                }).then((result) => {
                    if(result.value == 1){
                        window.axios.post(
                            '/app/delete-offer',{id:id}
                        ).then((res) => {
                            this.$store.commit('deleteOffer',id);
                        }).catch((res) => {});
                    }
                })
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
                    this.loader = false
                }).catch((res) => {});
            },
            filterCounries(){
                if(this.fromCountryName != -1 || this.toCountryName != -1) {
                    return this.$store.getters.getNewConfirmOffers.filter((offer) => {
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
                    return this.$store.getters.getNewConfirmOffers
                }
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
                perPage: 12,
                openedRows:[],
                fromCountryName:'-1',
                toCountryName:'-1',
                countries:[],
                packageType:'-1',
                loader:true,
            }
        },
        computed:{
            data(){
                let filters =  this.filterCounries();
                filters = this.filterPack(filters);
                return filters;
            }
        },
    }

</script>