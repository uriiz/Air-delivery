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
                    </div>

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
                                <img :src="image" alt="" class="mCS_img_loaded"></div>
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
                            <a class="card-footer-item">Save</a>

                        </footer>
                    </b-collapse>
                </div>
            </div>
        </div>

    </div>
</template>


<script>

    export default {

        mounted() {

            this.loadUserInfo()

        },
        methods: {
            afterComplete(file) {
                this.image = file.dataURL
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
                        this.CompanyName = res.data.company_name;
                        this.email = res.data.email;
                        this.Address = res.data.address;
                        this.phone = res.data.phone;
                        this.zipCode = res.data.zip_code;
                        this.jobTitle = res.data.job_title;
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
                image:'https://my.tranzila.com/assets/images/master/user_profile.jpg',
                fromSelectedAddress :'',
                zipCode :'',
                email :'',
                phone:'',
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