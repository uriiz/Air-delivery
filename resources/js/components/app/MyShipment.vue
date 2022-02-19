<template>
    <div class="main-dashborad-in">

        <div class="main-table">

            <div class="main-table-title">
                <h3>My Account</h3>
            </div>
            <div class="wrap-profile-card-field">
                <div class="main-table-box my-account">

                    <div class="loader1" v-if="loader">
                        <img src="/images/loader1.png" class="rotating" alt="">
                    </div>
                    <div v-if="!loader">
                        <div style="margin:0 0 20px 0;" class="form-title">
                            <div class="title">
                                <img style="width:30px" src="/images/user2.svg">
                                <div> Details:</div>
                            </div>
                            <div style="display:none" class="change-password">
                                <a target="_blank" href="/password/reset">Change Password</a>
                            </div>
                        </div>
                        <div class="inputs-account">

                            <div class="wrap-input-flex">
                                <b-field
                                        label="Company Name *">
                                    <b-input
                                            rounded
                                            type="text"
                                            icon="worker"
                                            v-model="companyName"
                                            placeholder="Company Name"
                                            required
                                    >
                                    </b-input>
                                </b-field>
                            </div>

                            <div class="wrap-input-flex">
                                <b-field :type="{ 'is-danger': hasErrorFullName }"
                                         :message="{ 'this field is required': hasErrorFullName }"
                                         label="Contact Name *">
                                    <b-input
                                            rounded
                                            type="text"
                                            icon="account"
                                            v-model="FullName"
                                            placeholder="Contact Name"
                                            required>
                                    </b-input>
                                </b-field>
                            </div>

                            <div class="wrap-input-flex">
                                <b-field
                                         label="Company Phone">
                                    <b-input
                                            rounded
                                            type="tel"
                                            icon="phone"
                                            v-model="companyPhone"
                                            placeholder="Company Phone"
                                            >
                                    </b-input>
                                </b-field>
                            </div>

                            <div class="wrap-input-flex">
                                <b-field
                                        label="Contact Name Phone">
                                    <b-input
                                            rounded
                                            type="tel"
                                            icon="phone"
                                            v-model="phone"
                                            placeholder="Contact Name Phone"
                                    >
                                    </b-input>
                                </b-field>
                            </div>
                            <div class="wrap-input-flex">
                                <b-field
                                        label="Email">
                                    <b-input
                                            rounded
                                            type="text"
                                            icon="email"
                                            readonly
                                            v-model="email"
                                            placeholder="Full Name"
                                    >
                                    </b-input>
                                </b-field>
                            </div>
                            <div class="wrap-input-flex">
                            <div class="field">
                                <label class="label">Full Address *</label>
                                <div class="control has-icons-left is-clearfix">
                                    <GmapAutocomplete
                                            id="map2"
                                            autocomplete="off"
                                            required
                                            ref="address"
                                            class="input"
                                            placeholder="Full Address"
                                            @place_changed="AddressData"
                                            :value="address"
                                    >
                                    </GmapAutocomplete>
                                    <span class="icon is-left"><i class="mdi mdi-earth mdi-24px"></i></span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="wrap-input-flex">
                            <label style="display:block;font-weight: 500" >send me notifications email's ?</label>
                            <b-switch v-model="sendEmail"
                                      true-value="Yes"
                                      false-value="No">
                                {{ sendEmail }}
                            </b-switch>
                        </div>
                        <b-button
                                class="button is-success flex-btn"
                                @click.prevent="updateUser"
                                type="is-success"
                        >
                            <div>Update Profile</div>
                            <img v-if="loaderUpdate" style="width:25px" src="/images/loader.gif" alt="">
                        </b-button>

                        <div style="margin:40px 0 20px 0;" class="form-title">
                            <div class="title">
                                <img style="width:30px" src="/images/user2.svg">
                                <div> Upload Company Logo:</div>
                            </div>
                        </div>
                        <div class="upload-logo">
                            <vue2-dropzone id="myVueDropzone"

                                           v-on:vdropzone-sending="sendParameter"
                                           :timeout="90000"
                                           @vdropzone-complete="afterComplete"
                                           :options="myoptions"
                                           ref="myVueDropzone"
                            >
                            </vue2-dropzone>
                        </div>

                    </div>

                </div>

                <div class="card-profile" v-if="!loader">
                    <b-collapse class="card" aria-id="contentIdForA11y3">
                        <div
                                slot="trigger"
                                slot-scope="props"
                                class="card-header"
                                role="button"
                                aria-controls="contentIdForA11y3">
                            <p class="card-header-title">
                                My Card Profile
                            </p>

                        </div>
                        <div class="card-content">
                            <div class="user_img">
                                <div :style="{ 'background-image': 'url(' + image + ')' }"
                                     class="user-image-bg">
                                </div>
                            </div>
                            <div class="content" style="min-width: 250px">
                                <strong style="display:block">{{companyName}}</strong>
                                <p style="margin: 0" v-if="email">Email: {{email}}</p>
                                <p style="margin: 0" v-if="FullName">Contact Name: {{companyName}}</p>
                                <p style="margin: 0" v-if="phone">Contact Name Phone: {{phone}}</p>
                                <p style="margin: 0" v-if="companyPhone">Company Phone: {{companyPhone}}</p>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <a class="card-footer-item" @click="updateUser">
                                Save
                                <img v-if="loaderUpdate" style="width:25px" src="/images/loader.gif" alt="">
                            </a>

                        </footer>
                    </b-collapse>
                </div>
            </div>
        </div>

    </div>
