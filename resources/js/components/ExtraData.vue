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
                        <div>
                            <strong>Package Type</strong>: {{p.package_type}}
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="form-title" style="margin:20px 0px 0px 20px;">
            <div class="title">


                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999;width:30px;height:30px;" xml:space="preserve">
<g>
	<path style="fill:#03AA6F;" d="M441.374,79.519l-26.485,17.656l-44.141-8.828l-26.485-8.828l-35.313,8.828l-26.485-8.828
		l17.656-35.313h35.313l34.607-17.303C396.73,40.101,420.875,57.916,441.374,79.519z"/>
    <path style="fill:#03AA6F;" d="M238.325,44.206l-8.828,26.485l-26.485,8.828l-26.485,44.141l-44.141,26.485l-61.797,8.828v26.485
		l17.656,17.656v35.313L61.762,220.77l-26.485-17.656l-15.361-46.171C46.356,93.935,96.898,44.126,160.284,18.604l25.072,16.774
		L238.325,44.206z"/>
    <polygon style="fill:#03AA6F;" points="255.982,291.395 247.154,335.536 211.841,370.849 211.841,397.334 176.528,423.818
		176.528,467.959 150.044,459.131 132.387,414.99 132.387,326.708 88.246,317.88 70.59,282.567 70.59,256.082 88.246,238.426
		114.731,211.941 132.387,247.254 194.184,247.254 220.669,291.395 	"/>
    <path style="fill:#03AA6F;" d="M479.335,130.987c48.193,85.978,42.702,191.996-14.125,272.526l-23.836-23.836v-35.313
		l-17.656-35.313l-17.656-35.313v-35.313l-26.485-17.656l-35.313,8.828l-61.797-26.485l-8.828-61.797l26.485-26.485h52.969
		l17.656,26.485l52.969,8.828l52.969-17.656L479.335,130.987z"/>
</g>
                    <path style="fill:#86DAF1;" d="M308.951,88.347l35.313-8.828l26.485,8.828l44.141,8.828l26.485-17.656
	c14.787,15.476,27.544,32.77,37.961,51.468l-2.648,1.501l-52.969,17.656l-52.969-8.828l-17.656-26.485h-52.969l-26.485,26.485
	l8.828,61.797l61.797,26.485l35.313-8.828l26.485,17.656v35.313l17.656,35.313l17.656,35.313v35.313l23.836,23.836
	c-81.528,115.526-241.275,143.079-356.792,61.55C10.311,395.815-26.494,267.691,19.916,156.942l15.361,46.171l26.485,17.656
	l26.485,17.656L70.59,256.082v26.485l17.656,35.313l44.141,8.828v88.282l17.656,44.141l26.485,8.828v-44.141l35.313-26.485v-26.485
	l35.313-35.313l8.828-44.141h-35.313l-26.485-44.141h-61.797l-17.656-35.313l-26.485,26.485v-35.313L70.59,185.457v-26.485
	l61.797-8.828l44.141-26.485l26.485-44.141l26.485-8.828l8.828-26.485l-52.969-8.828l-25.072-16.774
	c67.889-27.341,144.235-24.322,209.758,8.299l-34.607,17.303h-35.313l-17.656,35.313L308.951,88.347z"/>

