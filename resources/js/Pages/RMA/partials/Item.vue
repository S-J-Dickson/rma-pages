<template>
    <ul>
        <li v-for="subItem in items" :key="subItem.value">

            <InputLabel value="type"/>
            <InputError/>
            <TextInput modelValue=""/>

            {{ subItem.text }}
            {{ subItem.value }}
        </li>
    </ul>
</template>

<script>
import InputLabel from "../../../Components/InputLabel.vue";
import InputError from "../../../Components/InputError.vue";
import TextInput from "../../../Components/TextInput.vue";

export default {
    components: {TextInput, InputError, InputLabel},
    props: {
        items: {
            type: Array,
            required: true
        }
    },
    name: 'RMAItem'
};
</script>
