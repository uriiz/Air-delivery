<template>
    <div class="main-form main-form-welcome">

        <form action="#">

            <div class="in-form-app" style="text-align:left">
                <div style="text-align: left" class="welcome-title">
                    <h1>Register As Company</h1>
                </div>
                <section>

                <b-field :type="{ 'is-danger': hasErrorCompanyName }"
                         :message="{ 'this field is required': hasErrorCompanyName }" label="Company Name *">
                    <b-input
                            type="text"
                            icon="folder-open"
                            v-model="companyName"
                            placeholder="Your Company Name"
                            required>
                    </b-input>
                </b-field>
                    <b-field :type="{ 'is-danger': hasErrorName }"
                             :message="{ 'this field is required': hasErrorName }" label="Contact Name *">
                        <b-input
                                type="text"
                                icon="worker"
                                v-model="name"
                                placeholder="Your Contact Name"
                                required>
                        </b-input>
                    </b-field>

                    <b-field
                            :type="{ 'is-danger': hasErrorCompanyPhone }"
                            :message="{ 'please insert a current phone number': hasErrorCompanyPhone }"
                            label="Company Phone">
                        <b-input
                                type="tel"
                                icon="phone"
                                v-model="companyPhone"
                                placeholder="Your Company Phone"
                                >
                        </b-input>
                    </b-field>

                    <b-field label="Private Phone">
                        <b-input
                                type="tel"
                                icon="phone"
                                v-model="phone"
                                placeholder="Your Private Phone"
                                >
                        </b-input>
                    </b-field>

                    <b-field
                            :type="{ 'is-danger': hasErrorEmail }"
                            :message="{ 'please insert a current email address': hasErrorEmail }"
                            label="Email *">

                        <b-input
                                type="email"
                                icon="email"
                                v-model="email"
                                placeholder="Your Email"
                                required
                        >
                        </b-input>
                    </b-field>

                    <b-field
                            :type="{ 'is-danger': hasErrorPass }"
                            :message="{ 'the password must be at least 8 characters': hasErrorPass }"
                            label="Password *">
                        <b-input
                                type="password"
                                minlength="8"
                                v-model="password"
                                password-reveal
                                icon="json"

                                placeholder="Your password"
                                required>
                        </b-input>
                    </b-field>
                </section>
                <div class="btns-wrap">
                    <div style="margin-bottom:16px" class="">
                        <b-checkbox
                                @input="checkPress"
                                v-model="terms">I agree to post my personal information  that I have now submitted to companies in order to receive quotations</b-checkbox>
                        <div v-if="hasErrorTerm">
                            <p class="help is-danger">please confirm the terms</p>
                        </div>
                    </div>


                    <button type="submit" @click.prevent="submit" class="button is-primary">
                        <span>Register</span>
                        <img v-if="loader" style="width:25px" src="/images/loader.gif" alt="">
                    </button>
                </div>
            </div>


        </form>

    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        methods: {

            validatePhone(inputtxt){
                    return true;
                    if(!inputtxt){
                        return false
                    }
                    var phoneno = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
                    if(inputtxt.match(phoneno))
                    {
                        return true;
                    }
                    else
                    {

                        return false;
                    }

            },
            validateEmail(email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            },

            checkPress(){
                let err = false

                if(!this.name){
                    this.hasErrorName = true
                    err = true
                }else{
                    this.hasErrorName = false
                }

                if(!this.companyName){
                    this.hasErrorCompanyName = true
                    err = true
                }else{
                    this.hasErrorCompanyName = false
                }

                if(!this.validatePhone(this.companyPhone)){
                    this.hasErrorCompanyPhone = true
                    err = true
                }else{
                    this.hasErrorCompanyPhone = false
                }

                if(!this.terms){
                    this.hasErrorTerm = true
                    err = true
                }else{
                    this.hasErrorTerm = false
                }

                if(!this.validateEmail(this.email)){
                    this.hasErrorEmail = true
                    err = true
                }else{
                    this.hasErrorEmail = false
                }

                if(this.password < 8){
                    this.hasErrorPass = true
                    err = true
                }else{
                    this.hasErrorPass = false
                }


                if(err){
                    return false;
                }
                return true
            },

            submit() {

                if(!this.checkPress()){
                    return
                }
                this.loader = true;
                window.axios.post(
                    '/register',
                    {
                        'email':this.email,
                        'name':this.name,
                        'password':this.password,
                        'password_confirmation':this.password,
                        'remember':true,
                        'company_name':this.companyName,
                        'role':2,
                        'job_title':'',
                        'lat':'',
                        'lng':'',
                        'address':'',
                        'zip_code':'',
                        'confirm_term':1,
                        'confirm_mail':false,
                        'phone':this.phone,


                    }
                ).then((res) => {
                    this.loader = false;
                    Swal.fire(
                        'Good job!',
                        'You Profile Has Update',
                        'success'
                    )
                    Swal.fire({
                        title: 'Good job!',
                        text: "Your request has been successfully received, please wait for your confirmation to be sent to the email address you left",
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Ok',

                    }).then((result) => {
                        window.location.href = "/";
                    })
                }).catch((res) => {
                    this.loader = false;

                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'The email has already been taken. ):',
                        footer: ''
                    })
                });
            }
        },
        data() {
            return {

                email:'',
                name:'',
                password:'',
                companyName:'',
                password_confirmation:'',
                hasErrorName:false,
                hasErrorCompanyName:false,
                hasErrorCompanyPhone:false,
                hasErrorEmail:false,
                hasErrorPass:false,
                hasErrorTerm:false,
                companyPhone:'',
                terms:false,
                error:true,
                errorLogin:'',
                phone:'',
                loader:false,

            }
        },
    }
</script>