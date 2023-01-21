import client from '$lib/graphql/client';
import siteNav from '$lib/graphql/queries/siteNav';

// export const ssr = false;
// export const prerender = false;

/** @type {import('../../.svelte-kit/types/src/routes/$types').LayoutLoad} */
export async function load({ params }) {
  return await client.request(siteNav);
}
