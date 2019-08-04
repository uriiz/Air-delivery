<template>
    <div class="main-form">
        <div class="triancle"></div>
        <div class="form-title">
           <div class="title">
               <img style="width:30px" src="/images/user.svg">
              <div> From:</div>
           </div>
            <div>
                <div class="field">
                    <b-switch v-model="isFromMe"
                              @input="switchFromTo"
                              true-value="from me"
                              false-value="to me">
                        {{ isFromMe }}
                    </b-switch>
                </div>
            </div>
        </div>
        <div class="form-top">
        <section>
            <b-field label="Full Name *"
                     :type="{ 'is-danger': hasErrorFromFullName }"
                     :message="{ 'this field is required': hasErrorFromFullName }">
                <b-input
                        type="text"
                        icon="account"
                        @input="checkUser"
                        v-model="fromFullName"
                        placeholder="Full Name"
                        required>
                </b-input>
            </b-field>

            <b-field label="Company Name">
                <b-input
                        type="text"
                        icon="worker"
                        @input="checkUser"
                        v-model="fromCompanyName"
                        placeholder="Company Name"
                        >
                </b-input>
            </b-field>

            <div class="field">
                <label class="label">Full Address *</label>
                <div class="control has-icons-left is-clearfix"
                     :class="{ 'has-icons-right': hasErrorFromLat }">

                    <GmapAutocomplete
                            id="map"
                            required
                            ref="address"
                            autocomplete="off"
                            lang="EN"
                            class="input"
                            :class="{ 'is-danger': hasErrorFromLat }"
                            placeholder="Full Address"
                            @place_changed="getFromAddressData"
                    >
                    </GmapAutocomplete>
                    <p v-if="hasErrorFromLat" class="help is-danger">this field is required</p>
                    <span v-if="hasErrorFromLat" class="icon is-right has-text-danger"><i class="mdi mdi-alert-circle mdi-24px"></i></span>
                    <span class="icon is-left"><i class="mdi mdi-earth mdi-24px"></i></span>
                </div>
            </div>

            <b-field label="Zip Code">
                <b-input
                        type="text"
                        icon="meteor"
                        @input="checkUser"
                        v-model="fromZipCode"
                        placeholder="Zip Code"
                >
                </b-input>
            </b-field>
        </section>
        </div>
        <div class="form-title">
            <div class="title">
                <img style="width:30px" src="/images/user2.svg">
                <div> To:</div>
            </div>
            <div>

            </div>
        </div>
        <div class="form-top">
            <section>
                <b-field :type="{ 'is-danger': hasErrorToFullName }"
                         :message="{ 'this field is required': hasErrorToFullName }"
                        label="Full Name *">
                    <b-input
                            type="text"
                            icon="account"
                            @input="checkUser"
                            v-model="toFullName"
                            placeholder="Full Name"
                            required>
                    </b-input>
                </b-field>

                <b-field label="Company Name">
                    <b-input
                            type="text"
                            icon="worker"
                            @input="checkUser"
                            v-model="toCompanyName"
                            placeholder="Company Name"
                    >
                    </b-input>
                </b-field>

                <div class="field">
                    <label class="label">Full Address *</label>
                    <div class="control has-icons-left is-clearfix" :class="{ 'has-icons-right': hasErrorToLat }">
                        <GmapAutocomplete
                                id="map2"
                                autocomplete="off"
                                required
                                ref="address"
                                class="input"
                                :class="{ 'is-danger': hasErrorToLat }"
                                placeholder="Full Address"
                                @place_changed="getToAddressData"
                        >
                        </GmapAutocomplete>
                        <p v-if="hasErrorToLat" class="help is-danger">this field is required</p>
                        <span v-if="hasErrorToLat" class="icon is-right has-text-danger"><i class="mdi mdi-alert-circle mdi-24px"></i></span>
                        <span class="icon is-left"><i class="mdi mdi-earth mdi-24px"></i></span>

                    </div>
                </div>

                <b-field label="Zip Code">
                    <b-input
                            type="text"
                            icon="meteor"
                            @input="checkUser"
                            v-model="toZipCode"
                            placeholder="Zip Code"
                    >
                    </b-input>
                </b-field>
            </section>
        </div>

        <div class="form-title">
            <div class="title">
                <img style="width:30px" src="/images/tracking.svg">
                <div> Shipment Information:</div>
            </div>
            <div>

            </div>
        </div>
        <div>
            <b-table
                    :data="data"
                    >
                <template slot-scope="props">

                    <b-table-column label="" width="40">
                        <div class="wrap-del-index">

                            <div class="delete-tab" @click="deleteRow( props.row.id )">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                                        <g fill="none" fill-rule="evenodd">
                                            <circle cx="12.5" cy="12.5" r="12.5" fill="#FE004C" fill-rule="nonzero"/>
                                            <path fill="#FFF" stroke="#FFF" d="M18.636 7.74l-.74-.74-5.078 5.078L7.74 7 7 7.74l5.078 5.078L7 17.896l.74.74 5.078-5.077 5.078 5.077.74-.74-5.077-5.078z"/>
                                        </g>
                                    </svg>
                            </div>
                            <div>
                                {{props.index+1}}
                            </div>
                        </div>
                    </b-table-column>


                    <b-table-column centered width="150" field="package_quantity" label="Quantity (cm)">
                        <b-field>
                            <div class="range-tab">
                                <b-numberinput v-model="props.row.package_quantity" min="0">
                                </b-numberinput>
                            </div>
                        </b-field>
                    </b-table-column>

                    <b-table-column centered width="150" field="package_width" label="Width (cm)">
                        <div class="range-tab">
                            <b-numberinput v-model="props.row.package_width" min="0">
                            </b-numberinput>
                        </div>
                    </b-table-column>

                    <b-table-column centered width="150"  field="package_height" label="Height (cm)">
                        <div class="range-tab">
                            <b-numberinput v-model="props.row.package_height" min="0">
                            </b-numberinput>

                        </div>
                    </b-table-column>

                    <b-table-column centered width="150" field="package_length" label="Length (cm)">
                        <div class="range-tab">
                            <b-numberinput v-model="props.row.package_length" min="0">
                            </b-numberinput>
                        </div>
                    </b-table-column>
                    <b-table-column centered width="150" field="package_weight" label="Weight (kg)">
                        <div class="range-tab">
                            <b-numberinput v-model="props.row.package_weight" min="0">
                            </b-numberinput>
                        </div>
                    </b-table-column>
                    <b-table-column width="200" field="package_type" label="Type">
                        <select class="input" v-model="props.row.package_type">
                            <option value="General Cargo">General Cargo</option>
                            <option value="Cooling">Cooling</option>
                            <option value="Radioactive">Radioactive</option>
                            <option value="Food">Food</option>
                            <option value="Medicines">Medicines</option>
                        </select>
                    </b-table-column>
                </template>

            </b-table>

            <div class="add-package" @click="addRow">
                <div class="add-package-circle">
                    <div class="add-package-circle-bg">
                        +
                    </div>
                </div>
                <div>
                    Add Package
                </div>
            </div>
        </div>

        <div class="form-title">
            <div class="title">
                <img style="width: 30px" src="/images/calendar.svg">
                <div> Pick Up Dates:</div>
            </div>
            <div>

            </div>
        </div>
        <section>
            <b-field label="Pickup Date">
                <b-datepicker
                        v-model="fromDate"
                        :min-date="minDate"
                        @input="filterDateFrom"
                        :mobile-native="false"
                        placeholder="Click to select..."
                        icon="calendar-today">
                </b-datepicker>
            </b-field>
            <b-field label="Deliver Date">
                <b-datepicker
                        :min-date=fromDate
                        v-model="toDate"
                        @input="filterDateTo"
                        :mobile-native="false"
                        placeholder="Click to select..."
                        icon="calendar-today">
                </b-datepicker>
            </b-field>
        </section>

        <div class="form-title">
            <div class="title">
                <img style="width:30px;" src="/images/notepad.svg">
                <div> Notes:</div>
            </div>
            <div>

            </div>
        </div>
        <section>
            <b-field label="Notes">

                <b-input maxlength="600" type="textarea" v-model="notes"></b-input>
            </b-field>
        </section>

        <div class="submit-form" v-if="currentUserId">
            <b-button :disabled="loaderSub" @click="submit('submit')" type="is-success">
                <div>Submit Offer</div>
                <img v-if="loaderSub" style="width:25px" src="/images/loader.gif" alt="">
            </b-button>
            <b-button :disabled="loaderDraft" @click="submit('draft')" type="is-warning">
                <div>Save Draft</div>
                <img v-if="loaderDraft" style="width:25px" src="/images/loader.gif" alt="">
            </b-button>
        </div>

        <div class="submit-form" v-else>
            <b-button disabled type="is-success">
                Submit Offer

            </b-button>
            <b-button disabled type="is-warning">Save Draft

            </b-button>
        </div>

    </div>
