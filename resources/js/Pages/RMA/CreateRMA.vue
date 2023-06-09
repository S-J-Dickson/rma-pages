<template>
    <AppLayout>

        <Card class="py-4">
            <button @click="addItem">Add new Item</button>
        </Card>

        <form @submit.prevent="submit">


            <Item v-for="item in form.items" :key="item.id" :types="types"
                  :form="item"
                  :main-form="form"
                  @remove="removeItem(item.id)"></Item>


            <Card class="py-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Submit
                </PrimaryButton>
            </Card>

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
