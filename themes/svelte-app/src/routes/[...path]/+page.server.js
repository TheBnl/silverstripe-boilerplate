import { error } from '@sveltejs/kit';
import client from '$lib/graphql/client';
import readOnePage from '$lib/graphql/queries/readOnePage'

export const prerender = 'auto'
// export const prerender = true

/** @type {import('../../../.svelte-kit/types/src/routes/[...path]/$types').PageLoad} */
export async function load({ params }) {
  const response = await client.request(readOnePage, {link: params.path});

  if (!response.readOnePage) {
    throw error(404, {
      message: 'Not found'
    });
  }

  // console.log('response', response.readOnePage);
  return response;
}

// export let test = 'test var';