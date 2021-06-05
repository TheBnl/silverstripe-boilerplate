<template>
    <div>
        <inertia-head :title="title" />
        <H1>{{ title }}</H1>
        <div v-html="content"></div>
    </div>
</template>

<script>

  export default {
    components: {},
    props: {
      title: String,
      content: String,
    },
  }
</script>
