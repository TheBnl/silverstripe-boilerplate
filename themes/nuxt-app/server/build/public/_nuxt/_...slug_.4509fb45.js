import{e as u,w as p,f as m,o as n,a as g,c as i,u as l,r as _,h as d}from"./entry.cfeb4357.js";import{u as f}from"./index.0742d47f.js";const y={__name:"[...slug]",async setup(v){let e,s;const o=u();console.log("fetch page",o.params.slug.join("/"));const{data:a,error:P}=([e,s]=p(()=>f({operation:"readOnePage",variables:{link:o.params.slug.join("/")}})),e=await e,s(),e);if(!a.value.readOnePage)throw m({statusCode:404,statusMessage:"Page Not Found",fatal:!0});const t=a.value.readOnePage.className.replaceAll("\\","");console.log("render",t);const c=d(`${t}`);return(h,C)=>{var r;return n(),g("div",null,[(n(),i(_(l(c)),{page:(r=l(a))==null?void 0:r.readOnePage},null,8,["page"]))])}}};export{y as default};