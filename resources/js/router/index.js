import {createRouter, createWebHistory} from "vue-router";

import hotelList from '../components/HotelListPage.vue';
import hotelDetails from '../components/HotelDetailsPage.vue';

const routes = [
    {
        path: '/',
        component: hotelList
    },
    {
        path: '/hotel-details/:id',
        component: hotelDetails,
        name: 'hotel-details'
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router