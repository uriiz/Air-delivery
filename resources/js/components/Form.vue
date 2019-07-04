<template>
    <div class="main-form">
        <div class="triancle"></div>
        <section>
            <div class="field">
                <label class="label">Place Of Discharge</label>
                <div class="control is-clearfix">
                    <GmapAutocomplete
                            id="map"
                            class="input"
                            append-icon="search"
                            placeholder="Place Of Loading"
                            @place_changed="getAddressData"
                    >
                    </GmapAutocomplete>
                </div>
            </div>


            <div class="field">
                <label class="label">Place Of Loaing</label>
                <div class="control is-clearfix">
                    <GmapAutocomplete
                            id="map2"
                            class="input"
                            append-icon="search"
                            placeholder="Place Of Loading"
                            @place_changed="getAddressData"
                    >
                    </GmapAutocomplete>
                </div>
            </div>

            <b-field label="Loading Date">
                <b-datepicker
                        :mobile-native="false"
                        :min-date="minDate"
                        placeholder="Loading Date"
                        icon="calendar-today">
                </b-datepicker>
            </b-field>

            <b-field label="Discharge Date">
                <b-datepicker
                        placeholder="Loading Date"
                        icon="calendar-today">
                </b-datepicker>
            </b-field>

            <b-field label="Place Of Loading">
                <b-input icon="account" value="" ></b-input>
            </b-field>

            <b-field label="Place Of Discharge">
                <b-input icon="account" value=""></b-input>
            </b-field>
            <div class="counters">
                <b-field label="Weight">
                    <b-numberinput controls-position="compact"
                                   controls-rounded>
                    </b-numberinput>
                </b-field>
                <b-field label="lang">
                    <b-numberinput controls-position="compact"
                                   controls-rounded>
                    </b-numberinput>
                </b-field>
                <b-field label="lang">
                    <b-numberinput controls-position="compact"
                                   controls-rounded>
                    </b-numberinput>
                </b-field>
            </div>
            <b-field label="Place Of Loading">
                <b-input icon="account" value="" ></b-input>
            </b-field>

            <b-field label="Place Of Discharge">
                <b-input icon="account" value=""></b-input>
            </b-field>

            <b-field label="Place Of Loading">
                <b-input icon="account" value="" ></b-input>
            </b-field>

            <b-field label="Place Of Discharge">
                <b-input icon="account" value=""></b-input>
            </b-field>

            <b-field label="Place Of Loading">
                <b-input icon="account" value="" ></b-input>
            </b-field>


        </section>
        <b-button
                style="margin-top: 20px"
                @click="submit"
                type="is-primary">
            Send
        </b-button>
    </div>
</template>

<script>
    const today = new Date()
    import Swal from 'sweetalert2'
    export default {

        mounted() {
            // this.address.geometry.location.lat(),this.address.geometry.location.lng()
        },



        data: function () {

            return {
                lat:0,
                lng:0,
                date: new Date(),
                minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() ),
                maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5)
            }
        },
        methods: {
            getAddressData: function (addressData) {
                this.lat = addressData.geometry.location.lat();
                this.lng = addressData.geometry.location.lng();
            },
            submit(){
                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                )
            },
        }
    }
</script>