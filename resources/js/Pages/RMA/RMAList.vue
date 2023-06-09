<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import Card from "../../Components/Card.vue";
import {Link} from '@inertiajs/vue3';
import {defineProps, ref,} from 'vue';

const props = defineProps({
    data: Array,
});

const search = ref('');
const loading = ref(false);

const headers = [
    {title: 'Created By', key: 'created_by'},
    {title: 'Created At', key: 'created_at'},
    {title: 'items', key: 'items'},
    { title: 'Item Count', key: 'item_count'},
    {title: '', key: 'rma_link'},
];


</script>

<template>
    <AppLayout>
        <Card class="py-12">
            <p class="pb-4">Implement your RMA list here</p>

            <p class="pb-4">
                The list should be a data table or other logical way to represent all the
                available data
            </p>

            <p class="pb-4">Each item in the list should have the following:</p>

            <ul class="pb-4" style="list-style-type: circle">
                <li>Text displaying who created the RMA</li>
                <li>The date and time that the RMA was created</li>
                <li>A single string representing the items found on the RMA</li>
                <li>A link to visit the RMA's more detailed information page (<code>rma.show</code>)</li>
            </ul>

            <p class="pb-4">
                Make sure to check the <code>RMAController</code> and <code>RMAInListResource</code> classes
                to see what's already been implemented
            </p>

            <p class="pb-4">There should also be a button somewhere on the page to create a new RMA.
                This should take you to the <code>rma.create</code> route</p>

            <p>
                <Link :href="route('rma.create')">Click to Visit Create RMA Page</Link>
            </p>
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


