<script>
    import Nav from '$lib/components/Nav.svelte';	
    /** @type {import('./$types').LayoutData} */
    export let data;
</script>

<Nav pages={data?.readPages} />

<slot />