<template>
    <Popover>
        <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
            <nav
                class="relative flex items-center justify-between sm:h-10 lg:justify-start"
                aria-label="Global"
            >
                <div
                    class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0"
                >
                    <div
                        class="flex items-center justify-between w-full md:w-auto"
                    >
                        <a href="#">
                            <span class="sr-only">Workflow</span>
                            <img
                                alt="Workflow"
                                class="h-20 w-auto sm:h-20"
                                src="https://yt3.ggpht.com/QkKsX3CLzERVB3fUyse-RrhIm2QNT8tUP_8OyOMSJp9SP_aqCUdb0o9GeSAv52ePRT7rvr7je5o=s900-c-k-c0x00ffffff-no-rj"
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
                        class="font-medium text-white hover:text-gray-300"
                        >{{ item.name }}</a
                    >
                    <a
                        :href="route('user.login')"
                        class="font-medium text-primary hover:text-indigo-500"
                        v-if="$page.props.user.username == null"
                        >Log in
                    </a>
                    <a
                        :href="route('user.logout')"
                        class="font-medium text-primary hover:text-indigo-500"
                        v-if="$page.props.user.username != null"
                        >Log out
                    </a>
                </div>
            </nav>
        </div>

        <transition
            enter-active-class="duration-150 ease-out"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="duration-100 ease-in"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <PopoverPanel
                focus
                class="absolute z-10 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden"
            >
                <div
                    class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden"
                >
                    <div class="px-5 pt-4 flex items-center justify-between">
                        <div>
                            <img
                                class="h-8 w-auto"
                                src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                                alt=""
                            />
                        </div>
                        <div class="-mr-2">
                            <PopoverButton
                                class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            >
                                <span class="sr-only">Close main menu</span>
                                <XIcon class="h-6 w-6" aria-hidden="true" />
                            </PopoverButton>
                        </div>
                    </div>
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <a
                            v-for="item in navigation"
                            :key="item.name"
                            :href="item.href"
                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                            >{{ item.name }}</a
                        >
                    </div>
                    <a
                        href="#"
                        class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100"
                    >
                        Log in
                    </a>
                </div>
            </PopoverPanel>
        </transition>
    </Popover>
</template>

<script setup>
const navigation = [
    { name: "Home", href: route("user.index") },
    // { name: "Order", href: route("user.transaction.index") },
    { name: "About Us", href: route("user.about") },
];
</script>
<!-- <script computed>
 pages() {
          return this.$page.props.pages
      }
</script> -->
