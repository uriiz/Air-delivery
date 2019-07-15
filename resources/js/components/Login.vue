<template>
    <form action="">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">Login</p>
                <div>
                    <a style="color:#000;text-decoration: underline;display: block" href="/?register=1">Not Register Yet?</a>
                </div>

            </header>
            <section class="modal-card-body">
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

                <b-checkbox v-model="remember">Remember me</b-checkbox>
                <a style="color:#000;text-decoration: underline;display:block" href="/password/reset/">Forgot Password?</a>
                <div class="error-login">
                    <p v-if="errorLogin" style="color: red">{{errorLogin}}</p>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button @click.prevent="submit" class="button is-primary">
                    Login
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
                if(!this.email || !this.password){
                    this.errorLogin = 'All field are required';
                    this.loader = false;
                    return;
                }
                window.axios.post(
                    '/login',
                    {
                        'email':this.email,
                        'password':this.password,
                        'remember':this.remember,
                    }
                ).then((res) => {
                    this.loader = false;
                    window.location = "/dashboard";
                }).catch((res) => {
                    this.loader = false;
                    this.errorLogin = 'The given data was invalid';
                });
            }
        },
        data() {
            return {
                loader:false,
                email:'',
                password:'',
                remember:true,
                errorLogin:'',
            }
        },
    }
 </script>