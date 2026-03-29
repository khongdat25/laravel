// Đợi toàn bộ HTML render xong thì mới chạy JS
document.addEventListener('DOMContentLoaded', function () {

    // 1. Slider Logic
    const slides = document.getElementById('slides');

    // Kiểm tra: Chỉ chạy slider nếu tìm thấy thẻ #slides
    if (slides) {
        let currentSlide = 0;
        setInterval(() => {
            currentSlide = (currentSlide + 1) % 4;
            slides.style.transform = `translateX(-${currentSlide * 25}%)`;
        }, 4000);
    }

    // 2. Logic Smart Submenu
    const submenuItems = document.querySelectorAll('.has-submenu');

    if (submenuItems.length > 0) {
        submenuItems.forEach(item => {
            const submenu = item.querySelector('.submenu');
            let hideTimeout;

            if (submenu) {
                const showSubmenu = () => {
                    clearTimeout(hideTimeout);
                    document.querySelectorAll('.submenu').forEach(sub => {
                        if (sub !== submenu) {
                            sub.style.visibility = 'hidden';
                            sub.style.opacity = '0';
                            sub.style.transform = 'translateX(10px)';
                        }
                    });

                    submenu.style.visibility = 'visible';
                    submenu.style.opacity = '1';
                    submenu.style.transform = 'translateX(0)';
                };

                const hideSubmenu = () => {
                    hideTimeout = setTimeout(() => {
                        submenu.style.visibility = 'hidden';
                        submenu.style.opacity = '0';
                        submenu.style.transform = 'translateX(10px)';
                    }, 400);
                };

                item.addEventListener('mouseenter', showSubmenu);
                item.addEventListener('mouseleave', hideSubmenu);
                submenu.addEventListener('mouseenter', showSubmenu);
                submenu.addEventListener('mouseleave', hideSubmenu);
            }
        });
    }
});
