<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import Card from "../../Components/Card.vue";
import {Link} from '@inertiajs/vue3';
import {defineProps, ref,} from 'vue';
import Title from "../../Components/Title.vue";

const props = defineProps({
    data: Array,
});

const search = ref('');
const loading = ref(false);

const headers = [
    {title: 'Created By', key: 'created_by'},
    {title: 'Created At', key: 'created_at'},
    {title: 'items', key: 'items'},
    {title: 'Item Count', key: 'item_count'},
    {title: '', key: 'rma_link'},
];


</script>

<template>
    <AppLayout>

        <Card class="py-12">
            <Title :title="'RMA Information'"></Title>
        </Card>

        <Card class="pb-12">
            <Link :href="route('rma.create')" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Click to Visit Create RMA Page
            </Link>
        </Card>

        <Card>
            <v-data-table
                :headers="headers"
                :items="props.data"
                item-key="created_at"
                :search="search"
                :loading="loading"
                class="elevation-1"
            >

                <template #item.items="{ item }">
                    <ul>
                        <li v-for="(identifier, index) in item.selectable.item_identifiers.slice(0, 2)" :key="index">
                            {{ identifier.type }} ({{ identifier.identifier }}),
                        </li>
                        <li v-if="item.selectable.item_identifiers.length > 2">...</li>
                    </ul>
                </template>

                <template #item.item_count="{ item }">
                    {{ item.selectable.item_identifiers.length }}
                </template>

                <template #item.rma_link="{ item }">
                    <Link :href="route('rma.show', { rma: item.selectable.id })">See More Details</Link>
                </template>
            </v-data-table>
        </Card>

    </AppLayout>
</template>


