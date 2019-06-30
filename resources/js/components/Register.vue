<template>
    <form action="">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">Register</p>
            </header>
            <section class="modal-card-body">

                <b-field label="name">
                    <b-input
                            type="text"
                            :value="name"
                            v-model="name"
                            placeholder="Name/Company Name"
                            required
                            >
                    </b-input>
                </b-field>

                <b-field label="Email">
                    <b-input
                            type="email"
                            :value="email"
                            v-model="email"
                            placeholder="Your email"
                            required>
                    </b-input>
                </b-field>

                <b-field label="Password">
                    <b-input
                            type="password"
                            :value="password"
                            v-model="password"
                            password-reveal
                            placeholder="Your password"
                            required>
                    </b-input>
                </b-field>

                <b-field label="Password">
                    <b-input
                            type="password"
                            v-model="password_confirmation"
                            password-reveal
                            placeholder="Confirm password"
                            required>
                    </b-input>
                </b-field>
                <div class="field">
                    <b-switch v-model="isSwitchedCustom"
                              true-value="Client"
                              false-value="Company">
                        {{ isSwitchedCustom }}
                    </b-switch>
                </div>

                <div class="error-login">
                    <p v-if="errorLogin" style="color: red">{{errorLogin}}</p>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button @click.prevent="submit" class="button is-primary">
                    Register
                    <img v-if="loader" style="width:25px" src="/images/loader.gif" alt="">
                </button>
            </footer>
        </div>
    </form>
</template>
<script>
    export default {
        methods: {

            submit() {
                this.loader = true;
                if(!this.email || !this.password || !this.password_confirmation || !this.name){
                    this.errorLogin = 'All field are required';
                    this.loader = false;
                    return;
                }
                window.axios.post(
                    '/register',
                    {
                        'email':this.email,
                        'name':this.name,
                        'password':this.password,
                        'password_confirmation':this.password_confirmation,
                        'remember':this.remember,
                    }
                ).then((res) => {
                    this.loader = false;
                    window.location = "/";
                }).catch((res) => {
                    this.loader = false;
                    this.errorLogin = 'The email has already been taken.';
                });
            }
        },
        data() {
            return {
                loader:false,
                email:'',
                name:'',
                password:'',
                password_confirmation:'',
                errorLogin:'',
                isSwitchedCustom: 'Client'
            }
        },
    }
</script>