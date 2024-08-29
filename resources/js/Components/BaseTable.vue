<template>
    <div class="relative overflow-x-auto mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <slot name="tableHeader"/>
            </thead>
            <tbody class="bg-white">
                <slot name="tableBody"/>   
            </tbody>
        </table>
    </div>
</template>

