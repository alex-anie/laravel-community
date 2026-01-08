<script setup lang="ts">
    import Nav from './navbar/Nav.vue';
    import Footer from './Footer.vue';
</script>

<template>
    <Nav />
    <div>
        <slot></slot>
    </div>
    <Footer />
</template>