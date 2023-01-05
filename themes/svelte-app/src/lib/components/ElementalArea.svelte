<script>
	import ElementComponent from "./ElementComponent.svelte";

    export let elements = [];

    // elementManifest -> cache to check if element exists
</script>

{#each elements as element}
    <section>
        <ElementComponent element={element} />
    </section>
{/each}