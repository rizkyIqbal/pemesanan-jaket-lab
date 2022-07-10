<template>
    <UserLightLayout></UserLightLayout>
    <hr class="mt-5" />
    <main>
        <div class="w-full flex">
            <div class="w-1/2 py-12 pr-8 pl-40">
                <div class="w-full flex">
                    <p class="text-amber-600">Order</p>
                    <div
                        class="flex-grow border-t border-gray-300 mt-3 mx-4"
                    ></div>
                    <p class="text-gray-500">Payment</p>
                    <div
                        class="flex-grow border-t border-gray-300 mt-3 mx-4"
                    ></div>
                    <p class="text-gray-500">Receipt</p>
                </div>
                <div class="mt-14">
                    <p class="font-bold">Personal Informations</p>
                    <div class="mt-6">
                        <label
                            for="title"
                            class="leading-7 text-sm text-gray-900"
                            >Nama</label
                        >
                        <input
                            type="text"
                            class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            v-model="form.name"
                            disabled
                        />
                    </div>
                    <div class="mt-6">
                        <label
                            for="title"
                            class="leading-7 text-sm text-gray-900"
                            >NIM</label
                        >
                        <input
                            type="text"
                            class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            v-model="form.nim"
                            disabled
                        />
                    </div>
                    <div class="mt-6">
                        <label
                            for="title"
                            class="leading-7 text-sm text-gray-900"
                            >Size</label
                        >
                        <select
                            name="size"
                            id="size"
                            class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                        >
                            <option value=""></option>
                            <option value="S">Small</option>
                            <option value="M">Medium</option>
                            <option value="L">Large</option>
                        </select>
                    </div>
                    <div class="flex-grow border-t border-gray-300 mt-12"></div>
                    <div class="relative">
                        <div
                            class="flex absolute lg:inset-y-0 lg:right-0 mt-6 lg:h-12"
                        >
                            <p class="text-sm mr-5 lg:mt-4">Cancel Order</p>
                            <button
                                class="flex items-center py-4 px-4 text-sm text-white bg-theme-primary rounded text-center"
                                type="submit"
                            >
                                Complete Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/2">
                <div class="py-12 pl-8 pr-40">
                    <p class="font-bold">Custom Order</p>
                    <div class="mt-4">
                        <img
                            :src="'/img/jaketlab.png'"
                            alt=""
                            class="h-40 w-full"
                        />
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">
                            {{ jackets.name }}
                        </p>
                    </div>
                    <div class="mt-1.5">
                        <p class="font-extrabold">Rp.150.000</p>
                    </div>
                    <div class="mt-4 text-center">
                        <button
                            class="items-center w-full py-3 text-sm text-primary rounded text-center border-2 border-theme-primary hover:bg-orange-600 hover:text-white"
                            type="submit"
                        >
                            Add Custom Size
                        </button>
                    </div>
                    <div class="mt-4">
                        <div class="flex">
                            <div class="w-1/2">
                                <p class="text-sm">Sub total</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-sm text-right">Rp. 150.000</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex">
                            <div class="w-1/2">
                                <p class="text-sm">Tax</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-sm text-right">Rp. 200</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex">
                            <div class="w-1/2">
                                <p class="text-sm font-bold">Total</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-sm font-bold text-right">
                                    Rp. 150.200
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
import UserLightLayout from "@/Layouts/UserLightLayout";
export default {
    components: {
        UserLightLayout,
    },
    props: {
        jackets: Object,
        sizes: Object,
        user_login: Object,
    },
    data() {
        return {
            form: {
                name: this.user_login.full_name,
                nim: this.user_login.user_name,
            },
        };
    },
};
</script>
