<template>
  <v-container fluid fill-height class="mt-5 d-flex align-start">
    <v-col v-if="!isLoading" class="text-left">
      <v-row>
        <v-col offset="2">
          <CartItems />
        </v-col>
      </v-row>
      <v-row>
        <v-col offset="2">
          <v-row style="max-width:850px" class="my-2 d-flex justify-end">
            <v-btn
              :disabled="!CartItemLength"
              color="warning"
              depressed
              large
              rounded
              @click="checkout()"
              >Checkout
            </v-btn>
          </v-row>
        </v-col>
      </v-row>
    </v-col>
    <v-snackbar
      v-model="snackbar"
      :timeout="2000"
      color="red"
      absolute
      centered
      class="text-center"
    >
      <strong>Total price cannot less than 0!</strong>
    </v-snackbar>
    <v-snackbar
      v-model="errorMessageSnackbar"
      :timeout="2000"
      color="red"
      centered
      class="text-center"
    >
      <strong>{{ ErrorMessage }}</strong>
    </v-snackbar>
  </v-container>
</template>

<script>
import CartItems from "@/components/CartItems";
import { mapGetters } from "vuex";

export default {
  components: { CartItems },
  data() {
    return { isLoading: true, snackbar: false, errorMessageSnackbar: false };
  },
  computed: {
    ...mapGetters({ CartItemLength: "shoppingCart/CartItemLength" }),
    ...mapGetters({ ErrorMessage: "shoppingCart/ErrorMessage" }),
    ...mapGetters({ UserId: "login/Id" })
  },
  async created() {
    await this.$store.dispatch("products/getAllItems");
    this.isLoading = false;
  },
  methods: {
    async checkout() {
      await this.$store.dispatch("shoppingCart/Checkout", this.UserId);
    }
  }
};
</script>

<style></style>
