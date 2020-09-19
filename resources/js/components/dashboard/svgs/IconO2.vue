<template>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 96 120"
        :class="$store.getters.o2Status.status === 1 ? 'text-green-500 hover:text-green-700' : 'text-gray-500 hover:text-gray-700'"
        class="fill-current mx-auto h-12 w-12 mt-2 lg:w-16 lg:h-16 lg:mt-0">
        <path
            d="M43,12a2,2,0,0,0-2,2v6A25,25,0,0,0,23,44V86a2,2,0,0,0,2,2H71a2,2,0,0,0,2-2V44A25,25,0,0,0,55,20V14a2,2,0,0,0-2-2H50V8h8a2,2,0,0,0,0-4H38a2,2,0,0,0,0,4h8v4ZM69,84H27V70H69Zm0-18H27V50H69Zm0-22v2H27V44a21,21,0,0,1,42,0ZM51,16v3.19a24.24,24.24,0,0,0-6,0V16Z" />
    </svg>
</template>

<script>
export default {
    props: ['o2Status']
}
</script>