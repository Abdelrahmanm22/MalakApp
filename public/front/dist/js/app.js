// Tabs Functionality
let tabs = document.querySelectorAll(".content ul li");
let tabsArr = Array.from(tabs);
let tabsContent = document.querySelectorAll(".content .tab-content > div");
let tabsContentArr = Array.from(tabsContent);

tabsArr.forEach((element) => {
  element.addEventListener("click", (event) => {
    tabsArr.forEach((ele) => {
      ele.classList.remove("active");
    });
    event.currentTarget.classList.add("active");
    tabsContentArr.forEach((tabs) => {
      tabs.style.display = "none";
      tabs.classList.remove("active");
    });
    document.querySelector(event.currentTarget.dataset.tab).style.display =
      "flex";
    document
      .querySelector(event.currentTarget.dataset.tab)
      .classList.add("active");
  });
});
