import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import About from '../views/About.vue';
import HelloWorld from '../components/HelloWorld.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/about',
    name: 'About',
    component: About
  },
  {
    path: '/home',
    name: 'HelloWorld',
    component: HelloWorld
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
