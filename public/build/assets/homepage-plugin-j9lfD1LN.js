import{E as R}from"./embla-carousel.esm-v-CXq_RL.js";const W={active:!0,breakpoints:{},delay:4e3,jump:!1,playOnInit:!0,stopOnFocusIn:!0,stopOnInteraction:!0,stopOnMouseEnter:!1,stopOnLastSnap:!1,rootNode:null};function w(e={}){let n,t,i,o=!1,a=!0,c=!1,u=0;function f(s,E){t=s;const{mergeOptions:g,optionsAtMedia:N}=E,x=g(W,w.globalOptions),P=g(x,e);if(n=N(P),t.scrollSnapList().length<=1)return;c=n.jump,i=!1;const{eventStore:O,ownerDocument:D}=t.internalEngine(),h=t.rootNode(),v=n.rootNode&&n.rootNode(h)||h,C=t.containerNode();t.on("pointerDown",l),n.stopOnInteraction||t.on("pointerUp",r),n.stopOnMouseEnter&&(O.add(v,"mouseenter",()=>{a=!1,l()}),n.stopOnInteraction||O.add(v,"mouseleave",()=>{a=!0,r()})),n.stopOnFocusIn&&(t.on("slideFocusStart",l),n.stopOnInteraction||O.add(C,"focusout",r)),O.add(D,"visibilitychange",I),n.playOnInit&&!d()&&r()}function S(){t.off("pointerDown",l).off("pointerUp",r).off("slideFocusStart",l),l(),i=!0,o=!1}function r(){if(i||!a)return;o||t.emit("autoplay:play");const{ownerWindow:s}=t.internalEngine();s.clearInterval(u),u=s.setInterval(M,n.delay),o=!0}function l(){if(i)return;o&&t.emit("autoplay:stop");const{ownerWindow:s}=t.internalEngine();s.clearInterval(u),u=0,o=!1}function I(){if(d())return a=o,l();a&&r()}function d(){const{ownerDocument:s}=t.internalEngine();return s.visibilityState==="hidden"}function p(s){typeof s<"u"&&(c=s),a=!0,r()}function y(){o&&l()}function L(){o&&p()}function F(){return o}function M(){const{index:s}=t.internalEngine(),E=s.clone().add(1).get(),g=t.scrollSnapList().length-1;n.stopOnLastSnap&&E===g&&l(),t.canScrollNext()?t.scrollNext(c):t.scrollTo(0,c)}return{name:"autoplay",options:e,init:f,destroy:S,play:p,stop:y,reset:L,isPlaying:F}}w.globalOptions=void 0;const _=.7;let b=0;const k=(e,n,t)=>Math.min(Math.max(e,n),t),T=e=>{b=_*e.scrollSnapList().length},m=(e,n)=>{const t=e.internalEngine(),i=e.scrollProgress(),o=e.slidesInView(),a=n==="scroll";e.scrollSnapList().forEach((c,u)=>{let f=c-i;t.slideRegistry[u].forEach(r=>{if(a&&!o.includes(r))return;t.options.loop&&t.slideLooper.loopPoints.forEach(d=>{const p=d.target();if(r===d.index&&p!==0){const y=Math.sign(p);y===-1&&(f=c-(1+i)),y===1&&(f=c+(1-i))}});const l=1-Math.abs(f*b),I=k(l,0,1).toString();e.slideNodes()[r].style.opacity=I})})},V=e=>{const n=e.slideNodes();return T(e),m(e),e.on("reInit",T).on("reInit",m).on("scroll",m).on("slideFocus",m),()=>{n.forEach(t=>t.removeAttribute("style"))}};document.addEventListener("DOMContentLoaded",()=>{const n=document.querySelector(".embla").querySelector(".embla__viewport"),i=R(n,{loop:!0},[w({playOnInit:!0,delay:2e3,stopOnInteraction:!1})]),o=V(i);i.on("destroy",o)});