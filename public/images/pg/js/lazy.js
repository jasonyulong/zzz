visibleImgLazyload();
$("body,html").scrollTop(1);
/** * 可视区域 img 加载 */
function visibleImgLazyload() {
    //当前窗口高度
    var winHeight = $(window).height();
    //整个文档高度
    var bodyHeight = $(document).height();
    //如果图片不满屏，直接加载
    if(bodyHeight <= winHeight) {
        $(".J-lazd").each(function() {
            var $this = $(this);
            if($this.attr("data-url") != $this.attr("src")) {
                //如果为空，src设置为data-src
                if($this.attr("data-src")) {
                    $this.attr("src", $this.attr("data-src"));
                } else {
                    $this.attr("data-src", $this.attr("src"));
                }
            }
        });
    } else {
        var phase = 100;
        $(document).on("scroll", function(e) {
            $(".J-lazd").each(function() {
                var $this = $(this);
                var thisButtomTop = parseInt($(window).height()) + parseInt($(window).scrollTop());
                var thisTop = parseInt($(window).scrollTop()-parseInt($this.height()));
                var imgTop = parseInt($this.offset().top);
                if(imgTop >= thisTop - phase && imgTop <= thisButtomTop + phase && $this.attr("data-url") != $this.attr("src")) {
                    //如果为空，src设置为data-src
                    if($this.attr("data-src")) {
                        $this.attr("src", $this.attr("data-src"));
                    } else {
                        $this.attr("data-src", $this.attr("src"));
                    }
                }
            });
        });
    }
}
