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
alert("Hello");
    document.querySelectorAll(".description").forEach(function(desc){

        const lineHeight = parseFloat(getComputedStyle(desc).lineHeight);
        const collapsedHeight = lineHeight * 4;

        if(desc.scrollHeight <= collapsedHeight + 2){
            return;
        }

        desc.style.maxHeight = collapsedHeight + "px";

        const btn = document.createElement("a");
        btn.href = "javascript:void(0)";
        btn.className = "read-more-btn";
        btn.innerHTML = "Read More";

        desc.insertAdjacentElement("afterend", btn);

        btn.addEventListener("click", function(){

            if(desc.classList.contains("expanded")){

                desc.classList.remove("expanded");
                desc.style.maxHeight = collapsedHeight + "px";
                btn.innerHTML = "Read More";

            }else{

                desc.classList.add("expanded");
                desc.style.maxHeight = desc.scrollHeight + "px";
                btn.innerHTML = "Read Less";

            }
        });
    });
});