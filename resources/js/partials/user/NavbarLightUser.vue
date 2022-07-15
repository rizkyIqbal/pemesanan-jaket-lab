<template>
    <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
        <nav
            class="relative flex items-center justify-between sm:h-10 lg:justify-start"
            aria-label="Global"
        >
            <div
                class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0"
            >
                <div class="flex items-center justify-between w-full md:w-auto">
                    <a href="#">
                        <span class="sr-only">Workflow</span>
                        <img
                            alt="Workflow"
                            class="h-20 w-auto sm:h-20"
                            :src="'/img/labitputih.png'"
                        />
                    </a>
                    <div class="-mr-2 flex items-center md:hidden">
                        <PopoverButton
                            class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        >
                            <span class="sr-only">Open main menu</span>
                            <MenuIcon class="h-6 w-6" aria-hidden="true" />
                        </PopoverButton>
                    </div>
                </div>
            </div>
            <div class="hidden md:block md:ml-10 md:pr-4 md:space-x-8">
                <a
                    v-for="item in navigation"
                    :key="item.name"
                    :href="item.href"
                    class="font-medium text-black hover:text-gray-300"
                    >{{ item.name }}</a
                >
            </div>
        </nav>
    </div>
</template>

<script setup>
const navigation = [
    { name: "Home", href: route("user.index") },
    { name: "Order", href: route("user.transaction.index") },
    { name: "About Us", href: "#" },
];
</script>
