<script>
	import { afterNavigate } from '$app/navigation';

    export let data;

    let PageComponent = resolveComponentFromClassName(data.className);
    afterNavigate(() => {
        PageComponent = resolveComponentFromClassName(data.className);
    });

    function resolveComponentFromClassName(className) {
        const components = import.meta.glob("../../lib/components/pages/**/*.svelte", {eager: true});
        const key = `./pages/${className.replaceAll('\\', '/')}.svelte`;

        if (components[key]) {
            return components[key].default;
        } else {
            return components['./pages/Page.svelte'].default;
        }
    }
</script>

<svelte:component this={PageComponent} {...data} />