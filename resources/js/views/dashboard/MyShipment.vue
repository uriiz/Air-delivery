<template>
  <div class="main-dashboard">
    <header-dashboard></header-dashboard>
    <sidebar></sidebar>
    <div class="main-dashborad-in">
      <div>
        <div class="main-table">
          <div class="main-table-title">
            <h3>Shipments on the way</h3>
          </div>
          <div class="main-table-box main-table-box-new">
            <b-table :data="data" ref="table">
              <template slot-scope="props">
                <b-table-column field="offer_number" label="Offer Number">
                  #{{ props.row.offer_number }}
                </b-table-column>

                <b-table-column field="from" label="From" sortable>
                  {{ props.row.from }}
                </b-table-column>

                <b-table-column field="to" label="To">
                  {{ props.row.to }}
                </b-table-column>

                <b-table-column field="po_no" label="Po Number">
                  {{ props.row.po_no }}
                </b-table-column>

                <b-table-column field="carrier" label="Carrier">
                  {{ props.row.carrier }}
                </b-table-column>

                <b-table-column field="created" label="Created">
                  {{ props.row.created }}
                </b-table-column>

                <b-table-column field="last_status" label="Last Status">
                  {{ props.row.last_status }}
                </b-table-column>

                <b-table-column field="date" label="Date">
                  {{ props.row.date }}
                </b-table-column>

                <b-table-column field="etd" label="ETD">
                  {{ props.row.etd }}
                </b-table-column>

                <b-table-column field="eta" label="ETA">
                  {{ props.row.eta }}
                </b-table-column>

                <b-table-column field="more" label="More">
                  <span class="tag is-success" style="cursor:pointer" @click="openModel(props.row)">
                      More
                   </span >
                 
                </b-table-column>
              </template>
            </b-table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import ShipModal from '../../components/MyShipmentModal'
export default {
  data() {
    return {
        popupData:[],
      //, Offer No., Frm, To, Po No. ,Carrier, Created, Last Status date, Last status, ETD, ETA, MORE
      data: [
        {
          offer_number: 32321,
          from: "Israel",
          to: "Calirfonia",
          po_no: "3233",
          carrier: "carrier",
          created: "2016-10-15 13:43:27",
          last_status: "Shipment",
          date: "2016-10-15 13:43:27",
          etd: "2019-10-15 13:43:27",
          eta: "2016-10-15 13:43:27",
          more: "More",
        },
         {
          offer_number: 32321,
          from: "Israel",
          to: "Calirfonia",
          po_no: "3233",
          carrier: "carrier",
          created: "2016-10-15 13:43:27",
          last_status: "Shipment",
          date: "2016-10-15 13:43:27",
          etd: "2019-10-15 13:43:27",
          eta: "2016-10-15 13:43:27",
          more: "More",
        },
         {
          offer_number: 32321,
          from: "Israel",
          to: "Calirfonia",
          po_no: "3233",
          carrier: "carrier",
          created: "2016-10-15 13:43:27",
          last_status: "Shipment",
          date: "2016-10-15 13:43:27",
          etd: "2019-10-15 13:43:27",
          eta: "2016-10-15 13:43:27",
          more: "More",
        },
         {
          offer_number: 32321,
          from: "Israel",
          to: "Calirfonia",
          po_no: "3233",
          carrier: "carrier",
          created: "2016-10-15 13:43:27",
          last_status: "Shipment",
          date: "2016-10-15 13:43:27",
          etd: "2019-10-15 13:43:27",
          eta: "2016-10-15 13:43:27",
          more: "More",
        },
         {
          offer_number: 32321,
          from: "Israel",
          to: "Calirfonia",
          po_no: "3233",
          carrier: "carrier",
          created: "2016-10-15 13:43:27",
          last_status: "Shipment",
          date: "2016-10-15 13:43:27",
          etd: "2019-10-15 13:43:27",
          eta: "2016-10-15 13:43:27",
          more: "More",
        },
         {
          offer_number: 32321,
          from: "Israel",
          to: "Calirfonia",
          po_no: "3233",
          carrier: "carrier",
          created: "2016-10-15 13:43:27",
          last_status: "Shipment",
          date: "2016-10-15 13:43:27",
          etd: "2019-10-15 13:43:27",
          eta: "2016-10-15 13:43:27",
          more: "More",
        },
      ],
    };
  },

  methods:{
      openModel(rowdata){
          console.log(rowdata);
          this.$modal.open({
                    parent: this,
                    component: ShipModal,
                    props:{extradata:rowdata,},
                    hasModalCard: true
                })
      }
  }
};
</script>

<style scoped>
.main-table-box-new thead tr th .th-wrap{
    font-size: 12px !important;
}
.b-table .table th .th-wrap{
    font-size: 12px !important;
}
</style>