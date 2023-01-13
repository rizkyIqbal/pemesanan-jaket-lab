<template>
    <!-- Sidebar starts -->
    <!-- Remove class [ hidden ] and replace [ sm:flex ] with [ flex ] -->
    <div
        class="w-64 absolute sm:relative bg-white shadow md:h-full flex-col justify-between hidden sm:flex min-h-screen"
    >
        <div class="px-8">
            <div class="h-16 w-full flex items-center">
                <img
                    alt="Workflow"
                    class="h-20 w-auto sm:h-20 mt-16"
                    :src="'data:image/png;base64,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'"
                />
            </div>
            <ul class="mt-16">
                <li
                    class="flex w-full justify-between text-gray-600 hover:text-gray-500 cursor-pointer items-center mb-6"
                >
                    <Link
                        :href="route('admin.index')"
                        class="nav-link px-sm-0 px-2"
                    >
                        <div class="flex items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-grid"
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <rect
                                    x="4"
                                    y="4"
                                    width="6"
                                    height="6"
                                    rx="1"
                                ></rect>
                                <rect
                                    x="14"
                                    y="4"
                                    width="6"
                                    height="6"
                                    rx="1"
                                ></rect>
                                <rect
                                    x="4"
                                    y="14"
                                    width="6"
                                    height="6"
                                    rx="1"
                                ></rect>
                                <rect
                                    x="14"
                                    y="14"
                                    width="6"
                                    height="6"
                                    rx="1"
                                ></rect>
                            </svg>
                            <span class="text-sm ml-2">Dashboard</span>
                        </div>
                    </Link>
                </li>
                <li
                    class="flex w-full justify-between text-gray-600 hover:text-gray-500 cursor-pointer items-center mb-6"
                >
                    <Link
                        :href="route('admin.jacket.index')"
                        class="nav-link px-sm-0 px-2"
                    >
                        <div class="flex items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-puzzle"
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M4 7h3a1 1 0 0 0 1 -1v-1a2 2 0 0 1 4 0v1a1 1 0 0 0 1 1h3a1 1 0 0 1 1 1v3a1 1 0 0 0 1 1h1a2 2 0 0 1 0 4h-1a1 1 0 0 0 -1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-1a2 2 0 0 0 -4 0v1a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1h1a2 2 0 0 0 0 -4h-1a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1"
                                ></path>
                            </svg>
                            <span class="text-sm ml-2">Jackets</span>
                        </div>
                    </Link>
                </li>
                <li
                    class="flex w-full justify-between text-gray-600 hover:text-gray-500 cursor-pointer items-center mb-6"
                >
                    <Link
                        :href="route('admin.transaction.index')"
                        class="nav-link px-sm-0 px-2"
                    >
                        <div class="flex items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-compass"
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <polyline
                                    points="8 16 10 10 16 8 14 14 8 16"
                                ></polyline>
                                <circle cx="12" cy="12" r="9"></circle>
                            </svg>
                            <span class="text-sm ml-2">Transactions</span>
                        </div>
                    </Link>
                </li>
                <li
                    class="flex w-full justify-between text-gray-600 hover:text-gray-500 cursor-pointer items-center mb-6"
                >
                    <Link
                        :href="route('admin.bank.index')"
                        class="nav-link px-sm-0 px-2"
                    >
                        <div class="flex items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-compass"
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <polyline
                                    points="8 16 10 10 16 8 14 14 8 16"
                                ></polyline>
                                <circle cx="12" cy="12" r="9"></circle>
                            </svg>
                            <span class="text-sm ml-2">Banks</span>
                        </div>
                    </Link>
                </li> 
                <li
                    class="flex w-full justify-between text-gray-600 hover:text-gray-500 cursor-pointer items-center mb-6"
                >
                    <Link
                        :href="route('admin.check.index')"
                        class="nav-link px-sm-0 px-2"
                    >
                        <div class="flex items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-compass"
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <polyline
                                    points="8 16 10 10 16 8 14 14 8 16"
                                ></polyline>
                                <circle cx="12" cy="12" r="9"></circle>
                            </svg>
                            <span class="text-sm ml-2">Check Transaction</span>
                        </div>
                    </Link>
                </li>
                <li
                    class="flex w-full justify-between text-gray-600 hover:text-gray-500 cursor-pointer items-center mb-6"
                >
                    <Link
                        :href="route('admin.countdown.index')"
                        class="nav-link px-sm-0 px-2"
                    >
                        <div class="flex items-center">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-compass"
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                <polyline
                                    points="8 16 10 10 16 8 14 14 8 16"
                                ></polyline>
                                <circle cx="12" cy="12" r="9"></circle>
                            </svg>
                            <span class="text-sm ml-2">Pre Order</span>
                        </div>
                    </Link>
                </li>
                <div class="flex-grow border-t border-gray-300"></div>
                <li
                    class="flex w-full justify-between text-gray-600 hover:text-gray-500 cursor-pointer items-center mb-6 mt-4"
                >
                    <Link class="nav-link px-sm-0 px-2">
                        <div class="flex items-center">
                            <button @click="logout">
                                <span class="text-sm ml-2">Logout</span>
                            </button>
                        </div>
                    </Link>
                </li>
            </ul>
        </div>
    </div>
    <!-- Sidebar ends -->
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Link,
    },
    name: "LightWithIconsAtBottom",
    data() {
        return {
            moved: true,
        };
    },
    methods: {
        sidebarHandler() {
            var sideBar = document.getElementById("mobile-nav");
            sideBar.style.transform = "translateX(-260px)";
            if (this.$data.moved) {
                sideBar.style.transform = "translateX(0px)";
                this.$data.moved = false;
            } else {
                sideBar.style.transform = "translateX(-260px)";
                this.$data.moved = true;
            }
        },
        logout() {
            this.$inertia.post(this.route("logout"));
        },
    },
};
</script>
