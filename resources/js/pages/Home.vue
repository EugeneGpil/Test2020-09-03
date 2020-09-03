<template>
    <div>
        <VueHeader />
        <router-view />
        <VueFooter />
    </div>
</template>

<script>

import VueHeader from '../components/global/VueHeader.vue';
import VueFooter from '../components/global/VueFooter.vue';

export default {
    name: 'home',
    components: {
        VueHeader,
        VueFooter
    },
}
</script>