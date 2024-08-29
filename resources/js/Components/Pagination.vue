<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    paginate: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <div
        class="flex items-center justify-between border-t px-4 py-3 sm:px-6"
    >
        <div class="flex flex-1 justify-between sm:hidden">
            <a
                href="#"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >Previous</a
            >
            <a
                href="#"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >Next</a
            >
        </div>
        <div
            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ paginate.from }}</span>
                    to
                    <span class="font-medium">{{ paginate.to }}</span>
                    of
                    <span class="font-medium">{{ paginate.total }}</span>
                    results
                </p>
            </div>
            <div>
                <nav
                    class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                    aria-label="Pagination"
                >
                    <Link
                        aria-current="page"
                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold focus:z-20 "
                        :class="{
                            'bg-blue-600 z-10 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600': page.active,
                            'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0': !page.active,
                        }"
                        v-for="page in paginate.links"
                        :key="page"
                        v-html="page.label"
                        :href="page.url || ''"
                        preserve-scroll
                    ></Link>
                </nav>
            </div>
        </div>
    </div>
</template>
