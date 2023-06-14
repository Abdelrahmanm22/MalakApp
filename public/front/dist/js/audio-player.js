import lottieWeb from "https://cdn.skypack.dev/lottie-web";

class AudioPlayer extends HTMLElement {
  constructor() {
    super();
    this.playState = "play";
    this.attachShadow({ mode: "open" });
    this.shadowRoot.innerHTML = `
    <style>
        .voice {
            width: 320px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
                -ms-flex-direction: column;
                    flex-direction: column;
            border: 1px solid #343a40;
            border-radius: 5px;
            padding: 25px 20px;
            -webkit-transition: 0.4s;
            transition: 0.4s;
            cursor: pointer;
            position: relative;
          }
          .voice .upper-voice {
          position: relative;
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
        .voice .upper-voice .name {
            font-weight: bold;
            font-size: 20px;
            color: #e7e9ea;
            position: relative;
            width: 80%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 15px;
          }
          .voice .upper-voice .name svg {
            filter: invert(53%) sepia(64%) saturate(453%) hue-rotate(135deg) brightness(91%) contrast(91%);
          }
        .voice .upper-voice .time {
            font-size: 14px;
            color: #777;
            -webkit-transition: 0.4s;
            transition: 0.4s;
        }
        .voice .upper-voice .play-pause {
            width: 40px;
            height: 40px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
                -ms-flex-align: center;
                    align-items: center;
            -webkit-box-pack: center;
                -ms-flex-pack: center;
                    justify-content: center;
            filter: invert(53%) sepia(64%) saturate(453%) hue-rotate(135deg) brightness(91%) contrast(91%);
        }
        .voice .lower-voice {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                    justify-content: space-between;
            -webkit-box-align: center;
                -ms-flex-align: center;
                    align-items: center;
            margin: 20px 0;
        }
        .voice .lower-voice .time {
            font-size: 14px;
            color: #777;
            -webkit-transition: 0.4s;
            transition: 0.4s;
        }
        .voice .lower-voice input[type=range] {
            position: relative;
            -webkit-appearance: none;
            -moz-appearance: none;
                    appearance: none;
            width: 80%;
            height: 10px;
            border-radius: 10px;
            padding: 0 3px;
            background-color: #343a40;
        }
        .voice .lower-voice input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 3px;
            cursor: pointer;
            background: -webkit-gradient(linear, left top, right top, color-stop(var(--buffered-width), rgba(0, 125, 181, 0.6)), color-stop(var(--buffered-width), rgba(0, 125, 181, 0.2)));
            background: linear-gradient(to right, rgba(0, 125, 181, 0.6) var(--buffered-width), rgba(0, 125, 181, 0.2) var(--buffered-width));
            border-radius: 10px;
        }
        .voice .lower-voice input[type=range]::before {
            position: absolute;
            content: "";
            top: 50%;
            -webkit-transform: translateY(-50%);
                    transform: translateY(-50%);
            left: 3px;
            width: var(--seek-before-width);
            height: 3px;
            background-color: #2ca4ab;
            cursor: pointer;
            border-radius: 10px;
        }
        .voice .lower-voice input[type=range]::-webkit-slider-thumb {
            position: relative;
            -webkit-appearance: none;
                    appearance: none;
            height: 15px;
            width: 15px;
            border-radius: 50%;
            background-color: #2ca4ab;
            cursor: pointer;
            margin: -6px 0 0 0;
        }
        .voice .lower-voice input[type=range]:active::-webkit-slider-thumb {
            -webkit-transform: scale(1.2);
                    transform: scale(1.2);
            background: #007db5;
        }
        .voice .lower-voice input[type=range]::-moz-range-track {
            width: 100%;
            height: 2px;
            cursor: pointer;
            background: linear-gradient(to right, rgba(0, 125, 181, 0.6) var(--buffered-width), rgba(0, 125, 181, 0.2) var(--buffered-width));
        }
        .voice .lower-voice input[type=range]::-moz-range-progress {
            background-color: #007db5;
            height: 2px;
            border-radius: 10px;
        }
        .voice .lower-voice input[type=range]::-moz-focus-outer {
            border: 0;
        }
        .voice .lower-voice input[type=range]::-moz-range-thumb {
            height: 15px;
            width: 15px;
            border-radius: 50%;
            background-color: #2ca4ab;
            cursor: pointer;
        }
        .voice .lower-voice input[type=range]:active::-moz-range-thumb {
            transform: scale(1.2);
            background: #007db5;
        }
        .voice:hover {
            border-color: #2ca4ab;
        }
        .voice:hover .time {
            color: #2ca4ab;
        }
        @media (max-width: 769px) {
            .voice {
              padding: 20px 15px;
              cursor: default;
            }
            .voice .name {
              font-size: 18px;
            }
        }
    </style>

    <div class="voice">
        <div class="upper-voice">
        <audio preload="metadata" loop></audio>
            <p class="name"><a download><svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 0a256 256 0 1 0 0 512A256 256 0 1 0 256 0zM376.9 294.6L269.8 394.5c-3.8 3.5-8.7 5.5-13.8 5.5s-10.1-2-13.8-5.5L135.1 294.6c-4.5-4.2-7.1-10.1-7.1-16.3c0-12.3 10-22.3 22.3-22.3l57.7 0 0-96c0-17.7 14.3-32 32-32l32 0c17.7 0 32 14.3 32 32l0 96 57.7 0c12.3 0 22.3 10 22.3 22.3c0 6.2-2.6 12.1-7.1 16.3z"/></svg></a><slot></slot></p>
            <div class="play-pause">
              <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c7.6-4.2 16.8-4.1 24.3 .5l144 88c7.1 4.4 11.5 12.1 11.5 20.5s-4.4 16.1-11.5 20.5l-144 88c-7.4 4.5-16.7 4.7-24.3 .5s-12.3-12.2-12.3-20.9V168c0-8.7 4.7-16.7 12.3-20.9z"/></svg>
            </div>
        </div>
        <div class="lower-voice">
            <div id="duration" class="time">0:00</div>
            <input type="range" dir="ltr" id="seek-slider" max="100" value="0" />
            <div id="current-time" class="time">0:00</div>
        </div>
  </div>
    `;
  }

