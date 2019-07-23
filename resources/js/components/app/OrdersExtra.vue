<template>
    <div class="wrap-ul-map">

        <div class="form-title" style="margin: 0px 0px 20px;">
            <div class="title">
                <img src="/images/user2.svg" style="width: 30px;">
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
            </div>

        </div>


        <div class="form-title" style="margin:20px 0px 0px 20px;">
            <div class="title">
                <img src="/images/user2.svg" style="width: 30px;">
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
                <img src="/images/user2.svg" style="width: 30px;">
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
            'from_zip_code',
            'note',
            'to_address_name',
            'to_lat',
            'to_lng',
            'packages',
            'to_zip_code',
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