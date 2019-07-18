<template>
    <form action="">
        <div class="modal-card modal-card-register" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">Register</p>
                <a style="color:#000;text-decoration: underline"  href="/?login=1">Already Registered?</a>
            </header>
            <section class="modal-card-body">


                <b-steps v-model="activeStep" :animated="isAnimated" :has-navigation="hasNavigation">
                    <b-step-item label="Personal Details" :clickable="isStepsClickable">

                        <b-field label="Full Name *">
                            <b-input
                                    type="text"
                                    icon="account"
                                    @input="checkNext"
                                    v-model="name"
                                    placeholder="Your Full Name"
                                    required
                            >
                            </b-input>
                        </b-field>

                        <b-field label="Email *">
                            <b-input
                                    type="email"
                                    icon="email"
                                    @input="checkNext"
                                    v-model="email"
                                    placeholder="Your email"
                                    required>
                            </b-input>
                        </b-field>


                        <b-field label="Password *">
                            <b-input
                                    type="password"
                                    minlength="8"
                                    @input="checkNext"
                                    v-model="password"
                                    password-reveal
                                    icon="json"
                                    placeholder="Your password"
                                    required>
                            </b-input>
                        </b-field>


                    </b-step-item>

                    <b-step-item label="Company Details" :clickable="isStepsClickable" :type="{'is-success': isProfileSuccess}">

                        <b-field label="Job Title *">
                            <b-input
                                    type="text"
                                    icon="worker"
                                    @input="checkNext2"
                                    v-model="jobTitle"
                                    placeholder="Your Job Title"
                                    required>
                            </b-input>
                        </b-field>

                        <b-field label="Company Name *">
                            <b-input
                                    type="text"
                                    icon="folder-open"
                                    @input="checkNext2"
                                    v-model="companyName"
                                    placeholder="Your Company Name"
                                    required>
                            </b-input>
                        </b-field>


                        <div class="field">
                            <label class="label">Address *</label>
                            <div class="control has-icons-left is-clearfix">
                                <GmapAutocomplete
                                        id="map"
                                        required
                                        ref="address"
                                        class="input"
                                        placeholder="Your Full Address"
                                        @place_changed="getAddressData"
                                >
                                </GmapAutocomplete>
                                <span class="icon is-left"><i class="mdi mdi-earth mdi-24px"></i></span>
                            </div>
                        </div>

                        <b-field label="Zip Code">
                            <b-input
                                    type="text"
                                    @input="checkNext2"
                                    icon="meteor"
                                    v-model="zipCode"
                                    placeholder="Zip Code"
                                    >
                            </b-input>
                        </b-field>


                        <b-field label="Phone *">
                            <b-input
                                    type="tel"
                                    @input="checkNext2"
                                    v-model="phone"
                                    icon="cellphone"
                                    placeholder="Your Phone"
                                    required
                                    >
                            </b-input>
                        </b-field>
                    </b-step-item>



                    <b-step-item label="Finish" :clickable="isStepsClickable" :type="{'is-success': isProfileSuccess}">
                        <section>
                            <div class="field">
                                <div style="margin: 15px 0">
                                    <b-checkbox
                                            @input="checkNext3"
                                            v-model="termsMail">I would like to receive promotional e-mail</b-checkbox>
                                </div>
                               <div class="long-check">
                                   <b-checkbox
                                           @input="checkNext3"
                                           v-model="terms">I agree to post my personal information  that I have now submitted to companies in order to receive quotations</b-checkbox>
                               </div>
                            </div>

                        </section>
                    </b-step-item>
                </b-steps>

                <div class="error-login">
                    <p v-if="errorLogin" style="color: red">{{errorLogin}}</p>
                </div>
            </section>
            <footer class="modal-card-foot">
                <div v-if="activeStep == 0">
                    <button class="button"
                            type="button"
                            @click="$parent.close()">Close</button>

                    <button v-if="!level1"
                            class="button is-primary next-level">
                        Next
                        <img v-if="loader" style="width:25px" src="/images/loader.gif" alt="">
                    </button>

                    <button v-else @click.prevent="nextLevel"
                            :class="{ active: level1 }"
                            class="button is-primary next-level">
                        Next
                        <img v-if="loader" style="width:25px" src="/images/loader.gif" alt="">
                    </button>
                </div>
                <div v-if="activeStep == 1">
                    <button class="button" type="button" @click="prevLevel">Prev</button>

                    <button v-if="!level2"
                            class="button is-primary next-level">
                        Next
                        <img v-if="loader" style="width:25px" src="/images/loader.gif" alt="">
                    </button>

                    <button v-else="level2"
                            :class="{ active: level2 }"
                            @click.prevent="nextLevel"
                            class="button is-primary next-level">
                        Next
                        <img v-if="loader" style="width:25px" src="/images/loader.gif" alt="">
                    </button>
                </div>
                <div v-if="activeStep == 2">
                    <button class="button" type="button" @click="prevLevel">Prev</button>
                    <b-button v-if="!level3"
                            class="button is-primary next-level"
                            type="is-success"
                    >
                        <div>Submit</div>
                        <img v-if="loader" style="width:25px" src="/images/loader.gif" alt="">
                    </b-button>

                    <b-button
                            v-else
                            :class="{ active: level3 }"
                            class="button is-primary next-level"
                            :disabled="loader"
                            @click.prevent="submit"
                            type="is-success"
                    >
                        <div>Submit</div>
                        <img v-if="loader" style="width:25px" src="/images/loader.gif" alt="">
                    </b-button>
                </div>
            </footer>
        </div>
    </form>
