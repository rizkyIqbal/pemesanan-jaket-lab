<template>
    <div class="relative bg-theme-secondary overflow-hidden">
        <div class="max-w-7xl mx-auto h-fit">
            <div
                class="relative z-10 pb-8 bg-theme-secondary sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32"
            >
                <svg
                    class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                    fill="currentColor"
                    viewBox="0 0 100 100"
                    preserveAspectRatio="none"
                    aria-hidden="true"
                ></svg>

                <UserDarkLayout></UserDarkLayout>

                <main
                    class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28"
                >
                    <div class="sm:text-center lg:text-left">
                        <h1
                            class="text-7xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-7xl"
                        >
                            <span class="block xl:inline text-white"
                                >Order Your Lab's</span
                            >
                            {{ " " }}
                            <span class="block xl:inline text-white"
                                >Jacket</span
                            >
                        </h1>
                        <p
                            class="mt-3 text-base text-gray-400 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-base lg:mx-0"
                        >
                            Anim aute id magna aliqua ad ad non deserunt sunt.
                            Qui irure qui lorem cupidatat commodo. Elit sunt
                            amet fugiat veniam occaecat fugiat aliqua.
                        </p>
                        <div
                            class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start"
                        >
                            <div class="rounded-md shadow">
                                <a
                                    href="#"
                                    class="bg-theme-primary w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white hover:bg-indigo-700 md:py-4 md:text-lg md:px-10"
                                >
                                    Order Now
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 lg:pl-24">
            <img
                class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-auto lg:h-full lg:right-0"
                src="https://www.pngall.com/wp-content/uploads/1/Lab-Coat-PNG-Image-HD.png"
                alt=""
            />
        </div>
    </div>
</template>

<script>
import UserDarkLayout from "@/Layouts/UserDarkLayout";
export default {
    components: {
        UserDarkLayout,
    },
};
</script>
