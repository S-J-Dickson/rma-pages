<script setup>
import AppLayout from "../../Layouts/AppLayout.vue";
import Card from "../../Components/Card.vue";

defineProps({
    created_at: String,
    created_by: String,
    items: Array
});
</script>

<template>
    <AppLayout>
        <Card class="py-12">
            <p class="pb-4">Implement your create RMA page here</p>

            <p class="pb-4">The page should show the following:</p>

            <ul style="list-style-type: circle">
                <li>When the RMA was created</li>
                <li>Who created the RMA</li>
                <li>The type, value, reason, and identifier (if applicable) for each item on the RMA</li>
            </ul>
        </Card>

        <Card class="py-12">
            <h2 class="text-2xl font-bold mb-4">RMA Information</h2>

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
