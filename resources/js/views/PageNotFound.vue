<template>
     <div class="flex-1">
        <div class="w-full sm:w-full md:w-full lg:w-3/4 xl:w-3/4 mx-auto">

            <div class="flex justify-center mt-12">
                <img src="images/icons8-broken-link-96.png" />
            </div>
            <div class="flex justify-center mt-2 text-6xl">
                404
            </div>
            <div class="flex justify-center mt-2 text-2xl">
                Ooops!!
            </div>
            <div class="flex justify-center mt-2 text-2xl">
                That page does not exist or could not be found!!
            </div>
            <div class="flex justify-center mt-10 text-xl">
                <button class="rounded bg-blue-600 hover:bg-blue-500 shadow-xl text-white px-4 py-1">Go back home</button>
            </div>

        </div>

    </div>
</template>

<script>

import Alert from '../components/Alert';
export default {
    data: () => ({

    }),
    components: {
        'alert': Alert,
    },
    methods: {

    },

    created () {

    },
    mounted() {

    }
}
</script>

