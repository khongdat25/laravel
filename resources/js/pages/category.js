// 1. Slider Sản Phẩm Nổi Bật
const track = document.getElementById('hotTrack');
const nextBtn = document.getElementById('nextHotBtn');
const prevBtn = document.getElementById('prevHotBtn');

if(track && nextBtn && prevBtn) {
    nextBtn.addEventListener('click', () => {
        const cardWidth = track.querySelector('.product-card').offsetWidth + 20;
        track.scrollBy({ left: cardWidth, behavior: 'smooth' });
    });
    prevBtn.addEventListener('click', () => {
        const cardWidth = track.querySelector('.product-card').offsetWidth + 20;
        track.scrollBy({ left: -cardWidth, behavior: 'smooth' });
    });
}

// 2. Logic Dual Range Slider
let sliderOne = document.getElementById("slider-1");
let sliderTwo = document.getElementById("slider-2");
let displayValOne = document.getElementById("val1");
let displayValTwo = document.getElementById("val2");
let minGap = 5;
let sliderTrackFill = document.querySelector(".slider-track-fill");

if(sliderOne && sliderTwo) {
    let sliderMaxValue = sliderOne.max;

    function slideOne() {
        if(parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap){
            sliderOne.value = parseInt(sliderTwo.value) - minGap;
        }
        displayValOne.textContent = sliderOne.value;
        fillColor();
    }

    function slideTwo() {
        if(parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap){
            sliderTwo.value = parseInt(sliderOne.value) + minGap;
        }
        displayValTwo.textContent = sliderTwo.value;
        fillColor();
    }

    function fillColor() {
        let percent1 = (sliderOne.value / sliderMaxValue) * 100;
        let percent2 = (sliderTwo.value / sliderMaxValue) * 100;
        sliderTrackFill.style.left = percent1 + "%";
        sliderTrackFill.style.width = (percent2 - percent1) + "%";
    }

    sliderOne.addEventListener("input", slideOne);
    sliderTwo.addEventListener("input", slideTwo);
    fillColor();
}
