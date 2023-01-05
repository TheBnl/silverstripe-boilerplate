import { sveltekit } from '@sveltejs/kit/vite';
import dynamicImportVars from '@rollup/plugin-dynamic-import-vars';

/** @type {import('vite').UserConfig} */
const config = {
	plugins: [
		sveltekit(),
		dynamicImportVars({
			include: [
				'./src/lib/components/pages/*/*.svelte',
				'./src/lib/components/pages/**/*.svelte',
			]
		})
	],
	test: {
		include: ['src/**/*.{test,spec}.{js,ts}']
	}
};

export default config;
