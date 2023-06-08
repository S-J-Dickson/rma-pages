<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps({
    description: String,
    tasks: Array,
    contact: String,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div class="p-6 px-20 bg-white border-b border-gray-200">
                            <div>
                                <ApplicationLogo class="block h-12 w-auto"/>
                            </div>

                            <div class="mt-8 text-2xl">
                                You've logged in - what's next?
                            </div>
                        </div>

                        <div class="bg-gray-200 bg-opacity-25 grid p-6 text-sm text-gray-500 px-20">
                            <p class="pb-4">
                                You have been tasked to complete the code for a partially written application.
                                This task tests your abilities to design and implement both frontend
                                and backend code that has already been worked on by another developer.

                                Your coding ability, style and techniques used will all be considered
                                when this task is reviewed.
                            </p>


                            <p class="pb-4" v-html="description"/>

                            <p class="pb-4">
                                Here's what we'd like you to do:
                            </p>

                            <ul style="list-style-type: circle" class="pb-4">
                                <li v-for="task in tasks" :key="task" v-html="task"></li>

                                <li>Finally, but most importantly, all tests should pass!</li>
                            </ul>

                            <p class="pb-4">
                                <b>Please note you are not allowed to change the behaviour of any pre-existing tests</b>
                            </p>

                            <p class="pb-4">And that's it. Good luck!</p>

                            <p class="pb-4">
                                All models, migrations, routes, controllers, pages and props etc.
                                have already been created but may not be fully implemented - there will be
                                <code>//todo</code>
                                comments where code and missing needs to be implemented.
                                Factories have been created for any models needed
                                to show examples of data and to allow you to create test data if required.

                                There may be some code that needs to be changed that is not marked with a
                                <code>//todo</code> comment, however it should be apparently from the test
                                results where code is failing.
                            </p>

                            <p class="pb-4">
                                For this task, you simply need to create the pages,
                                implement the logic to get everything working.

                                There may be missing relationships, variables, lines of code
                                or even complete functions or classes - it's up to you
                                to implement these however you wish (as long as everything works as expected!).

                                There may also be libraries included that you have not seen before or have limited
                                experience with; this has been done to gauge your adaptability.
                                It is recommended make use of any libraries included however this is not a requirement,
                                especially if you come up with a better solution that doesn't require them!
                            </p>

                            <p class="pb-4">
                                Make sure to check <code>routes/web.php</code> to see which routes have been created for
                                you. <b>Do not modify any existing routes</b>, however feel free to add additional ones
                                if you need to.
                            </p>

                            <p class="pb-4">
                                The specification for each page you need to create can be found on the page's vue
                                template. Simply modify the template to include your implementation. You can make the
                                pages look however you like as long as they are functional and responsive.
                            </p>

                            <p class="pb-4">
                                You are free to add to the composer and npm dependencies as long as the packages are not
                                private or proprietary.
                                Inventive use of external libraries is encouraged (and bonus points if you made any of
                                the libraries yourself)
                                - there's no need to reinvent the wheel!
                            </p>

                            <p class="pb-4">
                                Once you have completed the task, please send an archive of or a link to a GitHub
                                repository that contains the completed task's source code to
                                <a :href="`mailto:${contact}`" style="color: blue">{{ contact }}</a>.
                                The project should run without any modifications to config files or .env
                                (make sure to include .env with your source code!)
                            </p>

                            <p>If you have any questions about the task, please send an email to the above contact.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
