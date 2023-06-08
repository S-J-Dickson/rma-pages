<template>
    <Card class="py-12">
        <InputLabel value="Type"/>
        <select id="type" v-model="form.type">
            <option v-for="item in types" :key="item.value" :value="item.value">{{ item.text }}</option>
        </select>

        <InputError class="mt-2" :message='props.mainForm.errors["items."+ (props.form.id - 1)+ ".type"]'/>

        <!-- Example of using the selected value to populate other fields -->
        <InputLabel value="Item"/>
        <select v-model="form.value" id="item">
            <option v-for="item in getFieldValue" :key="item.value" :value="item.value">{{
                    item.text
                }}
            </option>
        </select>

        <InputError class="mt-2" :message='props.mainForm.errors["items."+ (props.form.id - 1)+ ".value"]'/>

        <InputLabel value="Identifier"/>
        <TextInput v-model="form.identifier" modelValue=""/>
        <InputError class="mt-2" :message='props.mainForm.errors["items."+ (props.form.id - 1)+ ".identifier"]'/>


        <InputLabel value="Reason"/>
        <TextInput v-model="form.reason" modelValue=""/>
        <InputError class="mt-2" :message='props.mainForm.errors["items."+ (props.form.id - 1)+ ".reason"]'/>

        <button @click="handleRemove">Remove</button>
    </Card>
</template>

<script setup>
import {computed, defineProps, defineEmits, ref, getCurrentInstance} from 'vue';
import InputLabel from "../../../Components/InputLabel.vue";
import TextInput from "../../../Components/TextInput.vue";
import Card from "../../../Components/Card.vue";
import InputError from "../../../Components/InputError.vue";


const props = defineProps({
    types: Array,
    form: Object,
    mainForm: Object
});

const test = computed(() => {
    console.log("hello")
    console.log(props.mainForm.errors["items." + (props.form.id - 1) + ".type"])
});

const getFieldValue = computed(() => {
    return searchItemsByValue(props.form.type);
});

function searchItemsByValue(value) {
    const results = [];

    for (const category of props.types) {
        if (category.value === value) {
            results.push(...category.items);
        }
    }


    return results;
}

const emitRemove = defineEmits(['remove']);

const handleRemove = () => {
    emitRemove('remove');
};


</script>
