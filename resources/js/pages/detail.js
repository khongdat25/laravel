window.changeImage = function(thumb) {
    const mainImg = document.getElementById('mainImg');
    if (mainImg) {
        mainImg.src = thumb.src;
        document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
    }
};
