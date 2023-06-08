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
                <li>The type, value, reason and identifier (if applicable) for each item on the RMA</li>
            </ul>
        </Card>
    </AppLayout>
</template>
