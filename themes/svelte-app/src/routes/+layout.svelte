<script>
    import Nav from '$lib/components/Nav.svelte';	
    /** @type {import('./$types').LayoutData} */
    export let data;

    console.log('layout data', data?.readPages);
</script>

<Nav pages={data?.readPages} />

<slot />