let links=document.querySelectorAll(".navbar ul li a"),linksArr=Array.from(links);linksArr.forEach((e=>{e.href===window.location.href&&e.classList.add("active")}));let year=document.getElementById("year"),currentDate=new Date,currentYear=currentDate.getFullYear();year.innerHTML=currentYear;
//# sourceMappingURL=app-dist.js.map