<template>
    <UserLightLayout></UserLightLayout>
    <hr class="mt-5" />
    <main>
        <form @submit.prevent="insert" class="space-y-6">
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
                                >No. Telp Aktif</label
                            >
                            <input
                                type="text"
                                class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                v-model="form.phone"
                            />
                        </div>
                        <div class="mt-6">
                            <label
                                for="title"
                                class="leading-7 text-sm text-gray-900"
                                >Size</label
                            >
                            <select
                                v-model="form.size"
                                name="size"
                                id="size"
                                class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            >
                                <option value="" disabled>
                                    Pilih kategori
                                </option>
                                <!-- <option value=""></option> -->
                                <option
                                    v-for="size in sizes"
                                    :key="size.id"
                                    :value="size.id"
                                >
                                    {{ size.name }}
                                </option>
                            </select>
                        </div>
                        <div
                            class="flex-grow border-t border-gray-300 mt-12"
                        ></div>
                        <div class="relative">
                            <div
                                class="flex absolute lg:inset-y-0 lg:right-0 mt-6 lg:h-12"
                            >
                                <!-- <p class="text-sm mr-5 lg:mt-4 text-gray-500">
                                    Cancel Order
                                </p> -->
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
                        <div
                            class="mt-4 h-40 overflow-hidden"
                            @click="openModalImg"
                        >
                            <img
                                :src="'/storage/' + jacket.image"
                                alt=""
                                class="h-fit w-full"
                            />
                            <!-- <img v-else src="" alt="" /> -->
                        </div>
                        <div class="mt-4">
                            <p class="font-semibold">
                                {{ jacket.name }}
                            </p>
                        </div>
                        <div class="mt-1.5">
                            <p class="font-extrabold">Rp. {{ jacket.price }}</p>
                        </div>
                        <div class="mt-4 text-center">
                            <button
                                class="items-center w-full py-3 text-sm text-primary rounded text-center border-2 border-theme-primary hover:bg-orange-600 hover:text-white"
                                type="button"
                                @click="openModal"
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
                                    <p class="text-sm text-right">
                                        Rp.{{ jacket.price }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex">
                                <div class="w-1/2">
                                    <p class="text-sm">Tax (A/B/C) > 3XL</p>
                                </div>
                                <div class="w-1/2">
                                    <p class="text-sm text-right">Rp. 10000</p>
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
                                        Rp. {{ jacket.price }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <TransitionRoot appear :show="isOpen" as="template">
                <Dialog as="div" @close="closeModal" class="relative z-10">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0"
                        enter-to="opacity-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                    >
                        <div class="fixed inset-0 bg-black bg-opacity-25" />
                    </TransitionChild>

                    <div class="fixed inset-0 overflow-y-auto">
                        <div
                            class="flex min-h-full items-center justify-center p-4 text-center"
                        >
                            <TransitionChild
                                as="template"
                                enter="duration-300 ease-out"
                                enter-from="opacity-0 scale-95"
                                enter-to="opacity-100 scale-100"
                                leave="duration-200 ease-in"
                                leave-from="opacity-100 scale-100"
                                leave-to="opacity-0 scale-95"
                            >
                                <DialogPanel
                                    class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                                >
                                    <DialogTitle
                                        as="h3"
                                        class="text-lg font-medium leading-6 text-gray-900"
                                    >
                                        Add Custom Size
                                    </DialogTitle>
                                    <div class="mb-4">
                                        <label
                                            for="title"
                                            class="leading-7 text-sm text-gray-900"
                                            >A Ukuran</label
                                        >
                                        <input
                                            type="text"
                                            class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                            v-model="form.a"
                                        />
                                    </div>
                                    <div class="mb-4">
                                        <label
                                            for="title"
                                            class="leading-7 text-sm text-gray-900"
                                            >B Ukuran</label
                                        >
                                        <input
                                            type="text"
                                            class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                            v-model="form.b"
                                        />
                                    </div>
                                    <div class="mb-4">
                                        <label
                                            for="title"
                                            class="leading-7 text-sm text-gray-900"
                                            >C Ukuran</label
                                        >
                                        <input
                                            type="text"
                                            class="w-full bg-opacity-40 rounded-lg border border-gray-400 focus:border-primary-100 focus:ring-1 focus:ring-primary-100 text-base outline-none text-gray-900 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                            v-model="form.c"
                                        />
                                    </div>

                                    <div class="mt-4">
                                        <button
                                            type="button"
                                            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                            @click="closeModal"
                                        >
                                            Submit
                                        </button>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>
            <TransitionRoot appear :show="imgOpen" as="template">
                <Dialog as="div" @close="closeModalImg" class="relative z-10">
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0"
                        enter-to="opacity-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                    >
                        <div class="fixed inset-0 bg-black bg-opacity-25" />
                    </TransitionChild>

                    <div class="fixed inset-0 overflow-y-auto">
                        <div
                            class="flex min-h-full items-center justify-center p-4 text-center"
                        >
                            <TransitionChild
                                as="template"
                                enter="duration-300 ease-out"
                                enter-from="opacity-0 scale-95"
                                enter-to="opacity-100 scale-100"
                                leave="duration-200 ease-in"
                                leave-from="opacity-100 scale-100"
                                leave-to="opacity-0 scale-95"
                            >
                                <DialogPanel
                                    class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                                >
                                    <DialogTitle
                                        as="h3"
                                        class="text-lg font-medium leading-6 text-gray-900"
                                    >
                                        Jacket Picture
                                    </DialogTitle>
                                    <img
                                        :src="'/storage/' + jacket.image"
                                        alt=""
                                        class="h-full w-full mt-4"
                                    />
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>
        </form>
    </main>
</template>
<script>
import { ref } from "vue";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";

const isOpen = ref(false);

const imgOpen = ref(false);

import UserLightLayout from "@/Layouts/UserLightLayout";
import footerlanding from "@/partials/user/FooterTransaction";
export default {
    setup() {
        return {
            isOpen,
            imgOpen,
        };
    },
    components: {
        UserLightLayout,
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle,
        isOpen,
        footerlanding,
    },
    props: {
        jacket: Object,
        sizes: Object,
        user_login: Object,
    },
    data() {
        return {
            form: {
                name: this.user_login.full_name,
                nim: this.user_login.user_name,
                phone: "",
                size: "",
                a: "",
                b: "",
                c: "",
            },
            custom: {
                a: "",
                b: "",
                c: "",
            },
        };
    },
    methods: {
        insert() {
            this.$inertia.post(this.route("user.transaction.store"), this.form);
        },
        closeModal() {
            isOpen.value = false;
        },
        openModal() {
            // console.log("haha");
            isOpen.value = true;
        },
        openModalImg() {
            imgOpen.value = true;
        },
        closeModalImg() {
            imgOpen.value = false;
        },
    },
};
</script>
