<template>
    <nav>
        <ul>
            <li v-for="entry of data?.readPages" :key="entry.id">
                <NuxtLink :to="entry.link">{{ entry.menuTitle }}</NuxtLink>
            </li>
        </ul>
    </nav>
</template>

<script setup>
    const { data } = await useAsyncGql({
        operation: 'siteNav'
    });

    console.log('nav data', data);
</script>
  