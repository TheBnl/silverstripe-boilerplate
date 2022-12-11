<template>
    <div>
      <h1>{{ page.title }}</h1>
      <div v-html="page.content" />
    </div>
</template>

<script setup>
  const props = defineProps({
    page: {
      type: Object,
      readonly: true
    }
  });
</script>