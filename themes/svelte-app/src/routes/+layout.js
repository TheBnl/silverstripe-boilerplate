import client from '$lib/graphql/client';
import siteNav from '$lib/graphql/queries/siteNav';

export const ssr = false;

/** @type {import('./$types').LayoutLoad} */
export async function load({ params }) {
  return await client.request(siteNav);
}