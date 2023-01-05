import client from '$lib/graphql/client';
import readOnePage from '$lib/graphql/queries/readOnePage'

/** @type {import('./$types').PageLoad} */
export async function load({ params }) {
  return await client.request(readOnePage, {link: params.path});
}

// export let test = 'test var';