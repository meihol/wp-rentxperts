// document.addEventListener("DOMContentLoaded", function () {
//     const container = document.getElementById("rentviewmorewrapper");
//     const logoItems = container.querySelectorAll(".rent-logo-wrapper");
//     const showPerClick = 8;
//     let visibleCount = 0;

//     function showNextBatch() {
//       const nextCount = visibleCount + showPerClick;
//       logoItems.forEach((item, index) => {
//         if (index < nextCount) {
//           item.classList.add("visible");
//         }
//       });
//       visibleCount = nextCount;

//       if (visibleCount >= logoItems.length && viewMoreBtn) {
//         viewMoreBtn.style.display = "none";
//       }
//     }

//     // Show first 8 on load
//     showNextBatch();

//     // Create and insert button if needed
//     if (logoItems.length > showPerClick) {
//       const viewMoreBtn = document.createElement("button");
//       viewMoreBtn.id = "viewMoreBtn";
//       viewMoreBtn.innerText = "View More";
//       container.appendChild(viewMoreBtn);

//       viewMoreBtn.addEventListener("click", showNextBatch);
//     }
// });

// document.addEventListener("DOMContentLoaded", () => {
//     const swiperEl = document.querySelector(".rentbrandswiper");

//     if (swiperEl) {
//         const motionParent = swiperEl.querySelector(".elementor-motion-effects-parent");

//         if (motionParent) {
//             motionParent.classList.add("swiper-wrapper");
//         }

//         new Swiper(swiperEl, {
//             slidesPerView: "auto",
//             spaceBetween: 30,
//             pagination: {
//                 el: ".swiper-pagination",
//                 clickable: true,
//             },
//             watchOverflow: true, // disables swiper if only one slide
//             grabCursor: true,    // better UX
//         });
//     }
// });

document.addEventListener("DOMContentLoaded", function () {
    const loader = document.querySelector(".elementor.elementor-47");
    if (loader) {
        loader.id = "customLoader";
    }
  setTimeout(function () {
    const header = document.getElementById("customLoader");
    const wrapper = document.getElementById("smooth-wrapper");
    if (header && wrapper && wrapper.contains(header)) {
      document.body.prepend(header);
      document.body.style.paddingTop = header.offsetHeight + "px";
    }
  }, 3000); // 3000 milliseconds = 3 seconds
});
document.addEventListener("DOMContentLoaded", function () {
document.querySelector('.wcf--popup-close').addEventListener('click', function () {
    const iframe = document.querySelector('.aae-popup-content-container iframe');
    console.log(iframe);
    
    // Option 1: Remove the iframe (stops video)
    iframe.parentNode.removeChild(iframe);

    // OR Option 2: Reset iframe source to stop video
    // iframe.src = iframe.src;
});
});

document.addEventListener("DOMContentLoaded", function () {
  const careerBtns = document.querySelectorAll(".careerbtn");
  const popup = document.getElementById("careerPopup");
  const closeBtn = document.getElementById("closeCareerPopup");

  careerBtns.forEach(btn => {
    btn.addEventListener("click", function () {
      popup.style.display = "flex";
      document.body.style.overflow = "hidden";
    });
  });

  closeBtn.addEventListener("click", function () {
    popup.style.display = "none";
    document.body.style.overflow = "";
  });

  popup.addEventListener("click", function (e) {
    if (e.target === popup) {
      popup.style.display = "none";
      document.body.style.overflow = "";
    }
  });
});


document.addEventListener("DOMContentLoaded", function () {
  const dropArea = document.getElementById("dropArea");
  const fileInput = dropArea.querySelector("input[type='file']");
  const fileNameDisplay = document.getElementById("fileName");

  // Highlight on drag
  ['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, e => {
      e.preventDefault();
      e.stopPropagation();
      dropArea.classList.add('dragover');
    });
  });

  // Remove highlight
  ['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, e => {
      e.preventDefault();
      e.stopPropagation();
      dropArea.classList.remove('dragover');
    });
  });

  // Handle drop
  dropArea.addEventListener('drop', e => {
    const files = e.dataTransfer.files;
    if (files.length > 0 && files[0].type === "application/pdf") {
      fileInput.files = files;
      fileNameDisplay.textContent = "Selected file: " + files[0].name;
    } else {
      alert("Only PDF files are allowed.");
    }
  });

  // Also show file name if user selects from click
  fileInput.addEventListener('change', () => {
    if (fileInput.files.length > 0) {
      fileNameDisplay.textContent = "Selected file: " + fileInput.files[0].name;
    }
  });

  // Clicking the area opens file browser
  dropArea.addEventListener('click', () => {
    fileInput.click();
  });
});

