<template>
    <form action="">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">Contact Details</p>
            </header>
            <section class="modal-card-body">

                <b-collapse class="card" aria-id="contentIdForA11y3">
                    <div
                            slot="trigger"
                            slot-scope="props"
                            class="card-header"
                            role="button"
                            aria-controls="contentIdForA11y3">
                        <p class="card-header-title">
                            {{details.name}}
                        </p>

                    </div>
                    <div class="card-content">
                        <div class="user_img">
                            <div :style="{ 'background-image': 'url(' + details.logo + ')' }"
                                 class="user-image-bg">
                            </div>
                        </div>
                        <div class="content" style="min-width: 250px">
                            <strong style="display:block">
                                Name:
                                {{details.name}}
                            </strong>
                            <p style="margin: 0">
                                Email:
                                <a style="color:#23d160" :href="['mailto:' + details.email]">{{details.email}}</a>
                            </p>
                            <p style="margin: 0">Company: {{details.company_name}}</p>
                            <p style="margin: 0" >Phone:
                                <a
                                  style="color:#23d160"
                                  :href="['tel:' + details.phone]">{{details.phone}}</a>
                            </p>
                        </div>
                    </div>
                </b-collapse>
            </section>
            <footer class="modal-card-foot"> </footer>
        </div>
    </form>
</template>

<script>
    export default {
        mounted() {
            console.log(this.details)
        },
        methods: {
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