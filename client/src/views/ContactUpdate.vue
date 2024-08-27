<template>
    <div>
        <h1>Update Contact</h1>
        <form @submit.prevent="updateContact">
            <div>
                <label for="name">Name:</label>
                <input type="text" v-model="contact.name" required />
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" v-model="contact.email" required />
            </div>
            <div>
                <label for="phone">Phone:</label>
                <input type="text" v-model="contact.phone" required />
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea v-model="contact.description" required></textarea>
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
            contact: {
                name: '',
                email: '',
                phone: '',
                description: ''
            }
        };
    },
    setup() {
        const route = useRoute();
        const router = useRouter();

        return { route, router };
    },
    mounted() {
        this.fetchContact();
    },
    methods: {
        async fetchContact() {
            try {
                const response = await axios.get(`http://localhost:8000/api/contacts/${this.route.params.id}`);
                this.contact = response.data;
            } catch (error) {
                console.error('There was an error fetching the contact!', error.response.data);
            }
        },
        async updateContact() {
            try {
                const response = await axios.put(`http://localhost:8000/api/contacts/${this.route.params.id}`, this.contact);
                alert(response.data.message);
                this.$router.push('/contacts');
            } catch (error) {
                console.error('There was an error updating the contact!', error.response.data);
                alert('Error: ' + (error.response.data.message || 'Unknown error'));
            }
        },
        cancelUpdate() {
            this.$router.push('/contacts');
        }
    }
};
</script>
