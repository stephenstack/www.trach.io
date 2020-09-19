<template>
    <div>
        <!-- //{ "type": "user added", "user_name": "Stephen Stack", "user_email": "orla@trach.iowegwegcssc", "message": "A new user was added recently." } -->
        <p class="text-gray-700">{{data.message}}</p>
        <p class="text-gray-500 text-sm">{{data.user_name}}</pclas>
        <p class="text-gray-500 text-sm">{{data.user_email}}</p>
    </div>
</template>

<script>
    export default {
        props: ['data']
    }
</script>