jQuery(document).ready(function($) {

    // Menu-text click event only when mobile menu active
    $(document).on('click', '.menu-item-has-children > a .menu-text', function(e) {
        if ($('.wcf__nav-menu').hasClass('mobile-menu-active')) {
            e.preventDefault(); // parent link ko disable karo
            var menu_item = $(this).closest('.menu-item');
            menu_item.siblings().removeClass('active');
            menu_item.toggleClass('active');
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {

    /* =========================
       ELEMENTS
    ========================= */
    // const searchInput = document.getElementById("custom-blog-search");
    // const filterBtn = document.getElementById("custom-blog-filter-btn");
    // const filterList = document.getElementById("custom-blog-filter-list");
    // const noResult = document.getElementById("custom-blog-no-result");

    // let selectedCategory = "all";


    /* =========================
       READ MORE / READ LESS
    ========================= */
    function initReadMore() {

        document.querySelectorAll(".description").forEach(function (desc) {

            // Already initialized
            if (desc.dataset.readmore === "true") {
                return;
            }

            const lineHeight = parseFloat(
                getComputedStyle(desc).lineHeight
            );

            // Safety check
            if (!lineHeight || isNaN(lineHeight)) {
                return;
            }

            const collapsedHeight = lineHeight * 4;

            // Don't show Read More if content is already <= 4 lines
            if (desc.scrollHeight <= collapsedHeight + 2) {
                return;
            }

            desc.dataset.readmore = "true";

            desc.style.maxHeight = collapsedHeight + "px";
            desc.style.overflow = "hidden";
            desc.style.transition = "max-height 0.4s ease";

            const btn = document.createElement("a");

            btn.href = "#";
            btn.className = "read-more-btn";
            btn.textContent = "Read More";

            desc.insertAdjacentElement("afterend", btn);
        });
    }


    /* =========================
       INITIALIZE READ MORE
    ========================= */
    initReadMore();


    /*
     * Swiper / dynamically cloned slides
     */
    setTimeout(initReadMore, 1000);


    /* =========================
       READ MORE CLICK
    ========================= */
    document.addEventListener("click", function (e) {

        const button = e.target.closest(".read-more-btn");

        if (!button) {
            return;
        }

        e.preventDefault();

        const desc = button.previousElementSibling;

        if (!desc) {
            return;
        }

        const lineHeight = parseFloat(
            getComputedStyle(desc).lineHeight
        );

        const collapsedHeight = lineHeight * 4;

        const isExpanded =
            desc.classList.contains("expanded");


        if (isExpanded) {

            desc.classList.remove("expanded");

            desc.style.maxHeight =
                collapsedHeight + "px";

            button.textContent = "Read More";

        } else {

            desc.classList.add("expanded");

            desc.style.maxHeight =
                desc.scrollHeight + "px";

            button.textContent = "Read Less";
        }

    });


    /* =========================
       FILTER ELEMENTS
    ========================= */
    // function getCards() {
    //     return document.querySelectorAll(".custom-blog-card");
    // }

    // function getFilterButtons() {
    //     return document.querySelectorAll(".blog-category-filter");
    // }


    // /* =========================
    //    FILTER BUTTON
    // ========================= */
    // if (filterBtn && filterList) {

    //     filterBtn.addEventListener("click", function (e) {

    //         e.preventDefault();
    //         e.stopPropagation();

    //         filterList.classList.toggle("show");
    //     });
    // }


    // /* =========================
    //    CATEGORY FILTER
    // ========================= */
    // document.addEventListener("click", function (e) {

    //     const button =
    //         e.target.closest(".blog-category-filter");

    //     if (!button) {
    //         return;
    //     }

    //     const filterButtons = getFilterButtons();

    //     filterButtons.forEach(function (btn) {
    //         btn.classList.remove("active");
    //     });

    //     button.classList.add("active");

    //     selectedCategory =
    //         button.getAttribute("data-category") || "all";

    //     filterPosts();

    //     // Close dropdown after selection
    //     if (filterList) {
    //         filterList.classList.remove("show");
    //     }
    // });


    // /* =========================
    //    SEARCH
    // ========================= */
    // // if (searchInput) {

    // //     searchInput.addEventListener("input", filterPosts);
    // // }


    // /* =========================
    //    FILTER POSTS
    // ========================= */
    // function filterPosts() {

    //     const search = searchInput
    //         ? searchInput.value.toLowerCase().trim()
    //         : "";

    //     const cards = getCards();

    //     let visiblePosts = 0;


    //     cards.forEach(function (card) {

    //         const title =
    //             (card.getAttribute("data-title") || "")
    //             .toLowerCase();

    //         const content =
    //             (card.getAttribute("data-content") || "")
    //             .toLowerCase();

    //         const category =
    //             card.getAttribute("data-category") || "";


    //         const searchMatch =
    //             !search ||
    //             title.includes(search) ||
    //             content.includes(search);


    //         const categoryMatch =
    //             selectedCategory === "all" ||
    //             category === selectedCategory;


    //         const showCard =
    //             searchMatch && categoryMatch;


    //         card.style.display =
    //             showCard ? "" : "none";


    //         if (showCard) {
    //             visiblePosts++;
    //         }
    //     });


    //     /* =========================
    //        NO RESULT
    //     ========================= */
    //     if (noResult) {

    //         noResult.classList.toggle(
    //             "show",
    //             visiblePosts === 0
    //         );
    //     }
    // }


    // /* =========================
    //    CLOSE FILTER OUTSIDE CLICK
    // ========================= */
    // document.addEventListener("click", function (e) {

    //     if (
    //         filterList &&
    //         filterBtn &&
    //         filterList.classList.contains("show") &&
    //         !filterList.contains(e.target) &&
    //         !filterBtn.contains(e.target)
    //     ) {
    //         filterList.classList.remove("show");
    //     }
    // });
});