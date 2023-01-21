<script>
	import ElementalArea from "../ElementalArea.svelte";

    export let id
    export let className
    export let title;
    export let content;
    export let elementalArea;

    console.log('elementalArea', elementalArea);
    
    console.log('load Page.svelte');
</script>

<h1>Page {title}</h1>
{@html content}

<ElementalArea elements={elementalArea?.elements?.nodes} />