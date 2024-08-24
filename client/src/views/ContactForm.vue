<template>
    <form @submit.prevent="submitForm">
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
        <button type="submit">Submit</button>
    </form>
</template>

<script>
import axios from 'axios';

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
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('http://localhost:8000/api/contacts', this.contact);
                alert(response.data.message);
                this.resetForm();
            } catch (error) {
                console.error('There was an error submitting the form!', error);
            }
        },
        resetForm() {
            this.contact = {
                name: '',
                email: '',
                phone: '',
                description: ''
            };
        }
    }
};
</script>
