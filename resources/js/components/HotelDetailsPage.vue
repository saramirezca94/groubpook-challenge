<template>
  <div
    class="grid grid-cols-1 gap-1 lg:container mx-auto w-full items-center justify-between px-3 mt-5"
  >
    <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400 font-extrabold">
      {{ details.name }}
    </h5>
    <div class="flex items-baseline text-gray-900 dark:text-white">
      <span class="ms-1 text-xl font-normal text-gray-500 dark:text-gray-400"
        >Details</span
      >
    </div>
    <div class="text-center mt-5" v-if="loadingData">
      <div role="status">
        <svg
          aria-hidden="true"
          class="inline w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
          viewBox="0 0 100 101"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
            fill="currentColor"
          />
          <path
            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
            fill="currentFill"
          />
        </svg>
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <ul role="list" class="space-y-5 my-7" v-if="!loadingData">
      <li class="flex items-center">
        <svg
          class="flex-shrink-0 w-4 h-4 text-blue-700 dark:text-blue-500"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
          />
        </svg>
        <span
          class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400 ms-3"
          ><span class="font-extrabold">Status: </span> {{ details.business_status }}</span
        >
      </li>
      <li class="flex">
        <svg
          class="flex-shrink-0 w-4 h-4 text-blue-700 dark:text-blue-500"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
          />
        </svg>
        <span
          class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400 ms-3"
          ><span class="font-extrabold">Website: </span>
          <a v-bind:href="details.website" target="_blank">{{ details.website }}</a></span
        >
      </li>
      <li class="flex">
        <svg
          class="flex-shrink-0 w-4 h-4 text-blue-700 dark:text-blue-500"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
          />
        </svg>
        <span
          class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400 ms-3"
          ><span class="font-extrabold">Google maps url: </span>
          <a v-bind:href="details.google_maps_url" target="_blank">{{
            details.google_maps_url
          }}</a></span
        >
      </li>
      <li class="flex">
        <svg
          class="flex-shrink-0 w-4 h-4 text-blue-700 dark:text-blue-500"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
          />
        </svg>
        <span
          class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400 ms-3"
          ><span class="font-extrabold">Address: </span>
          {{ details.formatted_address }}</span
        >
      </li>
      <li class="flex">
        <svg
          class="flex-shrink-0 w-4 h-4 text-blue-700 dark:text-blue-500"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
          />
        </svg>
        <span
          class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400 ms-3"
          ><span class="font-extrabold">Phone: </span>
          {{ details.formatted_phone_number }}</span
        >
      </li>
      <li class="flex">
        <svg
          class="flex-shrink-0 w-4 h-4 text-blue-700 dark:text-blue-500"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
          />
        </svg>
        <span
          class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400 ms-3"
          ><span class="font-extrabold">Reviews: </span> {{ details.ratings_count }}</span
        >
      </li>
    </ul>
    <router-link
        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 mt-5"
        :to="{ path: '/' }"
        >Hotel details</router-link
      >
  </div>
</template>
<script>
export default {
  name: "HotelDetails",
  data() {
    return {
      details: {},
      loadingData: true,
    };
  },
  created() {
    this.hotelDetail();
  },
  methods: {
    hotelDetail() {
      axios.get(`/api/v1/hotels/${this.$route.params.id}`, {}).then((response) => {
        this.details = response.data.data;
        this.loadingData = false;
      });
    },
  },
};
</script>
