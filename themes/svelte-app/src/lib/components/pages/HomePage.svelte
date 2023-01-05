<script>
    export let title;
    export let content;
    console.log('load HomePage.svelte');
</script>

<h1>HOME! {title}</h1>
{@html content}