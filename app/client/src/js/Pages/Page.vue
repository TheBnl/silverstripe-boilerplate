<template>
    <div>
        <Head>
          <title>{{ title }}</title>
          <meta name="description" :content="metaDescription">
        </Head>
        <h1>{{ title }}</h1>
        <div v-html="content"></div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'

  export default {
    components: { Head },
    props: {
      title: String,
      content: String,
      metaDescription: String,
      elementalArea: Array
    },
  }
</script>
