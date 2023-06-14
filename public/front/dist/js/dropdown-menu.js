class DropdownMenu extends HTMLElement {
  constructor() {
    super();
    this.openCloseState = "close";
    this.attachShadow({ mode: "open" });
    this.shadowRoot.innerHTML = `
    <style>
    ::-webkit-scrollbar {
      background-color: #1f2125;
      width: 10px;
      -webkit-transition: 0.4s;
      transition: 0.4s;
    }
    ::-webkit-scrollbar-button {
      background-color: #343a40;
    }
    
    ::-webkit-scrollbar-thumb {
      background-color: #343a40;
    }
    .section {
        position: relative;
        width: 300px;
        padding: 15px;
        border: 1px solid #777;
        border-radius: 5px;
        -webkit-transition: 0.4s;
        transition: 0.4s;
        cursor: pointer;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: justify;
            -ms-flex-pack: justify;
                justify-content: space-between;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
    }
    .section:hover {
      border-color: #2ca4ab;
    }
    .section #name {
        font-weight: bold;
        font-size: 20px;
        color: #e7e9ea;
    }
    .section .icon svg {
        transition: 0.4s;
        width: 25px;
        -webkit-filter: invert(96%) sepia(6%) saturate(52%) hue-rotate(155deg) brightness(99%) contrast(90%);
                filter: invert(96%) sepia(6%) saturate(52%) hue-rotate(155deg) brightness(99%) contrast(90%);
    }
    .section .dropdown {
        position: absolute;
        width: 95%;
        height: 0px;
        opacity: 0;
        border: 1px solid #2ca4ab;
        left: 50%;
        -webkit-transform: translateX(-50%);
                transform: translateX(-50%);
        top: 100%;
        border-radius: 5px;
        -webkit-transition: 0.4s;
        transition: 0.4s;
        z-index: 5;
        background-color: rgba(0, 0, 0, 0.9);
        overflow-y: scroll;
        overflow-x: hidden;
    }
    .section .dropdown ul {
        border: 1px solid;
        width: 100%;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    </style>

    <div class="section">
        <div id="name"></div>
        <div class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 0a256 256 0 1 0 0 512A256 256 0 1 0 256 0zM135 241c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l87 87 87-87c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9L273 345c-9.4 9.4-24.6 9.4-33.9 0L135 241z"/></svg>
        </div>
        <div class="dropdown">
            <ul>
                <slot></slot>
            </ul>
        </div>
    </div>
    `;
  }

  connectedCallback() {
    let section = this.shadowRoot.querySelector(".section");
    let dropdown = this.shadowRoot.querySelector(".dropdown");
    let icon = section.querySelector(".icon svg");

    section.addEventListener("click", () => {
      let dropdowns = document.querySelectorAll("dropdown-menu");
      let dropdownsArr = Array.from(dropdowns);
      if (this.openCloseState === "close") {
        dropdown.style.height = "200px";
        dropdown.style.opacity = "1";
        icon.style.transform = "rotate(180deg)";
        this.openCloseState = "open";
        for (let i = 0; i < dropdownsArr.length; i++) {
          if (
            dropdownsArr[i].shadowRoot
              .querySelector(".section")
              .hasAttribute("opened")
          ) {
            dropdownsArr[i].shadowRoot.querySelector(".dropdown").style.height =
              "0px";
            dropdownsArr[i].shadowRoot.querySelector(
              ".dropdown"
            ).style.opacity = "0";
            dropdownsArr[i].shadowRoot.querySelector(
              ".icon svg"
            ).style.transform = "rotate(360deg)";
            dropdownsArr[i].openCloseState = "close";
            dropdownsArr[i].shadowRoot
              .querySelector(".section")
              .removeAttribute("opened");
          }
        }
        section.setAttribute("opened", "");
      } else {
        dropdown.style.height = "0px";
        dropdown.style.opacity = "0";
        icon.style.transform = "rotate(360deg)";
        this.openCloseState = "close";
        section.removeAttribute("opened");
      }
    });
  }

  attributeChangedCallback(name, oldValue, newValue) {
    if (name === "data-name") {
      this._dropdownName = newValue;
      this.shadowRoot.getElementById("name").innerHTML = newValue;
    }
  }

  static get observedAttributes() {
    return ["data-name"];
  }
}

customElements.define("dropdown-menu", DropdownMenu);
