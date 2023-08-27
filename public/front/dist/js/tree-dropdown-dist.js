class DropdownTree extends HTMLElement{constructor(){super(),this.openCloseState="close",this.attachShadow({mode:"open"}),this.shadowRoot.innerHTML='\n      <style>\n        ul {\n            list-style: none;\n            margin: 0;\n            padding: 0;\n        }\n        li {\n            position: relative;\n            -webkit-transition: 0.4s;\n            transition: 0.4s;\n        }\n        details {\n            font-size: 1.2rem;\n            -webkit-transition: 0.4s;\n            transition: 0.4s;\n        }\n        details summary {\n            -webkit-transition: 0.4s;\n            transition: 0.4s;\n            font-size: 1.5rem;\n            list-style: none;\n            cursor: pointer;\n        }\n        li::before {\n            content: "";\n            position: absolute;\n            right: -20px;\n            top: 0;\n            border-right: 2px dashed gray;\n            border-bottom: 2px dashed gray;\n            width: 10px;\n            height: 1em;\n        }\n        li::after {\n            content: "";\n            position: absolute;\n            right: -20px;\n            bottom: 0;\n            border-right: 2px dashed gray;\n            width: 10px;\n            height: 100%;\n        }\n      </style>\n\n      <details>\n        <summary id="name"></summary>\n        <ul>\n            <slot></slot>\n        </ul>\n      </details>\n      '}connectedCallback(){class n{constructor(n){this.el=n,this.summary=n.querySelector("summary"),this.content=n.querySelector("details ul"),this.animation=null,this.isClosing=!1,this.isExpanding=!1,this.summary.addEventListener("click",(n=>this.onClick(n)))}onClick(n){n.preventDefault(),this.el.style.overflow="hidden",this.isClosing||!this.el.open?this.open():(this.isExpanding||this.el.open)&&this.shrink()}shrink(){this.isClosing=!0;const n=`${this.el.offsetHeight}px`,t=`${this.summary.offsetHeight}px`;this.animation&&this.animation.cancel(),this.animation=this.el.animate({height:[n,t]},{duration:500,easing:"ease-out"}),this.animation.onfinish=()=>this.onAnimationFinish(!1),this.animation.oncancel=()=>this.isClosing=!1}open(){this.el.style.height=`${this.el.offsetHeight}px`,this.el.open=!0,window.requestAnimationFrame((()=>this.expand()))}expand(){this.isExpanding=!0;const n=`${this.el.offsetHeight}px`,t=`${this.summary.offsetHeight+this.content.offsetHeight}px`;this.animation&&this.animation.cancel(),this.animation=this.el.animate({height:[n,t]},{duration:500,easing:"ease-out"}),this.animation.onfinish=()=>this.onAnimationFinish(!0),this.animation.oncancel=()=>this.isExpanding=!1}onAnimationFinish(n){this.el.open=n,this.animation=null,this.isClosing=!1,this.isExpanding=!1,this.el.style.height=this.el.style.overflow=""}}this.shadowRoot.querySelectorAll("details").forEach((t=>{new n(t)}))}attributeChangedCallback(n,t,i){"name"===n&&(this._dropdownName=i,this.shadowRoot.getElementById("name").innerHTML=i)}static get observedAttributes(){return["name"]}}customElements.define("dropdown-tree",DropdownTree);
//# sourceMappingURL=tree-dropdown-dist.js.map