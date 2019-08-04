<template>
    <div>

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
                            <b-field :type="{ 'is-danger': hasErrorFullName }"
                                     :message="{ 'this field is required': hasErrorFullName }"
                                     label="Full Name *">
                                <b-input
                                        rounded
                                        type="text"
                                        icon="account"
                                        v-model="FullName"
                                        placeholder="Full Name"
                                        required>
                                </b-input>
                            </b-field>
                        </div>

                        <div class="wrap-input-flex">
                            <b-field :type="{ 'is-danger': hasErrorPhone }"
                                     :message="{ 'this field is required': hasErrorPhone }"
                                     label="phone *">
                                <b-input
                                        rounded
                                        type="text"
                                        icon="phone"
                                        v-model="phone"
                                        placeholder="Phone"
                                        required>
                                </b-input>
                            </b-field>
                        </div>

                        <div class="wrap-input-flex">
                            <b-field
                                     label="Company Name">
                                <b-input
                                        rounded
                                        type="text"
                                        icon="worker"
                                        v-model="companyName"
                                        placeholder="Company Name"
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
                            <b-field
                                    label="Zip Code">
                                <b-input
                                        rounded
                                        type="text"
                                        icon="meteor"
                                        v-model="zipCode"
                                        placeholder="Zip Code"
                                >
                                </b-input>
                            </b-field>
                        </div>

                        <div class="wrap-input-flex">
                            <b-field
                                    label="Job Title">
                                <b-input
                                        rounded
                                        type="text"
                                        icon="worker"
                                        v-model="jobTitle"
                                        placeholder="Job Title"
                                >
                                </b-input>
                            </b-field>
                        </div>
                        <div class="wrap-input-flex">
                            <label style="display:block;font-weight: 500" >send me notifications email's ?</label>
                            <b-switch v-model="sendEmail"
                                      true-value="Yes"
                                      false-value="No">
                                {{ sendEmail }}
                            </b-switch>
                        </div>
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
                                <strong style="display:block">{{FullName}}</strong>
                                <p style="margin: 0" v-if="email">Email: {{email}}</p>
                                <p style="margin: 0" v-if="companyName">Company: {{companyName}}</p>
                                <p style="margin: 0" v-if="phone">Phone: {{phone}}</p>
                                <!--<p style="margin: 0" v-if="Address">Address: {{Address}}</p>-->
                                <!--<p style="margin: 0" v-if="zipCode">Zip Code: {{zipCode}}</p>-->
                                <p style="margin: 0" v-if="jobTitle">Job Title: {{jobTitle}}</p>

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


            updateUser(){
                if(!this.FullName || this.phone < 8 ){
                   return;
                }
                this.loaderUpdate = true
                window.axios.post(
                    '/update-user',
                    {
                        'email':this.email,
                        'name':this.FullName,
                        'job_title':this.jobTitle,
                        'company_name':this.companyName,
                        'zip_code':this.zipCode,
                        'phone':this.phone,
                        'is_email':this.sendEmail,
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
                        this.email = res.data.email;
                        this.Address = res.data.address;
                        this.phone = res.data.phone;
                        this.zipCode = res.data.zip_code;
                        this.jobTitle = res.data.job_title;
                        this.image = res.data.logo;
                        this.loader = false;
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
                image:'',
                fromSelectedAddress :'',
                zipCode :'',
                email :'',
                sendEmail :'Yes',
                phone:'',
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
