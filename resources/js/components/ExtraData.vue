<template>
    <div class="wrap-ul-map">

            <div class="form-title" style="margin: 0px 0px 20px;">
                <div class="title">
                    <img src="/images/digital-campaign.png" style="width: 30px;">
                    <div>Offer Details:</div>
                </div>
                <div class="change-password" style="display: none;">
                <a target="_blank" href="/password/reset">Change Password</a>
            </div>
            </div>
            <div class="divTable darkTable">
                <div class="divTableHeading">
                    <div class="divTableRow">
                        <div class="divTableHead"></div>
                        <div class="divTableHead">From</div>
                        <div class="divTableHead">To</div>
                    </div>
                </div>
                <div class="divTableBody">
                    <div class="divTableRow">
                        <div class="divTableCell"><strong>Address:</strong></div>
                        <div class="divTableCell"> {{from_address_name}}</div>
                        <div class="divTableCell">{{to_address_name}}</div>
                    </div>
                    <div class="divTableRow">
                        <div class="divTableCell"><strong>Zip Code:</strong></div>
                        <div class="divTableCell">{{from_zip_code}}</div>
                        <div class="divTableCell">{{to_zip_code}}</div>
                    </div>
                    <div class="divTableRow">
                        <div class="divTableCell"><strong>Company Name:</strong></div>
                        <div class="divTableCell">{{from_company_name}}</div>
                        <div class="divTableCell">{{to_company_name}}</div>
                    </div>

                </div>

            </div>


        <div class="form-title" style="margin:20px 0px 0px 20px;">
            <div class="title">

                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;width: 30px;height: 30px" xml:space="preserve">
<g>
	<polygon style="fill:#A98258;" points="48,0 10,0 0,16 0,58 58,58 58,16 	"/>
    <polygon style="fill:#DAAE86;" points="10,0 0,16 58,16 48,0 	"/>
    <polygon style="fill:#D8B18B;" points="33,54 29,50 25,54 23,52 23,58 35,58 35,52 	"/>
    <rect x="20" y="30" style="fill:#E8D5B2;" width="18" height="16"/>
    <g>
		<path style="fill:#D4C3A5;" d="M30,41h-6c-0.552,0-1,0.447-1,1s0.448,1,1,1h6c0.552,0,1-0.447,1-1S30.552,41,30,41z"/>
        <path style="fill:#D4C3A5;" d="M34,41h-1c-0.552,0-1,0.447-1,1s0.448,1,1,1h1c0.552,0,1-0.447,1-1S34.552,41,34,41z"/>
        <path style="fill:#D4C3A5;" d="M28,35h6c0.552,0,1-0.447,1-1s-0.448-1-1-1h-6c-0.552,0-1,0.447-1,1S27.448,35,28,35z"/>
        <path style="fill:#D4C3A5;" d="M34,37h-2c-0.552,0-1,0.447-1,1s0.448,1,1,1h2c0.552,0,1-0.447,1-1S34.552,37,34,37z"/>
        <path style="fill:#D4C3A5;" d="M24,39h2c0.552,0,1-0.447,1-1s-0.448-1-1-1h-2c-0.552,0-1,0.447-1,1S23.448,39,24,39z"/>
        <path style="fill:#D4C3A5;" d="M24,35h1c0.552,0,1-0.447,1-1s-0.448-1-1-1h-1c-0.552,0-1,0.447-1,1S23.448,35,24,35z"/>
        <path style="fill:#D4C3A5;" d="M28.29,37.29C28.11,37.479,28,37.729,28,38c0,0.27,0.11,0.52,0.29,0.71C28.48,38.89,28.74,39,29,39
			c0.26,0,0.52-0.11,0.71-0.29C29.89,38.52,30,38.26,30,38s-0.11-0.521-0.29-0.71C29.33,36.92,28.66,36.92,28.29,37.29z"/>
	</g>
    <rect x="23" style="fill:#F4D5BD;" width="12" height="16"/>
    <polygon style="fill:#D8B18B;" points="25,21 29,25 33,21 35,23 35,16 23,16 23,23 	"/>
</g>

</svg>

                <div>Packages ({{packages.length}}):</div>
            </div>
            <div class="change-password" style="display: none;">
                <a target="_blank" href="/password/reset">Change Password</a>
            </div>
        </div>
        <ul>
            <li v-if="packages">
                <ul class="pack-wrap">
                    <li v-for="(p, i) in packages">
                        <div class="num-pack">{{i+1}}</div>
                       <div>
                           <strong>Package Quantity</strong>: {{p.package_quantity}}
                       </div>
                        <div>
                            <strong>Package Width</strong>: {{p.package_width}}
                        </div>
                        <div>
                            <strong>Package Height</strong>: {{p.package_height}}
                        </div>
                        <div>
                            <strong>Package Length</strong>: {{p.package_length}}
                        </div>
                        <div>
                            <strong>Package Weight</strong>: {{p.package_weight}}
                        </div>

                    </li>
                </ul>
            </li>
        </ul>
        <div class="form-title" style="margin:20px 0px 0px 20px;">
            <div class="title">
                <img style="width:30px" src="/images/com.svg">
                <div>Commodity:</div>
            </div>

            <div class="change-password" style="display: none;">
                <a target="_blank" href="/password/reset">Change Password</a>
            </div>
        </div>
        <div class="commodity">
            <ul class="pack-wrap">
                <li>
                    <strong>{{commodity}}</strong>
                </li>
            </ul>
        </div>

        <div v-if="type == 'customer' && submit_action == 'complete'">
            <b-button type="is-success" @click="publishQoutation(rowId)">Publish Again</b-button>
        </div>
    </div>
</template>


<script>
    export default {

        mounted() {

        },
        methods: {
            publishQoutation(id){
                window.axios.post(
                    '/update-quot-status',
                    {
                        'id':id,
                    }
                ).then((res) => {
                    location.reload();

                }).catch((res) => {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!, try agein letter',
                        footer: ''
                    })
                });
            },
            pinClick(item){
                this.text = item.text.title;
                this.content = item.text.content;
                this.infoWindow.position = item.position
                this.infoWindow.open = true
            }


        },
        props: [
            'from_address_name',
            'from_lat',
            'type',
            'from_lng',
            'from_name',
            'from_zip_code',
            'to_address_name',
            'from_company_name',
            'to_company_name',
            'to_lat',
            'to_lng',
            'to_name',
            'to_zip_code',
            'packages',
            'commodity',
            'submit_action',
            'rowId',
            'notes'
        ],
        data() {
            return {
                currentUserId:$("#details-helper").data('id'),
                currentUserName:$("#details-helper").data('name'),
                content:'',
                text:'',
                infoWindow: {
                    position: {lat: 0, lng: 0},
                    open: false,
                    template: ''
                },
                markers:[
                {
                    position:{
                        lat:Number(this.from_lat),
                        lng:Number(this.from_lng),
                    },
                    text: {
                        title: 'from',
                        content: this.from_address_name,

                    },
                    icon:{
                        url:'/images/plane-taking-off.png'
                    }
                },
                {
                    position:{
                        lat:Number(this.to_lat),
                        lng:Number(this.to_lng),
                    },
                    text: {
                        title: 'to',
                        content: this.to_address_name,
                    },
                    icon:{
                        url:'/images/landing-airplane.png'
                    }
                },
                ],
                styles: [
                    {
                        "featureType": "administrative",
                        "elementType": "labels.text",
                        "stylers": [
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.station.rail",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            },
                            {
                                "saturation": "-100"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "on"
                            }
                        ]
                    }
                ]
            }
        },
    }

</script>