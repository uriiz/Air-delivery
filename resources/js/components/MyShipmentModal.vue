<template>
  <form action="">
    <div class="modal-card" style="width: auto">
      <header class="modal-card-head">
        <p class="modal-card-title">#{{ extradata.offer_number }}</p>
      </header>
      <section class="modal-card-body">
        <section>
          <b-tabs v-model="activeTab">
            <b-tab-item label="REFERENCE">
              <b-field>
                <b-input
                  type="textarea"
                  v-model="content"
                  minlength="1"
                  maxlength="600"
                  placeholder="REFERENCE..."
                >
                </b-input>
              </b-field>
              <button class="button is-success" type="button" @click="$parent.close()">
                Send
              </button>
            </b-tab-item>

            <b-tab-item label="STATUS">
              <b-table
                :data="data"
                :columns="columns"
                :checked-rows.sync="checkedRows"
                checkable
                :checkbox-position="checkboxPosition"
              >
              </b-table>
            </b-tab-item>
          </b-tabs>
        </section>
      </section>
      <footer class="modal-card-foot">
        <button class="button" type="button" @click="$parent.close()">
          Close
        </button>
      </footer>
    </div>
  </form>
</template>

<script>
import Swal from "sweetalert2";
export default {
  props: ["extradata"],
  mounted() {},
  methods: {
    sendToUs() {
      this.disableC = true;
      this.loader = true;
      window.axios
        .post("/set-feedback", {
          contentText: this.content,
        })
        .then((res) => {
          this.loader = false;
          this.disableC = false;
          if (res.data == 1) {
            Swal.fire(
              "Thank You!",
              "thank for your feedback...",
              "success"
            ).then((result) => {
              this.$parent.close();
            });
          } else {
            Swal.fire({
              type: "error",
              title: "Oops...",
              text: "Something went wrong!, try agein letter",
              footer: "",
            }).then((result) => {
              this.$parent.close();
            });
          }
        })
        .catch((res) => {
          Swal.fire({
            type: "error",
            title: "Oops...",
            text: "Something went wrong!, try agein letter",
            footer: "",
          }).then((result) => {
            this.$parent.close();
          });
        });
    },
  },
  data() {
    const data = [
      {
        type: "VAT number",
        Reference: "2442552",
        created: "2016-10-15 13:43:27",
      },
      {
        type: "VAT number",
        Reference: "2442552",
        created: "2016-10-15 13:43:27",
      },
      {
        type: "VAT number",
        Reference: "2442552",
        created: "2016-10-15 13:43:27",
      },
      {
        type: "VAT number",
        Reference: "2442552",
        created: "2016-10-15 13:43:27",
      },
    ];
    return {
      currentUserId: $("#details-helper").data("id"),
      currentUserName: $("#details-helper").data("name"),
      content: "",
      loader: false,
      disableC: false,
      activeTab: 0,
      showBooks: false,
      data,
      checkboxPosition: "left",
      checkedRows: [],
      columns: [
        {
          field: "type",
          label: "Type",
        },
        {
          field: "Reference",
          label: "Reference",
        },
        {
          field: "created",
          label: "Created",
        },
      ],
    };
  },

  computed: {
    total() {
      return (Number(this.price) + Number(this.extraCostPrice)).toFixed(2);
    },
  },
};
</script>