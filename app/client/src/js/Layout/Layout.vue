<template>
    <main>
        <Header/>
        <article class="container mx-auto">
            <slot />
        </article>
    </main>
</template>

<script>
  import Header from '../Components/Header'

  export default {
    components: {
      Header
    },
    props: {},
    computed: {
      routes: () => window.routes
    }
  }
</script>
