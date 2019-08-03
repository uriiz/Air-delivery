<template>
    <form action="">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">Contact Details</p>
            </header>
            <section class="modal-card-body">
                  <ul>
                      <li>
                          <strong>
                              name:
                          </strong>
                          {{details.name}}
                      </li>
                      <li>
                          <strong>
                              email:
                          </strong>
                          <a :href="['mailto:' + details.email]">{{details.email}}</a>
                      </li>
                      <li v-if="details.phone">
                          <strong>
                              phone:
                          </strong>
                          <a :href="['tel:' + details.phone]">{{details.phone}}</a>
                      </li>
                      <li v-if="details.company_name">
                          <strong>
                              company name:
                          </strong>
                          {{details.company_name}}
                      </li>
                  </ul>
            </section>
            <footer class="modal-card-foot">

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
            'details',
        ],
        computed:{
            total(){

                return (Number(this.price)+Number(this.extraCostPrice)).toFixed(2)
            }
        },
    }
</script>