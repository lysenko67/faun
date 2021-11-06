(function () {
    function hide(elem, scrollTop) {
        const el = document.getElementById(elem)

        window.addEventListener('scroll', () => {
            let scrollOffset = pageYOffset;
            el.style.opacity = 1 - scrollOffset / scrollTop
        });
    }

    hide('pun', 800)
    hide('titleClassic', 1000)

})()
