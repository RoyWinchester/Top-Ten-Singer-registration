(function () {
    function adapt() {
        var innerWidth = window.innerWidth,
            innerHeight = window.innerHeight,
            st10 = document.getElementById("st10"),
            st10Wrapper = document.getElementById("st10Wrapper"),
            btnWrapper = document.getElementById("btnWrapper");

        if (st10 && st10.style) {
            st10Wrapper.style.width = innerHeight * 0.24 + "px";
            st10.style.width = innerHeight * 0.24 + "px";
            st10.style.height = innerHeight * 0.24 + "px";
        }
        if (btnWrapper && btnWrapper.style) {
            btnWrapper.style.width = innerHeight * 0.24 + "px";
        }
    }

    // 加载页面时适应宽高
    window.addEventListener("load", adapt);

    // 图片自适应宽高
    window.addEventListener("resize", adapt);
}());