  connectedCallback() {
    let playPause = this.shadowRoot.querySelector(".play-pause");
    let audioPlayerContainer = this.shadowRoot.querySelector(".lower-voice");
    let seekSlider = this.shadowRoot.getElementById("seek-slider");
    let audio = this.shadowRoot.querySelector("audio");
    let durationContainer = this.shadowRoot.getElementById("duration");
    let currentTimeContainer = this.shadowRoot.getElementById("current-time");
    let raf = null;

    playPause.addEventListener("click", () => {
      let audios = document.querySelectorAll("audio-player");
      let audiosArr = Array.from(audios);
      if (this.playState === "play") {
        audio.play();
        playPause.innerHTML =
          '<svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm224-72V328c0 13.3-10.7 24-24 24s-24-10.7-24-24V184c0-13.3 10.7-24 24-24s24 10.7 24 24zm112 0V328c0 13.3-10.7 24-24 24s-24-10.7-24-24V184c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg>';
        requestAnimationFrame(whilePlaying);
        for (let i = 0; i < audiosArr.length; i++) {
          if (
            audiosArr[i].shadowRoot
              .querySelector("audio")
              .hasAttribute("playing")
          ) {
            audiosArr[i].shadowRoot.querySelector("audio").pause();
            audiosArr[i].shadowRoot.querySelector(".play-pause").innerHTML =
              '<svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c7.6-4.2 16.8-4.1 24.3 .5l144 88c7.1 4.4 11.5 12.1 11.5 20.5s-4.4 16.1-11.5 20.5l-144 88c-7.4 4.5-16.7 4.7-24.3 .5s-12.3-12.2-12.3-20.9V168c0-8.7 4.7-16.7 12.3-20.9z"/></svg>';
            audiosArr[i].shadowRoot
              .querySelector("audio")
              .removeAttribute("playing");
            audiosArr[i].playState = "play";
          } else {
            this.playState = "pause";
          }
        }
        audio.setAttribute("playing", "");
      } else {
        audio.pause();
        playPause.innerHTML =
          '<svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c7.6-4.2 16.8-4.1 24.3 .5l144 88c7.1 4.4 11.5 12.1 11.5 20.5s-4.4 16.1-11.5 20.5l-144 88c-7.4 4.5-16.7 4.7-24.3 .5s-12.3-12.2-12.3-20.9V168c0-8.7 4.7-16.7 12.3-20.9z"/></svg>';
        cancelAnimationFrame(raf);
        audio.removeAttribute("playing");
        this.playState = "play";
      }
    });

    let showRangeProgress = (rangeInput) => {
      if (rangeInput === seekSlider) {
        audioPlayerContainer.style.setProperty(
          "--seek-before-width",
          (rangeInput.value / rangeInput.max) * 100 + "%"
        );
      }
    };

    seekSlider.addEventListener("input", (e) => {
      console.log(e.target.value);
      showRangeProgress(e.target);
    });

    const calculateTime = (secs) => {
      const minutes = Math.floor(secs / 60);
      const seconds = Math.floor(secs % 60);
      const returnedSeconds = seconds < 10 ? `0${seconds}` : `${seconds}`;
      return `${minutes}:${returnedSeconds}`;
    };

    const displayDuration = () => {
      durationContainer.textContent = calculateTime(audio.duration);
    };

    const setSliderMax = () => {
      seekSlider.max = Math.floor(audio.duration);
    };

    const displayBufferedAmount = () => {
      if (audio.readyState > 0) {
        let bufferedAmount = Math.floor(
          audio.buffered.end(audio.buffered.length - 1)
        );
        audioPlayerContainer.style.setProperty(
          "--buffered-width",
          `${(bufferedAmount / seekSlider.max) * 100}%`
        );
      }
    };

    const whilePlaying = () => {
      seekSlider.value = Math.floor(audio.currentTime);
      currentTimeContainer.textContent = calculateTime(seekSlider.value);
      audioPlayerContainer.style.setProperty(
        "--seek-before-width",
        `${(seekSlider.value / seekSlider.max) * 100}%`
      );
      raf = requestAnimationFrame(whilePlaying);
    };

    if (audio.readyState > 0) {
      displayDuration();
      setSliderMax();
      displayBufferedAmount();
    } else {
      audio.addEventListener("loadedmetadata", () => {
        displayDuration();
        setSliderMax();
        displayBufferedAmount();
      });
    }
    audio.addEventListener("progress", displayBufferedAmount);
    seekSlider.addEventListener("input", () => {
      currentTimeContainer.textContent = calculateTime(seekSlider.value);
      if (!audio.paused) {
        cancelAnimationFrame(raf);
      }
    });
    seekSlider.addEventListener("change", () => {
      audio.currentTime = seekSlider.value;
      if (!audio.paused) {
        requestAnimationFrame(whilePlaying);
      }
    });
  }

  attributeChangedCallback(name, oldValue, newValue) {
    if (name === "src") {
      this._audioPlayerSRC = newValue;
      this.shadowRoot.querySelector("audio").setAttribute("src", newValue);
      this.shadowRoot.querySelector(".name a").setAttribute("href", newValue);
    }
  }

  static get observedAttributes() {
    return ["src"];
  }
}

customElements.define("audio-player", AudioPlayer);
