<script>
  /** @type {import('./$types').PageData} */
  export let data;

  console.log('data!', data);
</script>

<h1>{data?.readOnePage?.title}</h1>
{@html data?.readOnePage?.content}