</svg>


                <div>Global View:</div>
            </div>
            <div class="change-password" style="display: none;">
                <a target="_blank" href="/password/reset">Change Password</a>
            </div>
        </div>
        <div class="maps-section">
            <div class="extra-info">

                <ul>
                    <li>

                        <div><img style="width:30px" src="/images/plane-taking-off.png" alt=""></div>
                        <div>From</div>
                    </li>
                    <li>

                        <div><img style="width:30px" src="/images/landing-airplane.png" alt=""></div>
                        <div>To</div>
                    </li>
                </ul>
            </div>
            <GmapMap
                    :center="{lat:10, lng:10}"
                    :zoom="1"
                    :options="{styles: styles}"
                    map-type-id="terrain"
                    style="width: 500px; height: 300px"
            >
                <GmapMarker
                        :key="index"
                        v-for="(m, index) in markers"
                        :position="m.position"
                        :clickable="true"
                        :draggable="false"
                        :icon = "m.icon"
                        @click="pinClick(m)"
                />
                <gmap-info-window
                        :options="{maxWidth: 300,maxHeight:600}"
                        :opened="infoWindow.open"
                        @closeclick="infoWindow.open=false"
                        :position="infoWindow.position"
                >
                    <div class="popup-marker">

                        <div class="popup-marker-title">
                            <p><strong>{{text}}</strong></p>
                        </div>
                        <div class="popup-marker-content">
                            {{content}}
                        </div>

                    </div>
                </gmap-info-window>
            </GmapMap>

            <div class="form-title" style="margin:20px 0px 0px 20px;">
                <div class="title">

                    <svg xmlns="http://www.w3.org/2000/svg" height="30px" version="1.1" viewBox="-22 0 464 464" width="30px">
                        <g id="surface1">
                            <path d="M 368 16 C 367.972656 7.175781 360.824219 0.0273438 352 0 L 104 0 L 104 80 C 104 88.835938 96.835938 96 88 96 L 0 96 L 0 448 C 0.0273438 456.824219 7.175781 463.972656 16 464 L 352 464 C 360.824219 463.972656 367.972656 456.824219 368 448 Z M 272 160 Z M 88 160 Z M 224 208 Z M 176 256 Z M 128 304 Z M 128 304 " style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,91.372549%,80%);fill-opacity:1;" />
                            <path d="M 122.585938 421.425781 L 133.894531 342.230469 L 184.808594 359.199219 L 201.785156 410.113281 Z M 122.585938 421.425781 " style=" stroke:none;fill-rule:nonzero;fill:rgb(57.647059%,58.431373%,59.607843%);fill-opacity:1;" />
                            <path d="M 104 464 L 352 464 C 360.835938 464 368 456.835938 368 448 L 368 216.726562 C 324.300781 336.425781 226.296875 428.21875 104 464 Z M 104 464 " style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,88.627451%,74.117647%);fill-opacity:1;" />
                            <path d="M 303.609375 172.523438 L 326.234375 149.898438 L 394.117188 217.78125 L 371.492188 240.40625 Z M 303.609375 172.523438 " style=" stroke:none;fill-rule:nonzero;fill:rgb(67.45098%,67.058824%,69.411765%);fill-opacity:1;" />
                            <path d="M 366.351562 124.800781 C 363.644531 125.066406 360.96875 125.574219 358.351562 126.320312 C 350.488281 128.558594 343.328125 132.769531 337.550781 138.558594 L 326.273438 149.921875 L 394.113281 217.761719 L 405.390625 206.480469 C 419.789062 192.09375 423.546875 170.191406 414.769531 151.828125 C 405.992188 133.464844 386.589844 122.632812 366.351562 124.800781 Z M 366.351562 124.800781 " style=" stroke:none;fill-rule:nonzero;fill:rgb(77.647059%,77.254902%,79.215686%);fill-opacity:1;" />
                            <path d="M 303.648438 172.480469 L 133.886719 342.238281 L 179.199219 364.847656 L 280.984375 263.023438 L 179.199219 364.847656 L 189.414062 385.273438 L 201.847656 410.070312 L 366.398438 245.527344 L 371.519531 240.40625 L 358.382812 227.273438 Z M 304.375 239.632812 L 315.695312 228.320312 Z M 304.375 239.632812 " style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,84.313725%,20%);fill-opacity:1;" />
                            <path d="M 104 80 L 104 0 L 0 96 L 88 96 C 96.835938 96 104 88.835938 104 80 Z M 104 80 " style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,66.27451%,57.647059%);fill-opacity:1;" />
                            <path d="M 200.609375 351.40625 C 197.371094 351.410156 194.449219 349.460938 193.210938 346.46875 C 191.972656 343.476562 192.660156 340.03125 194.953125 337.742188 L 280.800781 251.921875 C 282.761719 249.667969 285.816406 248.699219 288.71875 249.40625 C 291.621094 250.109375 293.890625 252.375 294.597656 255.277344 C 295.308594 258.179688 294.34375 261.234375 292.097656 263.199219 L 206.265625 349.0625 C 204.765625 350.5625 202.730469 351.40625 200.609375 351.40625 Z M 200.609375 351.40625 " style=" stroke:none;fill-rule:nonzero;fill:rgb(94.509804%,94.901961%,94.901961%);fill-opacity:1;" />
                            <path d="M 309.0625 242.945312 C 305.828125 242.941406 302.914062 240.996094 301.675781 238.003906 C 300.4375 235.015625 301.121094 231.574219 303.40625 229.289062 L 314.71875 217.976562 C 317.859375 214.945312 322.847656 214.988281 325.933594 218.074219 C 329.019531 221.160156 329.0625 226.148438 326.03125 229.289062 L 314.71875 240.601562 C 313.222656 242.105469 311.1875 242.949219 309.0625 242.945312 Z M 309.0625 242.945312 " style=" stroke:none;fill-rule:nonzero;fill:rgb(94.509804%,94.901961%,94.901961%);fill-opacity:1;" />
                            <path d="M 224 216 L 56 216 C 51.582031 216 48 212.417969 48 208 C 48 203.582031 51.582031 200 56 200 L 224 200 C 228.417969 200 232 203.582031 232 208 C 232 212.417969 228.417969 216 224 216 Z M 224 216 " style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,47.45098%,33.72549%);fill-opacity:1;" />
                            <path d="M 176 264 L 56 264 C 51.582031 264 48 260.417969 48 256 C 48 251.582031 51.582031 248 56 248 L 176 248 C 180.417969 248 184 251.582031 184 256 C 184 260.417969 180.417969 264 176 264 Z M 176 264 " style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,47.45098%,33.72549%);fill-opacity:1;" />
                            <path d="M 128 312 L 56 312 C 51.582031 312 48 308.417969 48 304 C 48 299.582031 51.582031 296 56 296 L 128 296 C 132.417969 296 136 299.582031 136 304 C 136 308.417969 132.417969 312 128 312 Z M 128 312 " style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,47.45098%,33.72549%);fill-opacity:1;" />
                            <path d="M 272 168 L 120 168 C 115.582031 168 112 164.417969 112 160 C 112 155.582031 115.582031 152 120 152 L 272 152 C 276.417969 152 280 155.582031 280 160 C 280 164.417969 276.417969 168 272 168 Z M 272 168 " style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,47.45098%,33.72549%);fill-opacity:1;" />
                            <path d="M 88 168 L 56 168 C 51.582031 168 48 164.417969 48 160 C 48 155.582031 51.582031 152 56 152 L 88 152 C 92.417969 152 96 155.582031 96 160 C 96 164.417969 92.417969 168 88 168 Z M 88 168 " style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,47.45098%,33.72549%);fill-opacity:1;" />
                        </g>
                    </svg>


                    <div>Offer Notes:</div>
                </div>

            </div>
            <div style="margin-top: 20px">
                <b-field v-if="notes" label="Notes:"
                         :label-position="labelPosition">
                    <b-input disabled :value="notes" type="textarea"></b-input>
                </b-field>

                <p v-else>There Is No Notes</p>
            </div>
            <router-link class="make-draft-to-post"
                         v-if="submit_action=='draft'"
                         :to="{ name: 'offer', params: {id:rowId } }">
                Send Offer
            </router-link>




        </div>

    </div>
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
            'from_address_name',
            'from_lat',
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