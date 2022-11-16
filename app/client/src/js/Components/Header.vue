<template>
    <header class="container mx-auto">
        <nav>
            <ul class="-mr-3 -ml-3">
                <li v-for="route in routes" :key="route.link" class="inline-block">
                    <Link
                        :href="route.link" 
                        class="block py-2 px-3 text-blue-500 hover:text-blue-600 transition-colors"
                    >
                        {{ route.title }}
                    </Link>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
  import { Link } from '@inertiajs/inertia-vue3'

  export default {
    components: {
        Link
    },
    props: {},
    computed: {
      routes: () => window.routes
    }
  }
</script>
