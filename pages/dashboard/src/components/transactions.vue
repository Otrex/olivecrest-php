<template>
  <div>
    <h2 v-if='!data' > No Transactions Made </h2>
    <b-table striped hover :items="data" :fields="fields" v-if='data'></b-table>
  </div>
</template>

<script>
  export default {
    name: "transactions",
    props: {
      data : Array
    },
    data() {
      return {
        // Note 'isActive' is left out and will not appear in the rendered table
        fields: [
          {
            label: 'Transaction Type',
            key: 'type',
            sortable: false
          },
          {
            label: 'Amount',
            key:'amount',
            sortable: true
          },
          {
            label: 'Reciever',
            key: 'to',
            sortable: true,
          }
          // {
          //   key: 'last_name',
          //   sortable: true
          // },
          // {
          //   key: 'first_name',
          //   sortable: false
          // },
          // {
          //   key: 'age',
          //   label: 'Person age',
          //   sortable: true,
          //   // Variant applies to the whole column, including the header and footer
          //   variant: 'danger'
          // }
        ],
        items: [
          { isActive: true, age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
          { isActive: false, age: 21, first_name: 'Larsen', last_name: 'Shaw' },
          { isActive: false, age: 89, first_name: 'Geneva', last_name: 'Wilson' },
          { isActive: true, age: 38, first_name: 'Jami', last_name: 'Carney' }
        ]
      }
    }
  };
</script>