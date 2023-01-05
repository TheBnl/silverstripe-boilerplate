<script>
    export let element;
    
    const ElementComponent = resolveComponentFromClassName(element.className);

    function resolveComponentFromClassName(className) {
        const components = import.meta.glob("../../lib/components/elements/**/*.svelte", {eager: true});
        const key = `./elements/${className.replaceAll('\\', '/')}.svelte`;
        if (components[key]) {
            return components[key].default;
        } else {
            return components['./elements/Element.svelte'].default;
        }
    }
</script>

<svelte:component this={ElementComponent} {...element} />