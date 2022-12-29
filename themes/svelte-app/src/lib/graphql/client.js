import { GraphQLClient } from 'graphql-request'
import { PUBLIC_API_URL } from '$env/static/public';
// const endpoint = process.env.API_URL;
import { browser } from '$app/environment'; 

const client = new GraphQLClient(PUBLIC_API_URL)

client.setHeaders({
  "Content-Type": "application/json",
  'Accept': "application/json",
})

if (!browser) {
    client.setHeader('X-Svelte', 'True');
}

// if (window.securityToken) {
//   client.setHeader('X-CSRF-TOKEN', window.securityToken)
// }

export default client;
