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
            <button @click="addItem">Add new Item</button>
        </Card>

        <form @submit.prevent="submit">

            <Card class="py-12">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Submit
                </PrimaryButton>
            </Card>

            <Item v-for="item in form.items" :key="item.id" :types="types"
                  :form="item"
                  :main-form="form"
                  @remove="removeItem(item.id)"></Item>

        </form>

    </AppLayout>
</template>

<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import Card from "../../Components/Card.vue";
import {defineProps, ref} from 'vue';
import Item from "./partials/Item.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import {useForm} from "@inertiajs/vue3";


const props = defineProps({
    types: Array
});

const itemComponents = ref([]);
let itemId = 1;


const form = useForm({
    // Define form fields and validation rules in the parent component
    // Example:
    items: [],
    // ...
});


function addItem() {
    form.items.push(
        {
            id: itemId++,
            type: "",
            value: "",
            identifier: "",
            reason: ""
        }
    )
}

function removeItem(id) {
    const index = form.items.findIndex(item => item.id === id);
    if (index !== -1) {
        form.items.splice(index, 1);
    }
}


const submit = () => {
    form.post(route('rma.store'), {});
};

</script>
