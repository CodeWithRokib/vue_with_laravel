<template>
    <div>
        <h1>Contact Us</h1>
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

        <hr />

        <h2>All Contacts</h2>
        <ul>
            <li v-for="contact in contacts" :key="contact.id">
                <strong>{{ contact.name }}</strong> - {{ contact.email }} - {{ contact.phone }}<br />
                <em>{{ contact.description }}</em>
                <button @click="editContact(contact.id)">Edit</button>
                <button @click="deleteContact(contact.id)">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';
import { useRouter } from 'vue-router';

export default {
    data() {
        return {
            contact: {
                name: '',
                email: '',
                phone: '',
                description: ''
            },
            contacts: [] // To store all the contacts
        };
    },
    setup() {
        const router = useRouter();
        return { router };
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('http://localhost:8000/api/contacts', this.contact);
                alert(response.data.message);
                this.resetForm();
                this.fetchContacts(); // Refresh the contacts list after submitting the form
            } catch (error) {
                console.error('There was an error submitting the form!', error.response.data);
                alert('Error: ' + (error.response.data.message || 'Unknown error'));
            }
        },
        async fetchContacts() {
            try {
                const response = await axios.get('http://localhost:8000/api/contacts');
                this.contacts = response.data;
            } catch (error) {
                console.error('There was an error fetching the contacts!', error);
            }
        },
        async deleteContact(id) {
            if (confirm('Are you sure you want to delete this contact?')) {
                try {
                    const response = await axios.delete(`http://localhost:8000/api/contacts/${id}`);
                    alert(response.data.message);
                    this.fetchContacts(); // Refresh the list after deletion
                } catch (error) {
                    console.error('There was an error deleting the contact!', error.response.data);
                    alert('Error: ' + (error.response.data.message || 'Unknown error'));
                }
            }
        },
        editContact(id) {
            this.$router.push(`/contacts/${id}/edit`);
        },
        resetForm() {
            this.contact = {
                name: '',
                email: '',
                phone: '',
                description: ''
            };
        }
    },
    mounted() {
        this.fetchContacts(); // Fetch the contacts when the component is mounted
    }
};
</script>
