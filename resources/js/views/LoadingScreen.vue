<template>
    <div class="w-screen h-screen bg-indigo-400 overflow-hidden flex justify-center items-center text-white ">
        <div class="m-auto">
            <p id="loading"></p>
            <p>Loading...</p>
        </div>
    </div>
</template>

<script>

export default {

}
</script>

<style scoped>
#loading {
  display: inline-block;
  width: 50px;
  height: 50px;
  border: 3px solid rgba(255,255,255,.3);
  border-radius: 50%;
  border-top-color: #fff;
  animation: spin 1s ease-in-out infinite;
  -webkit-animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to { -webkit-transform: rotate(360deg); }
}
@-webkit-keyframes spin {
  to { -webkit-transform: rotate(360deg); }
}
</style>