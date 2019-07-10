<template>
    <div class="main-form">
        <div class="triancle"></div>
        <div class="form-title">
           <div class="title">
               <img src="/images/profile_icon.png">
              <div> From:</div>
           </div>
            <div>
                <div class="field">
                    <b-switch v-model="isFromMe"
                              type="is-danger"
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
            <b-field label="Full Name *">
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
                <div class="control has-icons-left is-clearfix">
                    <GmapAutocomplete
                            id="map"
                            required
                            ref="address"
                            class="input"
                            :value="fromSelectedAddress"
                            placeholder="Full Address"
                            @place_changed="getAddressData"
                    >
                    </GmapAutocomplete>
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
                <img src="/images/profile_icon.png">
                <div> To:</div>
            </div>
            <div>

            </div>
        </div>
        <div class="form-top">
            <section>
                <b-field label="Full Name *">
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
                    <div class="control has-icons-left is-clearfix">
                        <GmapAutocomplete
                                id="map2"
                                required
                                ref="address"
                                class="input"
                                :value="toSelectedAddress"
                                placeholder="Full Address"
                                @place_changed="getAddressData"
                        >
                        </GmapAutocomplete>
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

    </div>
</template>

<script>
    const today = new Date()
    import Swal from 'sweetalert2'
    export default {

        mounted() {

            this.loadUserInfo()

        },
        data: function () {

            return {
                currentUserId:$("#details-helper").data('id'),
                lat:0,
                lng:0,
                isFromMe:'from me',
                date: new Date(),
                minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() ),
                maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5),
                fromFullName: '',
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

            }
        },
        methods: {

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
                        this.fromSelectedAddress = res.data.address;
                        this.fromZipCode = res.data.zip_code;

                        this.FullName = res.data.name;
                        this.CompanyName = res.data.company_name;
                        this.SelectedAddress = res.data.address;
                        this.ZipCode = res.data.zip_code;
                    }
                }).catch((res) => {

                });
            },

            checkUser(){

                if(!this.currentUserId) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You need to be logged in!',
                        footer: '<a href="#">Not yet registered?</a>'
                    })
                    return;
                }
            },
            getAddressData: function (addressData) {
                this.lat = addressData.geometry.location.lat();
                this.lng = addressData.geometry.location.lng();
                console.log(addressData)
            },
            submit(){
                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                )
            },
        }
    }
</script>