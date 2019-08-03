<template>
    <form action="">
        <div class="modal-card" style="width: auto">

            <b-loading :is-full-page="false" :active.sync="loader" :can-cancel="false">

            </b-loading>

            <header class="modal-card-head">
                <p class="modal-card-title">Quotation #{{id}}</p>
            </header>
            <section class="modal-card-body">


                <div class="form-title" style="margin: 0px 0px 20px;">
                    <div class="title">
                        <img src="/images/digital-campaign.png" style="width: 30px;">
                        <div>Quotation's Prices:</div>
                    </div>
                </div>
                <div class="prices-quotation">
                    <b-table
                            :data="response"
                    >
                        <template slot-scope="props">

                            <b-table-column label="Send In" >
                                {{ props.row.created_at }}
                            </b-table-column>
                            <b-table-column label="Price" >
                                {{ props.row.price_offer }}{{ props.row.currency }}
                            </b-table-column>
                            <b-table-column label="Extra Cost" >
                                {{ props.row.price_offer_extra }}
                                {{ props.row.currency_extra }}
                            </b-table-column>

                            <b-table-column label="Total" >
                                <div v-if="props.row.currency_extra == props.row.currency">
                                    {{ calcTotal(props.row.price_offer_extra,props.row.price_offer) }}
                                </div>
                            </b-table-column>

                            <b-table-column label="Shippers Company Name" >
                                {{ props.row.company_name }}
                            </b-table-column>

                            <b-table-column label="Exporter Name" >
                                {{ props.row.user_name }}
                            </b-table-column>

                            <b-table-column label="Interesting">
                                <b-button :disabled="loader"
                                          class="tag is-success flex-btn confirm-btn"
                                          @click="confirmOffer(props.row.id)" style="cursor: pointer">
                                    <span>Confirm</span>

                                </b-button>
                            </b-table-column>
                        </template>
                    </b-table>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
            </footer>
        </div>
    </form>
</template>

<script>
    export default {

        mounted() {

        },
        methods: {
            confirmOffer(id){
                this.loader = true;

                window.axios.post(
                    '/confirm-offer-final',{id:id}
                ).then((res) => {
                    if(res.data == 1){
                        this.$notification.open({
                            duration: 5000,
                            message: 'It was successfully sent to the relevant company, they will contact you soon',
                            position: 'is-bottom-right',
                            type: 'is-success',
                            hasIcon: true
                        })
                        for (let i = 0; i < this.response.length; i++){
                            if(this.response[i].id == id){
                                this.response.splice(i,1)
                            }
                        }
                    }
                    this.loader = false;
                }).catch((res) => {this.loader = false;});
            },
            pinClick(item){
                this.text = item.text.title;
                this.content = item.text.content;
                this.infoWindow.position = item.position
                this.infoWindow.open = true
            },
            calcTotal(a,b){
                return (Number(a)+Number(b)).toFixed(2)
            }


        },
        props: [
            'response',
            'id',
        ],
        data() {
            return {
                currentUserId:$("#details-helper").data('id'),
                currentUserName:$("#details-helper").data('name'),
                loader:false,
            }
        },
    }

</script>