<script setup>
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

defineProps(['PushCart','TotalPriceSum']);
defineEmits(['MinusQuantity','AddQuantity','clearCart','removeCartItem','KeyisNumeric','handleQuantityInputKeyDown','SubmitOrder']);
</script>

<script>
  export default {
    data: () => ({
      baseurl: location.origin,
    }),
  }
</script>

<template>
<v-col cols="12" sm="4" md="4" >
    <v-card
       class="mx-auto "
       
       prepend-icon="mdi-basket"
      
     >
       <template v-slot:title>
         CART AREA
       </template>
       <template v-slot:append>
        <v-btn
        v-if="PushCart.myCart.length!==0"
        size="x-small"
        class="ma-2"
        color="red"
        @click="$emit('clearCart')"
      >
        <v-icon
        start
        icon="mdi-cart-remove"
      
        ></v-icon>
         Clear Cart
      </v-btn>
       </template>
       <v-divider :thickness="8" class="border-opacity-100"></v-divider>
      
       <v-card
       class="overflow-y-auto"
       height="540"
       >
         <v-card 
       class="m-2"
       variant="outlined"
       v-for="(item, index) in PushCart.myCart"
       :key="index"
       >  
      
        <v-row no-gutters>
      <v-col
        cols="12"
        md="2"
        sm="2" 
      >
      <v-sheet class="pa-1 ma-1 d-flex justify-center align-center">
    <v-avatar
      class="ms-2"
      size="60"
      rounded="0"
    >
      <v-img  :src="item.ProductImage ? 'http://127.0.0.1:8000/'+item.ProductImage : baseurl+'/images/DefaultImage.png'"></v-img>
    </v-avatar>
   </v-sheet>
      </v-col>


      <v-col
        cols="12"
        md="3"
        sm="3"
      >
      <v-sheet class="pa-2 ma-2  d-flex justify-center align-center">
    <div>
    <!-- Fix the item.unit, it must be the purchase price -->
    <p> {{ item.ProductName }} <br> ₱ {{ item.SalePrice }}</p> 
    </div>
    </v-sheet>
      </v-col>

      <v-col
        cols="12"
        md="4"
        sm="4"
      >
      <v-sheet class="pa-1 ma-1 d-flex justify-center align-center">
        <div style="width: 150px;">
    <v-text-field class="input-background-color align-text-center" 
    @keypress="$emit('KeyisNumeric',$event,item.PurchaseID)" 
    @keydown="$emit('handleQuantityInputKeyDown',$event,item.PurchaseID)"
    v-model="item.Quantity">

    
    <template v-slot:append>
    <v-icon color="green" @click="$emit('AddQuantity',item.PurchaseID)" >
    mdi-plus-box-outline
    </v-icon>
    </template>
    <template v-slot:prepend>
    <v-icon color="red" @click="$emit('MinusQuantity',item.PurchaseID,item.Quantity)">
    mdi-minus-box-outline
    </v-icon>
    </template>
    </v-text-field>
    </div>
   </v-sheet>
      </v-col>


      <v-col
        cols="12"
        md="3"
        sm="3"
      >
      <v-sheet class="pa-2 ma-2 d-flex justify-center align-center">
        <div>
   
    <p> ₱ {{ item.Price }}<br> Unit: {{ item.TotalUnit }}</p>
    </div>
   </v-sheet>
      </v-col>
      
      <v-icon
        size="small"
        color="red-lighten-1"
        class="ma-1"
        style="position: absolute; top: 0; right: 0"
        @click="$emit('removeCartItem', item.PurchaseID)"
      >
        mdi-delete
      </v-icon> 

    </v-row>
       </v-card>
       </v-card>
     </v-card>
     <v-divider :thickness="6" class="border-opacity-100"></v-divider>

     <v-card class="pa-4">

    

  <v-sheet class="d-flex justify-space-between">

    <p>TOTAL</p>
    <p class="text-h5">₱ {{TotalPriceSum ? TotalPriceSum : 0 }}</p>
  </v-sheet>

  <v-divider :thickness="4" class="border-opacity-100"></v-divider>

  <v-sheet justify="center" align="center" class="pa-1 ma-1 rounded-pill" color="indigo-lighten-1" >
    <v-btn prepend-icon="mdi-cash" append-icon="mdi-cash"  
    @click="$emit('SubmitOrder')">
      PAYMENT
    </v-btn>
  </v-sheet>
</v-card>

       
   
     </v-col>

    </template>