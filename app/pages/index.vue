<template>
  <div>
    <TopNavbar />

    <div class="mt-3">
    
      <div class="d-flex justify-content-center mb-3">
        <input
              v-model="keyword"
              id="keyword"
              class="w-20 mb-sm-0 form-control"
              placeholder="ค้นหาสินค้า"
            >
      </div>
      <p class="text-center"><button class="btn btn-primary" @click="exportFile()">Download Excel File</button></p>
      <b-container>
        
        <div class="table-responsive">
          <b-skeleton-table
            :rows="3"
            :columns="4"
            :table-props="{ bordered: true, striped: true }"
            v-if="$fetchState.pending"
          ></b-skeleton-table>

          <b-table
            id="table-product"
            :items="getProducts"
            :fields="fields"
            :sort-by.sync="sortBy"
            :sort-desc.sync="sortDesc"
            responsive="sm"
            @sort-changed="sortingChanged"
            v-else
          >
          
            <template #cell(created_at)="data">
              {{ formatDateTime(data.value) }}
            </template>
            <template #cell(updated_at)="data">
              {{ formatDateTime(data.value) }}
            </template>
          </b-table>

          <div class="d-flex justify-content-center text-center">
            <b-pagination
              v-model="currentPage"
              :total-rows="ProductTotal"
              :per-page="perPage"
              @change="changePage"
              aria-controls="table-product"
            ></b-pagination>
          </div>
        </div>
      </b-container>
    </div>
  </div>
  
</template>

<script>
let fileDownload = require('js-file-download');
const numeral = require("numeral");
import { mapGetters, mapActions } from "vuex";
export default {
  async fetch() {
    this.AutoLoadProduct({ page: 1 });
  },
  data() {
    return {
      perPage: 10,
      currentPage: 1,
      sortBy: 'price',
      sortDesc: true,
      keyword: null,
      fields: [
        { key: "name", label: "ชื่อสินค้า", sortable: true },
        { key: "price", label: "ราคาสินค้า", sortable: true,formatter: "formatPrice" },
        { key: "created_at", label: "วันที่สร้าง", sortable: true },
        { key: "updated_at", label: "วันที่อัพเดตล่าสุด", sortable: true },
      ],
    };
  },
  created() {
    this.AutoLoadProduct({ page: 1 });
  },
  computed: {
    ...mapGetters({
      getProducts: "getProducts",
      ProductTotal: "getProductTotal",
    }),
  },
  watch: {
    keyword(k){
      if(k.length >= 3){
        this.AutoLoadProduct({keyword: k});
      }else{
        this.AutoLoadProduct({page: 1});
      }
    }
  },
  methods: {
    ...mapActions({
      AutoLoadProduct: "ACTION_LOAD_PRODUCTS",
    }),
    formatPrice(val = null) {
      if (val === null) return 0;
      return numeral(val).format("0.0a");
    },
    formatDateTime(d) {
      if (d === undefined) {
        return ``;
      }
      const ex = this.$dayjs.tz(d, "Asia/Bangkok");
      let y = this.$dayjs(ex).get("year");
      let _d = this.$dayjs(ex).get("date");
      let m = this.$dayjs(ex).month();
      let t = this.$dayjs(ex).format("HH:mm");
      return `${_d} ${this.$dayjs(m).format("MMMM")} ${y + 543} ${t} น.`;
    },
    async changePage(page = 1) {
      this.$fetchState.pending = true;
      await this.AutoLoadProduct({ page: page }).then(() => {
        this.$fetchState.pending = false;
      });
    },
    async sortingChanged(ctx){
      
      await this.AutoLoadProduct({sortBy: ctx.sortBy,sortDesc: ctx.sortDesc})
    },
    async exportFile(){
      this.$nuxt.$loading.start();
      await this.$axios.get(`http://localhost/api/products/export/excel`,{responseType: 'blob'}).then((result) => {
        this.$nuxt.$loading.finish();
        fileDownload(result.data,'product.xlsx');
      }).catch((err) => {
        //handle error.
        console.log(err);
      });
    }
  },
};
</script>

<style lang="css">
.w-20{
  width: 20%;
}
.title {
  font-family: "Quicksand", "Source Sans Pro", -apple-system, BlinkMacSystemFont,
    "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>