</template>


<script>
    import Swal from 'sweetalert2'
    export default {

        mounted() {
            this.loadUserInfo()
        },
        methods: {
            AddressData: function (addressData) {

                this.lat = addressData.geometry.location.lat();
                this.lng = addressData.geometry.location.lng();
                this.address = addressData.formatted_address;

                let contryName = '';
                let contryCode = '';
                let cityName = '';
                for (let i = 0; i < addressData.address_components.length ; i++){

                    if(addressData.address_components[i].types.includes("country")){
                        contryName = addressData.address_components[i].long_name;
                    }

                    if(addressData.address_components[i].types.includes("locality")){
                        cityName = addressData.address_components[i].long_name;
                    }

                }
                this.country = contryName;
            },

            updateUser(){

                if(!this.FullName ){
                    return;
                }
                this.loaderUpdate = true
                window.axios.post(
                    '/update-user',
                    {
                        'name':this.FullName,
                        'is_email':this.sendEmail,
                        'company_name':this.companyName,
                        'company_phone':this.companyPhone,
                        'phone':this.phone,
                        'lat':this.lat,
                        'lng':this.lng,
                        'address':this.address,
                        'country':this.country,
                    }
                ).then((res) => {

                    if(res.data == 1) {
                        $('.user-profile h2 span').html(this.FullName)
                        Swal.fire(
                            'Good job!',
                            'You Profile Has Update',
                            'success'
                        )
                    }else{

                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!, try agein letter',
                            footer: ''
                        })
                    }
                    this.loaderUpdate = false
                }).catch((res) => {
                    this.loaderUpdate = false
                });
            },
            afterComplete(file) {
                this.image = file.dataURL

                $('.user-profile .user-image-bg').attr("style","background-image:url("+file.dataURL+")")
                //this.$refs.myVueDropzone.removeAllFiles();

            },


            sendParameter(file, xhr, formData){

                formData.append('_token', this.token);

            },

            loadUserInfo(){
                window.axios.post(
                    '/get-user',
                ).then((res) => {
                    if(res.data){
                        this.FullName = res.data.name;
                        this.companyName = res.data.company_name;
                        this.phone = res.data.phone;
                        this.companyPhone = res.data.company_phone;
                        this.email = res.data.email;
                        this.image = res.data.logo;
                        this.loader = false;
                        this.address = res.data.address;
                        console.log(res.data)

                    }
                }).catch((res) => {

                });
            },
        },
        data() {
            return {
                currentUserId:$("#details-helper").data('id'),
                currentUserName:$("#details-helper").data('name'),
                token:$('meta[name="csrf-token"]').attr('content'),
                FullName :'',
                companyName:'',
                companyPhone:'',
                image:'',
                fromSelectedAddress :'',
                zipCode :'',
                email :'',
                sendEmail :'Yes',
                phone:'',
                lat:'',
                lng:'',
                address:'',
                country:'',
                loaderUpdate:'',
                jobTitle:'',
                hasErrorFullName:false,
                hasErrorPhone:false,
                loader:true,
                myoptions:{
                    url:'/add-message-images',
                    acceptedFileTypes:".png,.jpg,.jpeg,.JPG",
                    maxFiles: 1,
                    thumbnailWidth: 150, // px
                    thumbnailHeight: 150,
                },
            }
        },
        computed:{


        }
    }

</script>
