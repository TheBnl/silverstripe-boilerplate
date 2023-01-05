<script>
    export let id
    export let className
    export let title;
    export let content;
    console.log('load HomePage.svelte');
</script>

<h1>USERFORM! {title}</h1>
{@html content}