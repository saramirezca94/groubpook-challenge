<template>
  <div
    class="grid grid-cols-1 gap-1 lg:container mx-auto w-full items-center justify-between px-3 mt-5"
  >
    <form>
      <label
        for="search"
        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
        >Address or city</label
      >
      <div class="relative">
        <div
          class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
        >
          <svg
            class="w-4 h-4 text-gray-500 dark:text-gray-400"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 20 20"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
            />
          </svg>
        </div>
        <input
          type="search"
          id="search"
          v-model="address"
          class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Address or city"
          @input="enableButton"
          required
        />
        <button
          @click="addressGeocodeInfo"
          id="searchButton"
          type="button"
          class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          :disabled="buttonDisabled"
          v-bind:class="{
            'cursor-not-allowed': buttonDisabled,
            'opacity-50': buttonDisabled,
          }"
        >
          Search
        </button>
      </div>
    </form>
    <div class="text-center mt-5" v-if="loadingHotels">
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
    <dl
      class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700 mt-4"
      v-if="!loadingHotels"
    >
      <h1
        v-if="address !== ''"
        class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-4xl dark:text-white"
      >
        Hotels near {{ address }}
      </h1>
      <div class="flex flex-col pb-3" v-for="(hotel, index) in hotels">
        <dd class="text-lg font-semibold">Name</dd>
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
          {{ hotel["name"] }}
        </dt>
        <dd class="text-lg font-semibold">Address</dd>
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
          {{ hotel["address"] }}
        </dt>
        <dd class="text-lg font-semibold">Rating</dd>
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
          {{ hotel["rating"] }}
        </dt>
        <router-link
          class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
          :to="{ name: 'hotel-details', params: { id: hotel['place_id'] } }"
          >Hotel details</router-link
        >
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700" />
      </div>
    </dl>
  </div>
</template>
<script>
import toastr from "toastr";

toastr.options = {
  closeButton: true,
  progressBar: true,
  showMethod: "slideDown",
  timeOut: 4000,
};

export default {
  name: "HotelList",
  data() {
    return {
      address: "",
      hotels: [],
      coordinates: "",
      buttonDisabled: true,
      loadingHotels: false,
    };
  },
  methods: {
    hotelList() {
      axios
        .get("/api/v1/hotels", {
          params: {
            location: this.coordinates,
          },
          headers: {
            "Content-Type": "application/json",
          },
        })
        .then((response) => {
          if (response.data.message === "ok") {
            this.hotels = response.data.data.places;
          }
          if (response.data.message !== "ok") {
            toastr.warning(response.data.message);
            this.hotels = [];
          }
          this.loadingHotels = false;
        })
        .catch((error) => {
          this.loadingHotels = false;
          toastr.error(error.response.data.message, "Error");

          if (axios.isCancel(error)) {
            return;
          }
        });
    },
    enableButton() {
      if (this.address.length > 3) {
        return (this.buttonDisabled = false);
      }

      this.buttonDisabled = true;
    },
    addressGeocodeInfo() {
      this.buttonDisabled = true;
      this.loadingHotels = true;
      axios
        .get("/api/v1/search", {
          params: {
            address: this.address,
          },
          headers: {
            "Content-Type": "application/json",
          },
        })
        .then((response) => {
          if (response.data.message === "ok") {
            const location = response.data.data.results[0].geometry.location;
            const latitude = location.lat;
            const longitude = location.lng;
            this.coordinates = `${latitude},${longitude}`;
            this.hotelList();
          }
          if (response.data.message !== "ok") {
            toastr.warning(response.data.message);
            this.hotels = [];
            this.loadingHotels = false;
          }
          this.buttonDisabled = false;
        })
        .catch((error) => {
          this.loadingHotels = false;
          toastr.error(error.response.data.message, "Error");

          if (axios.isCancel(error)) {
            return;
          }
        });
    },
  },
};
</script>
