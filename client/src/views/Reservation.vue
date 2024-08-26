<template>
    <div>
        <h1>Make a Reservation</h1>
        <form @submit.prevent="submitForm">
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
            <button type="submit">Submit</button>
        </form>

        <hr />

        <h2>All Reservations</h2>
        <ul>
            <li v-for="reservation in reservations" :key="reservation.id">
                <strong>{{ reservation.name }}</strong> - {{ reservation.email }} - {{ reservation.phone }}<br />
                {{ reservation.date }} at {{ reservation.time }} - {{ reservation.people }} people<br />
                <em>{{ reservation.message }}</em> - Status: {{ reservation.status }}
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

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
            },
            reservations: [] // To store all the reservations
        };
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('http://localhost:8000/api/reservations', this.reservation);
                alert(response.data.message);
                this.resetForm();
                this.fetchReservations(); // Refresh the reservations list after submitting the form
            } catch (error) {
                console.error('There was an error submitting the form!', error.response.data);
                alert('Error: ' + (error.response.data.message || 'Unknown error'));
            }
        },
        async fetchReservations() {
            try {
                const response = await axios.get('http://localhost:8000/api/reservations');
                this.reservations = response.data;
            } catch (error) {
                console.error('There was an error fetching the reservations!', error);
            }
        },
        resetForm() {
            this.reservation = {
                name: '',
                email: '',
                phone: '',
                date: '',
                time: '',
                people: 1,
                message: '',
                status: 'pending'
            };
        }
    },
    mounted() {
        this.fetchReservations(); // Fetch the reservations when the component is mounted
    }
};
</script>
