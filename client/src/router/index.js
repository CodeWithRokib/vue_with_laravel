import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import About from "../views/About.vue";
import HelloWorld from "../components/HelloWorld.vue";
import Register from "../views/Register.vue";
import Login from "../views/Login.vue";
import ContactForm from "../views/ContactForm.vue";
import Reservation from "../views/Reservation.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/about",
    name: "About",
    component: About,
  },
  {
    path: "/home",
    name: "HelloWorld",
    component: HelloWorld,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
  {
    path: "/register",
    name: "Register",
    component: Register,
  },
  {
    path: "/contactForm",
    name: "contactForm",
    component: ContactForm,
  },
  {
    path: "/reservation",
    name: "Reservation",
    component: Reservation,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
