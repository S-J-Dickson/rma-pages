<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import Card from "../../Components/Card.vue";
import Title from "../../Components/Title.vue";

defineProps({
    created_at: String,
    created_by: String,
    items: Array
});
</script>

<template>
    <AppLayout>
        <Card class="py-12">
            <Title :title="'RMA Information'"></Title>


            <div class="flex space-x-4 shadow-md bg-white p-4 mb-8">
                <div class="w-1/2">
                    <div class="shadow-md bg-white p-4">
                        <h3 class="text-xl font-bold mb-2">Created by</h3>
                        <p>{{ created_by }}</p>
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="shadow-md bg-white p-4">
                        <h3 class="text-xl font-bold mb-2">Created at</h3>
                        <p>{{ created_at }}</p>
                    </div>
                </div>
            </div>

            <h3 class="text-xl font-bold mb-2">Items</h3>

            <div class="shadow-md bg-white p-4 mb-8 overflow-auto" style="max-height: 400px;">
                <ul>
                    <li v-for="item in items" :key="item.identifier" class="mb-4">
                        <div class="shadow-md bg-white p-6">
                            <h4 class="text-lg font-bold mb-2">Type: {{ item.type }}</h4>
                            <p>Value: {{ item.value }}</p>
                            <p>Reason: {{ item.reason }}</p>
                            <p v-if="item.identifier">Identifier: {{ item.identifier }}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </Card>
    </AppLayout>
</template>
