<template>
    <Card class="py-12">
        <InputLabel value="Type"/>
        <select id="type" v-model="selectedType">
            <option v-for="item in types" :key="item.value" :value="item.value">{{ item.text }}</option>
        </select>

        <!-- Example of using the selected value to populate other fields -->
        <div>
            <InputLabel value="Item"/>
            <select id="item">
                <option v-for="item in getFieldValue" :key="item.value" :value="item.value">{{
                        item.text
                    }}
                </option>
            </select>
        </div>

        <InputLabel value="Identifier"/>
        <TextInput modelValue=""/>

        <InputLabel value="Reason"/>
        <TextInput modelValue=""/>

        <button @click="handleRemove">Remove</button>
    </Card>
</template>

<script setup>
import {computed, defineProps, defineEmits, ref, getCurrentInstance} from 'vue';
import InputLabel from "../../../Components/InputLabel.vue";
import TextInput from "../../../Components/TextInput.vue";
import Card from "../../../Components/Card.vue";


const props = defineProps({
    types: Array
});

const selectedType = ref('');

const getFieldValue = computed(() => {
    return searchItemsByValue(selectedType.value);
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
