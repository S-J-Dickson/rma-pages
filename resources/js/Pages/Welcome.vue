<script setup>
import {Link} from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.user" :href="route('dashboard')"
                  class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard
            </Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                      class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register
                </Link>
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:pt-0">
                <img src="/images/logo.png" alt="GivEnergy Logo" style="max-width: 300px">
            </div>

            <div class="mt-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <div class="mb-4 text-2xl">
                    Welcome to the GivEnergy create-rma-pages technical task
                </div>

                <div class="text-gray-600 dark:text-gray-400 text-sm">
                    Register an account to find out what you need to do next
                </div>
            </div>

            <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
            </div>
        </div>
    </div>
</template>
