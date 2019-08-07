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

                        <b-table-column label="Price" >
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

                        <b-table-column field="to_date" label="From" >
                            {{ props.row.from_country_name }}
                        </b-table-column>

                        <b-table-column field="to_date" label="To" >
                            {{ props.row.to_country_name }}
                        </b-table-column>

                        <b-table-column label="Delete!">
                            <div style="cursor: pointer" class="delete-user" @click="deleteOfferFunction(props.row.response_id)">
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
            // loader(){
            //     if(this.$store.getters.getNewConfirmOffers.length > 0){
            //         return false
            //     }else{
            //         return true
            //     }
            // },

            data(){

                let filters =  this.filterCounries();
                filters = this.filterPack(filters);
                return filters;
            }
        },
    }

</script>