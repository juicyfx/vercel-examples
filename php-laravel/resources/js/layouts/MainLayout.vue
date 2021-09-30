<template functional>
<div class="flex flex-wrap md:flex-no-wrap w-full max-w-5xl mx-auto" key="main">
    <div class="w-full md:w-1/3 md:border-r-2 border-red-200 md:min-h-screen">
        <div class="sticky top-0 p-8 max-h-screen overflow-y-auto">
            <div class="w-full">
                <div class="w-16 h-16 bg-red-500 rounded-full" />
            </div>

            <p class="font-bold py-8">{{ parent.$store.state.author }}</p>
            <p class="text-gray-600">
                <!-- Bio -->
                Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu.
            </p>

            <div class="flex flex-wrap my-8">
                <span class="w-full my-2">
                    <RouterLink
                        exact-active-class="border-b border-gray-600"
                        to="/">
                        Articles
                    </RouterLink>
                </span>
                <span class="w-full my-2">
                    <RouterLink
                        exact-active-class="border-b border-gray-600"
                        to="/about">
                        About Me
                    </RouterLink>
                </span>
                <span class="w-full my-2">
                    <RouterLink
                        exact-active-class="border-b border-gray-600"
                        to="/contact">
                        Contact Me
                    </RouterLink>
                </span>
            </div>
            <p class="text-gray-500 font-hairline text-sm italic">© All Rights reserved</p>
        </div>
    </div>

    <div class="w-full md:w-2/3 overflow-hidden">
        <slot />
    </div>
</div>
</template>
