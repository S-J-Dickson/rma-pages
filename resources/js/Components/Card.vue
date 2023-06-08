<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="bg-gray-200 bg-opacity-25 grid p-6 text-sm text-gray-500 px-20">
                <slot/>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Card"
}
</script>

<style scoped>

</style>
