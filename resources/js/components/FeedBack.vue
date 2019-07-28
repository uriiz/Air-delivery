<template>
    <form action="">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">FeedBack</p>
            </header>
            <section class="modal-card-body">

                <b-field>
                    <b-input type="textarea"
                             v-model="content"
                             minlength="1"
                             maxlength="600"
                             placeholder="FeedBack">
                    </b-input>
                </b-field>

            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button class="button is-primary"
                        :disabled="content <= 0 || disableC"
                        @click.prevent="sendToUs">
                    <span>Send</span>
                    <img v-if="loader" style="width:25px" src="/images/loader.gif" alt="">
                </button>
            </footer>
        </div>
    </form>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        mounted() {


        },
        methods: {

            sendToUs(){
                this.disableC = true
                this.loader = true
                window.axios.post(
                    '/set-feedback',
                    {
                        'contentText':this.content,
                    }
                ).then((res) => {
                    this.loader = false;
                    this.disableC = false;
                    if(res.data == 1) {
                        Swal.fire(
                            'Thank You!',
                            'thank for your feedback...',
                            'success'
                        ).then((result) => {
                            this.$parent.close()
                        })
                    }else{
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!, try agein letter',
                            footer: ''
                        }).then((result) => {
                            this.$parent.close()
                        })
                    }
                }).catch((res) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!, try agein letter',
                        footer: ''
                    }).then((result) => {
                        this.$parent.close()
                    })
                });
            },
        },
        data() {
            return {
                currentUserId:$("#details-helper").data('id'),
                currentUserName:$("#details-helper").data('name'),
                content:'',
                loader:false,
                disableC:false,

            }
        },
        props:[
            'id',
        ],
        computed:{
            total(){

                return (Number(this.price)+Number(this.extraCostPrice)).toFixed(2)
            }
        },
    }
</script>