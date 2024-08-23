<template>
    <div class="register">
      <h2>Register</h2>
      <form @submit.prevent="register">
        <div>
          <label for="name">Name</label>
          <input v-model="name" type="text" id="name" placeholder="Name" required />
        </div>
        <div>
          <label for="email">Email</label>
          <input v-model="email" type="email" id="email" placeholder="Email" required />
        </div>
        <div>
          <label for="password">Password</label>
          <input v-model="password" type="password" id="password" placeholder="Password" required />
        </div>
        <div>
          <label for="password_confirmation">Confirm Password</label>
          <input v-model="password_confirmation" type="password" id="password_confirmation" placeholder="Confirm Password" required />
        </div>
        <button type="submit">Register</button>
      </form>
      <p v-if="error" class="error">{{ error }}</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        error: '',
      };
    },
    methods: {
      async register() {
        try {
          this.error = ''; // Clear any existing error messages
          const response = await axios.post('http://localhost:8000/api/register', {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation,
          });
  
          localStorage.setItem('token', response.data.access_token);
          this.$router.push('/dashboard'); // Redirect to dashboard after successful registration
        } catch (error) {
          if (error.response && error.response.data) {
            this.error = error.response.data.message;
          } else {
            this.error = 'An error occurred during registration. Please try again.';
          }
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .register {
    max-width: 400px;
    margin: 0 auto;
  }
  
  .error {
    color: red;
    margin-top: 10px;
  }
  </style>
  