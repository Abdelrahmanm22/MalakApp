let links=document.querySelectorAll(".navbar ul li a"),linksArr=Array.from(links);linksArr.forEach((t=>{t.href===window.location.href&&t.classList.add("active"),window.location.href.toLowerCase().includes(t.name)&&"video"===t.name&&t.classList.add("active"),window.location.href.toLowerCase().includes(t.name)&&"voice"===t.name&&t.classList.add("active")}));let year=document.getElementById("year"),currentDate=new Date,currentYear=currentDate.getFullYear();year.innerHTML=currentYear;let dropdown=document.querySelectorAll("dropdown-menu");dropdown.forEach(((t,e)=>{t.addEventListener("click",(()=>{let e=t.querySelectorAll("li a"),n=Array.from(e),o=t.shadowRoot.querySelector(".section");if(""===o.getAttribute("opened")&&n.length>=10){t.shadowRoot.querySelector(".dropdown").style.height="300px"}else if(""===o.getAttribute("opened")){t.shadowRoot.querySelector(".dropdown").style.height="200px"}else t.style.marginBottom="unset"}))}));let menuButton=document.getElementById("icon"),menuButtonIconTop=document.getElementById("top"),menuButtonIconCenter=document.getElementById("center"),menuButtonIconBottom=document.getElementById("bottom"),menu=document.querySelector(".navbar ul");menuButton.addEventListener("click",(()=>{"false"===menuButton.getAttribute("opened")?(menuButton.style.transform="rotate(45deg)",menuButtonIconCenter.style.display="none",menuButtonIconTop.style.position="absolute",menuButtonIconTop.style.width="100%",menuButtonIconTop.style.height="5px",menuButtonIconTop.style.top="50%",menuButtonIconTop.style.transform="translateY(-50%)",menuButtonIconBottom.style.position="absolute",menuButtonIconBottom.style.width="5px",menuButtonIconBottom.style.height="30px",menuButtonIconBottom.style.top="50%",menuButtonIconBottom.style.transform="translateY(-50%)",menu.style.visibility="visible",menu.style.height="300px",menu.style.opacity="1",menuButton.setAttribute("opened","true")):"true"===menuButton.getAttribute("opened")&&(menuButton.style.transform="unset",menuButtonIconCenter.style.display="unset",menuButtonIconTop.style.position="unset",menuButtonIconTop.style.width="100%",menuButtonIconTop.style.height="3px",menuButtonIconTop.style.top="unset",menuButtonIconTop.style.transform="unset",menuButtonIconBottom.style.position="unset",menuButtonIconBottom.style.width="100%",menuButtonIconBottom.style.height="3px",menuButtonIconBottom.style.top="unset",menuButtonIconBottom.style.transform="unset",menu.style.visibility="hidden",menu.style.height="0",menu.style.opacity="0",menuButton.setAttribute("opened","false"))}));let mobileNav=document.querySelector(".navbar ul");window.innerWidth>=570&&(mobileNav.style.backgroundImage="unset");
//# sourceMappingURL=app-dist.js.map