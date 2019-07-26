<template>
    <form action="">
        <div class="modal-card" style="width: auto">
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
                            <b-table-column field="id" label="ID" width="40" >
                                {{ props.row.id }}
                            </b-table-column>
                            <b-table-column label="Send In" >
                                {{ props.row.created_at }}
                            </b-table-column>
                            <b-table-column label="Price" >
                                {{ props.row.price_offer }}{{ props.row.currency }}
                            </b-table-column>
                            <b-table-column label="Extra Price" >
                                {{ props.row.price_offer_extra }}
                                {{ props.row.currency_extra }}
                            </b-table-column>
                            <b-table-column label="Interesting" >
                                <span class="tag is-success">
                                    Interesting
                                </span>
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

            pinClick(item){
                this.text = item.text.title;
                this.content = item.text.content;
                this.infoWindow.position = item.position
                this.infoWindow.open = true
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
            }
        },
    }

</script>