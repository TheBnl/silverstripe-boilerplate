<header class="fixed w-full top-0 z-50">
    <div class="container mx-auto">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-3 bg-pink-600">
                <a class="logo" href="$BaseHref">$SiteConfig.Title</a>
            </div>
            <div class="col-span-9 " >
                <ul class="flex space-x-2">
                    <% loop $Menu('1') %>
                        <li class="flex-grow p-2 hover:bg-black hover:text-white bg-purple-300 <% if $LinkOrSection == 'section' %> is-active site-nav__item--current<% end_if %>">
                            <a href="$Link" title="$Title.XML">$MenuTitle</a>
                        </li>
                    <% end_loop %>
                </ul>
            </div>
        </div>
    </div>
</header>
