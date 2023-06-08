<template>
    <AppLayout>
        <Card class="py-12">
            <p class="pb-4">Implement your create RMA page here</p>

            <p class="pb-4">The page should have the following:</p>

            <ul class="pb-4" style="list-style-type: circle">
                <li>A way to add an additional item to the RMA</li>
                <li>A way to edit an existing an item on the RMA</li>
                <li>A way to remove an item from the RMA</li>
                <li>A way to submit the create request once all information has been entered</li>
            </ul>

            <p class="pb-4">Each RMA item should have the following:</p>

            <ul style="list-style-type: circle">
                <li>A way to select the item's type</li>
                <li>A way to select the item's value</li>
                <li>A way to input the item's identifier</li>
            </ul>
        </Card>


        <Card class="py-12">
            <button @click="createItem">Add new Item</button>
        </Card>

        <Item v-for="item in itemComponents" :key="item.id" :types="types"
              @remove="removeItem(item.id)"></Item>


    </AppLayout>
</template>

<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import Card from "../../Components/Card.vue";
import {defineProps, ref} from 'vue';
import Item from "./partials/Item.vue";


const props = defineProps({
    types: Array
});

const itemComponents = ref([]);
let itemId = 1;

function createItem() {
    itemComponents.value.push({
        id: itemId++,
    });
}

function removeItem(id) {
    const index = itemComponents.value.findIndex(item => item.id === id);
    if (index !== -1) {
        itemComponents.value.splice(index, 1);
    }
}

</script>
