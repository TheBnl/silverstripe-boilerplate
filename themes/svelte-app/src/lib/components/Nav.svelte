<script>
    export let pages;
    console.log('load nav data here?', pages);
</script>

<nav>
    <ul>
        {#each pages as pages}
            <li>
                <a href={pages.link}>
                    {pages.menuTitle}
                </a>
            </li>
        {/each}
    </ul>
</nav>