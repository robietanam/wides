import{m as r,A as i}from"./aos-D4VQsHxb.js";import"./_commonjsHelpers-Cpj98o6Y.js";window.Alpine=r;r.start();i.init();document.addEventListener("DOMContentLoaded",()=>{const e=document.getElementById("carousel"),t=document.getElementById("next"),o=document.getElementById("prev"),l=document.querySelectorAll(".carousel-item");if(!e||!t||!o||!l.length)return;const n=s=>{e.scrollBy({left:s*e.clientWidth}),setTimeout(d,300)},d=()=>{o.disabled=e.scrollLeft===0,t.disabled=e.scrollLeft+e.clientWidth>=e.scrollWidth,o.classList.toggle("disabled",o.disabled),t.classList.toggle("disabled",t.disabled)};t.addEventListener("click",()=>n(1)),o.addEventListener("click",()=>n(-1));const c=new IntersectionObserver({root:e,rootMargin:"0px",threshold:.5});l.forEach(s=>c.observe(s)),d()});