</template>

<script>
    const today = new Date()
    import Swal from 'sweetalert2'
    export default {

        mounted() {

            this.loadUserInfo()
            this.addRow();
        },
        data: function () {

            return {
                currentUserId:$("#details-helper").data('id'),
                fromLat:0,
                loadDraft:0,
                fromLng:0,
                loadSubmit:false,
                toLat:0,
                toLng:0,
                fromCountryName:'',
                fromCountryCode:'',
                toCountryName:'',
                toCountryCode:'',
                fromAddressName:'',
                toAddressName:'',
                fromAddressId:'',
                toAddressId:'',
                isFromMe:'from me',
                date: new Date(),
                minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() ),
                maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5),
                fromFullName: '',
                packType: '',
                fromCompanyName: '',
                fromSelectedAddress: '',
                fromZipCode: '',
                toFullName: '',
                toCompanyName: '',
                toSelectedAddress: '',
                toZipCode: '',
                FullName: '',
                CompanyName: '',
                SelectedAddress: '',
                ZipCode: '',
                fromDate:new Date(today.getFullYear(), today.getMonth(), today.getDate() ),
                toDate:new Date(today.getFullYear(), today.getMonth(), today.getDate() ),
                data: [ ],
                hasErrorFromFullName:false,
                hasErrorFromLat:false,
                hasErrorToFullName:false,
                hasErrorToLat:false,
                hasErrorPack:false,
                loaderSub:false,
                loaderDraft:false,
                submitAction:false,
                notes:'',
            }
        },
        methods: {

            validate(){

                let err = false

                // for(let i = 0;i < this.data.length ; i++){
                //     console.log(this.data[i].package_name)
                //     if(! this.data[i].package_name){
                //         $('.description'+i).addClass('has-err');
                //         this.hasErrorPack = true;
                //         err = true
                //     }else{
                //         this.hasErrorPack = false
                //         $('.description'+i).removeClass('has-err')
                //     }
                // }

                if(!this.fromFullName){
                    this.hasErrorFromFullName = true
                    err = true
                }else{
                    this.hasErrorFromFullName = false
                }
                if(!this.fromLat){
                    this.hasErrorFromLat = true
                    err = true
                }else{
                    this.hasErrorFromLat = false
                }
                if(!this.toFullName){
                    this.hasErrorToFullName = true
                    err = true
                }else{
                    this.hasErrorToFullName = false
                }
                if(!this.toLat){
                    this.hasErrorToLat = true
                    err = true
                }else{
                    this.hasErrorToLat = false
                }

                if(err){
                    return false;
                }
                return true

            },

            submit(type){

                if(this.validate()){
                    if(type == 'submit'){

                        this.loaderSub = true;
                        this.submitAction = true
                    }else{
                        this.submitAction = false
                        this.loaderDraft = true;
                    }

                    window.axios.post(
                        '/save-offer',
                        {
                            'submit_action':this.submitAction,
                            'from_name':this.fromFullName,
                            'from_company_name':this.fromCompanyName,
                            'from_lat':this.fromLat,
                            'from_lng':this.fromLng,
                            'from_address_name':this.fromAddressName,
                            'from_address_id':this.fromAddressId,
                            'from_zip_code':this.fromZipCode,
                            'to_name':this.toFullName,
                            'to_company_name':this.toCompanyName,
                            'to_lat':this.toLat,
                            'to_lng':this.toLng,
                            'to_address_name':this.toAddressName,
                            'to_address_id':this.toAddressId,
                            'to_zip_code':this.toZipCode,
                            'pack':this.data,
                            'from_date':this.fromDate,
                            'to_date':this.toDate,
                            'note':this.notes,
                            'to_country_name':this.toCountryName,
                            'to_country_code':this.toCountryCode,
                            'from_country_name':this.fromCountryName,
                            'from_country_code':this.fromCountryCode,
                            'pack_type':this.packType,
                        }
                    ).then((res) => {
                        if(res.data != 0) {
                           // window.location.href = "/dashboard/my-offers";
                        }else{
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'something went wrong ):',
                                footer: ''
                            })
                        }
                        this.loaderSub = false;
                        this.loaderDraft = false;
                    }).catch((res) => {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'something went wrong ):',
                            footer: ''
                        });
                        this.loaderSub = false;
                        this.loaderDraft = false;
                    });
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Please fill all required fields',
                        footer: ''
                    })
                    this.loaderSub = false;
                    this.loaderDraft = false;
                    return;
                }

            },

            deleteRow(id){
                if( this.data.length == 1) {
                    return;
                }
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false,
                })

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        this.data = this.data.filter(x => x.id !== id)
                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                      return
                    }
                })

            },
            addRow(){
                this.data.push({
                    'id': Math.floor(Math.random() * Number(new Date())),
                    'package_quantity':1,
                    'package_width':1,
                    'package_height':1,
                    'package_length':1,
                    'package_weight':1,
                    'package_type':'General Cargo',


                });
            },
            filterDateFrom(){
                this.toDate = this.fromDate
            },
            filterDateTo(){

            },
            switchFromTo(){

                if(this.isFromMe == 'from me'){

                    this.fromFullName = this.FullName;
                    this.fromCompanyName = this.CompanyName;
                    this.fromSelectedAddress = this.SelectedAddress;
                    this.fromZipCode = this.ZipCode;

                    this.toFullName = '';
                    this.toCompanyName = '';
                    this.toSelectedAddress = '';
                    this.toZipCode = '';
                }else{

                    this.toFullName = this.FullName;
                    this.toCompanyName = this.CompanyName;
                    this.toSelectedAddress = this.SelectedAddress;
                    this.toZipCode = this.ZipCode;

                    this.fromFullName = '';
                    this.fromCompanyName = '';
                    this.fromSelectedAddress = '';
                    this.fromZipCode = '';
                }

            },
            loadUserInfo(){
                window.axios.post(
                    '/get-user',
                ).then((res) => {
                    if(res.data){
                        this.fromFullName = res.data.name;
                        this.fromCompanyName = res.data.company_name;
                        this.fromSelectedAddress = '';
                        this.fromZipCode = res.data.zip_code;
                        this.FullName = res.data.name;
                        this.CompanyName = res.data.company_name;
                        this.SelectedAddress = '';
                        this.ZipCode = res.data.zip_code;
                    }
                }).catch((res) => {

                });
            },

            checkUser(){

                if(!this.currentUserId) {
                    window.location.href = "/?login=1";
                    return;
                }
            },
            getFromAddressData: function (addressData) {

                this.fromLat = addressData.geometry.location.lat();
                this.fromLng = addressData.geometry.location.lng();
                this.fromAddressName = addressData.formatted_address;
                this.fromAddressId = addressData.place_id;
                let contryName = '';
                let contryCode = '';
                for (let i = 0; i < addressData.address_components.length ; i++){

                    if(addressData.address_components[i].types.includes("country")){
                        contryName = addressData.address_components[i].long_name;
                        contryCode = addressData.address_components[i].short_name;
                    }

                }
                this.fromCountryName = contryName;
                this.fromCountryCode = contryCode;


            },
            getToAddressData: function (addressData) {

                this.toLat = addressData.geometry.location.lat();
                this.toLng = addressData.geometry.location.lng();

                this.toAddressName = addressData.formatted_address;
                this.toAddressId = addressData.place_id;
                let contryName = '';
                let contryCode = '';
                for (let i = 0; i < addressData.address_components.length ; i++){

                    if(addressData.address_components[i].types.includes("country")){
                        contryName = addressData.address_components[i].long_name;
                        contryCode = addressData.address_components[i].short_name;
                    }

                }
                this.toCountryName = contryName;
                this.toCountryCode = contryCode;

            },

        }
    }
</script>
