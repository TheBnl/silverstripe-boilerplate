// import adapter from '@sveltejs/adapter-auto';
// import adapter from '@sveltejs/adapter-vercel';
import adapter from '@sveltejs/adapter-static';
// import adapter from '@sveltejs/adapter-node';
import { vitePreprocess } from '@sveltejs/kit/vite';

/** @type {import('@sveltejs/kit').Config} */
const config = {
	// Consult https://kit.svelte.dev/docs/integrations#preprocessors
	// for more information about preprocessors
	preprocess: vitePreprocess(),

	kit: {
		paths: {
			base: '/_resources/themes/svelte-app/build'
		},
		adapter: adapter({
			fallback: 'index.html'
		}),
		prerender: {
			// crawl: false,
			handleHttpError: 'warn',
			entries: [
				// build, cache a list of urls to buid
				'/',
				'/home',
				'/home/sub-page',
				'/over-ons',
				'/contact',
			]
		}
	}
};

export default config;
