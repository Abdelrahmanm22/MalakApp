class QAModal extends HTMLElement {
  constructor() {
    super();
    this.src = document.querySelector(".questions").getAttribute("src");
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
        .question {
            width: 100%;
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
        .question .shown-question {
            width: 100%;
            height: 100%;
            color: #e7e9ea;
            line-height: 1.4;
            padding: 15px;
            margin: 0;
        }
        .question .backdrop {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.44);
            cursor: default;
            pointer-events: none;
            opacity: 0;
            transition: 0.4s;
        }
        .question .backdrop.opened {
            pointer-events: unset;
            opacity: 1;
        }
        .question .modal {
            position: fixed;
            width: 80vw;
            height: 80vh;
            top: 80%;
            left: -20%;
            -webkit-transform: translate(-50%, -50%);
                    transform: translate(-50%, -50%);
            background-repeat: no-repeat;
            background-size: cover;
            cursor: default;
            padding: 40px;
            overflow-y: scroll;
            -webkit-transition: 0.4s;
            transition: 0.4s;
            opacity: 0;
            pointer-events: none;
        }
        .question .modal .close-button {
            width: 25px;
            height: 25px;
            background-color: rgba(47, 79, 79, 0.8);
            position: fixed;
            top: 5px;
            left: 5px;
            cursor: pointer;
        }
        .question .modal .close-button :first-child {
            width: 80%;
            height: 2px;
            background-color: #2ca4ab;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%) rotate(45deg);
                    transform: translate(-50%, -50%) rotate(45deg);
            -webkit-transition: 0.4s;
            transition: 0.4s;
        }
        .question .modal .close-button :last-child {
            width: 2px;
            height: 80%;
            background-color: #2ca4ab;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%) rotate(45deg);
                    transform: translate(-50%, -50%) rotate(45deg);
            -webkit-transition: 0.4s;
            transition: 0.4s;
        }
        .question .modal .close-button:hover :first-child {
            background-color: red;
        }
        .question .modal .close-button:hover :last-child {
            background-color: red;
        }
        .question .modal .modal-question {
            width: 100%;
            color: #e7e9ea;
            background-color: rgba(47, 79, 79, 0.4);
        }
        .question .modal .modal-question div {
            width: -webkit-fit-content;
            width: -moz-fit-content;
            width: fit-content;
            padding: 10px 20px;
            background-color: rgba(255, 0, 0, 0.5);
        }
        .question .modal .modal-question p {
            padding: 20px 25px;
            line-height: 1.6;
        }
        .question .modal .modal-answer {
            margin: 30px 0;
            width: 100%;
            background-color: rgba(47, 79, 79, 0.4);
            color: #e7e9ea;
        }
        .question .modal .modal-answer div {
            width: -webkit-fit-content;
            width: -moz-fit-content;
            width: fit-content;
            padding: 10px 20px;
            background-color: rgba(255, 0, 0, 0.5);
        }
        .question .modal .modal-answer p {
            padding: 20px 25px;
            line-height: 1.6;
        }
        .question .modal.opened {
            top: 50%;
            left: 50%;
            opacity: 1;
            pointer-events: unset;
        }
        .question:hover {
            border-color: #2ca4ab;
        }
        @media (max-width: 769px) {
            .question .modal {
                width: 80vw;
                padding: 40px 25px;
            }
        }
    </style>
    <div class="question">
        <p class="shown-question"></p>
        <div class="backdrop"></div>
        <div class="modal">
            <div class="close-button">
                <span></span>
                <span></span>
            </div>
            <div class="modal-question">
                <div>السؤال</div>
                <p><slot name="q"></slot></p>
            </div>
            <div class="modal-answer">
                <div>الأجابة</div>
                <p><slot name="a"></slot></p>
            </div>
        </div>
    </div>
    `;
  }

  connectedCallback() {
    let question = this.shadowRoot.querySelector(".question");
    let backdrop = this.shadowRoot.querySelector(".backdrop");
    let modal = this.shadowRoot.querySelector(".modal");

    modal.style.backgroundImage = `url(${this.src})`;

    question.querySelector(".shown-question").addEventListener("click", () => {
      backdrop.classList.add("opened");
      modal.classList.add("opened");
    });
    backdrop.addEventListener("click", () => {
      if (backdrop.classList.contains("opened")) {
        backdrop.classList.remove("opened");
        modal.classList.remove("opened");
      }
    });
    modal.querySelector(".close-button").addEventListener("click", () => {
      if (modal.classList.contains("opened")) {
        backdrop.classList.remove("opened");
        modal.classList.remove("opened");
      }
    });
  }

  attributeChangedCallback(name, oldValue, newValue) {
    if (name === "shown-question") {
      this._shownQuestion = newValue;
      this.shadowRoot.querySelector(".question .shown-question").innerHTML =
        newValue;
    }
  }

  static get observedAttributes() {
    return ["shown-question"];
  }
}

customElements.define("qa-modal", QAModal);