</template>
<script>

    export default {
        methods: {
            updateSelected (newSelected) {
                this.selected = newSelected
            },
            nextLevel(){
                this.activeStep++;
            },
            prevLevel(){
                this.activeStep--;
            },
            validateEmail(email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            },
            checkNext(){
                if(this.name && this.validateEmail(this.email) && this.password.length >=8){
                    this.level1 = true;
                }else{
                    this.level1 = false;
                }
            },
            checkNext2(){
                if(this.jobTitle && this.companyName && this.lat && this.phone.length > 5 ){
                    this.level2 = true;
                }else{
                    this.level2 = false;
                }
            },
            checkNext3(){
                if( this.terms ){
                    this.level3 = true;
                }else{
                    this.level3 = false;
                }
            },
            getAddressData: function (addressData) {
                this.lat = addressData.geometry.location.lat();
                this.lng = addressData.geometry.location.lng();
                this.address = addressData.formatted_address
                console.log(addressData)
                this.checkNext2()
            },
            submit() {
                this.loader = true;

                window.axios.post(
                    '/register',
                    {
                        'email':this.email,
                        'name':this.name,
                        'password':this.password,
                        'password_confirmation':this.password,
                        'remember':this.remember,
                        'job_title':this.jobTitle,
                        'company_name':this.companyName,
                        'lat':this.lat,
                        'lng':this.lng,
                        'address':this.address,
                        'zip_code':this.zipCode,
                        'phone':this.phone,
                        'confirm_term':this.terms,
                        'confirm_mail':this.termsMail,
                    }
                ).then((res) => {
                    this.loader = false;
                    window.location = "/dashboard/add-new";
                }).catch((res) => {
                    this.loader = false;
                    this.errorLogin = 'The email has already been taken.';
                });
            }
        },
        data() {
            return {
                lat:'',
                lng:'',
                loader:false,
                btnText:'next',
                email:'',
                name:'',
                password:'',
                password_confirmation:'',
                errorLogin:'',
                isSwitchedCustom: 'Client',
                activeStep: 0,
                showSocial: false,
                isAnimated: false,
                hasNavigation: false,
                isStepsClickable: false,
                isProfileSuccess: false,
                level1: false,
                level2: false,
                level3: false,
                selected: null,
                options: ['list', 'of', 'options'],
                jobTitle:'',
                companyName:'',
                zipCode:'',
                phone:'',
                termsMail:false,
                terms:false,
                address:'',
            }
        },
    }
</script>