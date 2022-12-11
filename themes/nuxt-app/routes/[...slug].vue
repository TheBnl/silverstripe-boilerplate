<template>
    <div>
        <!-- <h1>{{ data?.readOnePage?.title }}</h1> -->
        <!-- <div v-html="data?.readOnePage?.content" /> -->

        <component :is="PageComponent" :page="data?.readOnePage" />
    </div>
</template>

<script setup>
    const route = useRoute()
    console.log('fetch page', route.params.slug.join('/'));

    const { data, error } = await useAsyncGql({
        operation: 'readOnePage',
        variables: {
            link: route.params.slug.join('/')
        }
    });

    if (!data.value.readOnePage) {
        // console.log('data', data);
        throw createError({ 
            statusCode: 404, 
            statusMessage: 'Page Not Found',
            fatal: true
        })
    }

    const className = data.value.readOnePage.className.replaceAll('\\', '');
    console.log('render', className);
    const PageComponent = resolveComponent(`${className}`);
</script>