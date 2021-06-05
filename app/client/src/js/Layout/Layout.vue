<template>
    <main>
        <header>
            <inertia-link v-for="route in routes" :href="route.link" :key="route.link">{{ route.title }}</inertia-link>
        </header>
        <article>
            <slot />
        </article>
    </main>
</template>

<script>
  // import Layout from './Layout'

  export default {
    components: {},
    props: {},
    computed: {
      routes: () => window.routes
    }
  }
</script>
