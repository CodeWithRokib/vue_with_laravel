<template>
    <div>
        <h1>Update Reservation</h1>
        <form @submit.prevent="updateReservation">
            <div>
                <label for="name">Name:</label>
                <input type="text" v-model="reservation.name" required />
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" v-model="reservation.email" required />
            </div>
            <div>
                <label for="phone">Phone:</label>
                <input type="text" v-model="reservation.phone" required />
            </div>
            <div>
                <label for="date">Date:</label>
                <input type="date" v-model="reservation.date" required />
            </div>
            <div>
                <label for="time">Time:</label>
                <input type="time" v-model="reservation.time" required />
            </div>
            <div>
                <label for="people">Number of People:</label>
                <input type="number" v-model="reservation.people" min="1" required />
            </div>
            <div>
                <label for="message">Message:</label>
                <textarea v-model="reservation.message"></textarea>
            </div>
            <button type="submit">Update</button>
            <button @click="cancelUpdate">Cancel</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';

export default {
    data() {
        return {
            reservation: {
                name: '',
                email: '',
                phone: '',
                date: '',
                time: '',
                people: 1,
                message: '',
                status: 'pending'
            }
        };
    },
    setup() {
        const route = useRoute();
        const router = useRouter();

        return { route, router };
    },
    mounted() {
        this.fetchReservation();
    },
    methods: {
        async fetchReservation() {
            try {
                const response = await axios.get(`http://localhost:8000/api/reservations/${this.route.params.id}`);
                this.reservation = response.data;
            } catch (error) {
                console.error('There was an error fetching the reservation!', error.response.data);
            }
        },
        async updateReservation() {
            try {
                const response = await axios.put(`http://localhost:8000/api/reservations/${this.route.params.id}`, this.reservation);
                alert(response.data.message);
                this.$router.push('/reservations');
            } catch (error) {
                console.error('There was an error updating the reservation!', error.response.data);
                alert('Error: ' + (error.response.data.message || 'Unknown error'));
            }
        },
        cancelUpdate() {
            this.$router.push('/reservations');
        }
    }
};
</script>
