<template>
    <form action="">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">Offer #{{id}}</p>
            </header>
            <section class="modal-card-body">
                <div class="wrap-price-label">
                    <div class="wrap-price-label-title">
                        <p>Price</p>
                    </div>
                    <div class="wrap-price">
                    <b-field>
                        <b-numberinput
                                :min="1"
                                :step="0.1"
                                v-model="price" min="0">
                        </b-numberinput>
                    </b-field>

                    <select class="input" v-model="currencyPrice">
                        <option value="$">$</option>
                        <option value="€">€</option>
                        <option value="₪">₪</option>
                    </select>
                    </div>
                </div>
                <div class="mb5"></div>
                <div class="wrap-price-label">
                    <div class="wrap-price-label-title">
                        <p>Extra Costs</p>
                    </div>
                    <div class="wrap-price">
                        <b-field>
                            <b-numberinput
                                    :min="1"
                                    :step="0.1"
                                    v-model="extraCostPrice" min="0">
                            </b-numberinput>
                        </b-field>

                        <select class="input" v-model="extraCostCurrency">
                            <option value="$">$</option>
                            <option value="€">€</option>
                            <option value="₪">₪</option>
                        </select>
                    </div>
                </div>
                <div class="mb5"></div>
                <div v-if="extraCostCurrency == currencyPrice" class="total-price">
                    Total: {{total}}
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button class="button is-primary"
                        :disabled="price <= 0 || extraCostPrice < 0 || id <= 0 || loader"
                        @click.prevent="sendToUser">
                        <span>Send</span>
                    <img v-if="loader" style="width:25px" src="/images/loader.gif" alt="">
                </button>
            </footer>
        </div>
    </form>
</template>

<script>
    export default {
        mounted() {


        },
        methods: {

            sendToUser(){
                this.loader = true
                window.axios.post(
                    '/set-price',
                    {
                        'price':this.price,
                        'extra_price':this.extraCostPrice,
                        'price_currency':this.currencyPrice,
                        'extra_price_currency':this.extraCostCurrency,
                        'offer_id':this.id,
                    }
                ).then((res) => {

                    this.loader = false
                    location.reload();
                }).catch((res) => {});
            },
        },
        data() {
            return {
                currentUserId:$("#details-helper").data('id'),
                currentUserName:$("#details-helper").data('name'),
                price:0,
                currencyPrice:'$',
                extraCostPrice:0,
                extraCostCurrency:'$',
                loader:false,

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