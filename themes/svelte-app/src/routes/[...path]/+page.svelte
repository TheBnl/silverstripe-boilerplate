<script>
  import Page from '$lib/components/Page.svelte';

  /** @type {import('./$types').PageData} */
  export let data;
</script>

<Page data={data?.readOnePage} />
