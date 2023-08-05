<template>
  <v-container fluid fill-height class="d-flex align-center">
    <v-col class="mb-10">
      <v-row class="text-color-info my-3" justify="center">
        <h1>訊息</h1>
      </v-row>
      <v-row justify="center">
        <h2>{{this.text}}</h2>
        <v-card outlined max-width="1200">
          <template v-for="(msn, index) in msns">
            <v-list-item :key="index">
              <v-row class="text-color-info my-1">
                <v-col cols="12" class="text-left" align-self="center">
                 <h4>{{ msn.Date }}</h4> 
                  <span>寄件人：{{ msn.Sender }}</span>
                  <br />
                  <br />
                  <span>標題：{{ msn.Topic }}</span>
                </v-col>
                <v-col cols="12" class="text-left">
                  <span> 內容:<br>{{ msn.Content }}</span>
                  <hr />
                </v-col>
              </v-row>
            </v-list-item>
          </template>
        </v-card>
      </v-row>
    </v-col>
  </v-container>
</template>  

<script>
import { Getmsn } from "@/api/msnrecordmyself";
import { mapGetters } from "vuex";

export default {
  
  data() {
    return {
      msns: [],
      text: "沒有訊息"
    };
  },
  computed: {
    ...mapGetters({ UserId: "login/Id" })
  },
  async created() {
    await this.init();
  },
  methods: {
    async init() {
      this.msn = [];
      this.msns.length = 0;
      this.msns = (await Getmsn(this.UserId)).data;
    },
  },
  watch:{
    msns:{
      handler: async function(){
        if (this.msns.length > 0){
          this.text = "";
        }
        else{
          this.text = "沒有訊息";
        }
      }
    }
  }
};
</script>

<style>
.text-color-info{
  font-family:Microsoft JhengHei;
  font-weight:bold;
}
</style>
