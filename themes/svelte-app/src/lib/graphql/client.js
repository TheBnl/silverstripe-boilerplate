import { GraphQLClient } from 'graphql-request'
import { PRIVATE_API_URL, PRIVATE_API_KEY } from '$env/static/private';
// const endpoint = process.env.API_URL;
import { browser } from '$app/environment'; 

const client = new GraphQLClient(PRIVATE_API_URL)

client.setHeaders({
  "Content-Type": "application/json",
  'Accept': "application/json",
  'X-API-Key': PRIVATE_API_KEY
})

if (!browser) {
    client.setHeader('X-Svelte', 'True');
}

// if (window.securityToken) {
//   client.setHeader('X-CSRF-TOKEN', window.securityToken)
// }

export default client;
