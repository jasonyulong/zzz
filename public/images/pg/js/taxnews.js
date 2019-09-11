
$(function () {
    var num =2;
    var $sortid=$("#sortid").val()
    $("#more").click(function () {
        num++
        getpage()
    })
    function  getpage() {
        $.post("/index/article/index_json/page/"+num+".html", { sort: $sortid, page: num },
            function(data){
                if(data == ""){
                    $("#more").html("没有更多了")
                }
                data.forEach(function(value,index){
                    $("#more").before(" <a href=\"\" class=\"demo\" style=\"height: 120px;margin: 20px;margin-bottom: 0px;padding-bottom: 20px;border-bottom:1px solid #F2F2F2;width: 680px;\">\n" +
                        "                <div style=\"display: block;width: 165px;height: 100px;\"><img width=\"165\" height=\"100\"  src=\""+value.pic+"\"></div>\n" +
                        "                <div style=\"display: flex;flex-wrap: wrap\">\n" +
                        "                    <h2>"+value.title+"</h2>\n" +
                        "                    <p>"+value.time+"&nbsp;&nbsp;&nbsp;评论："+value.hot+"</p>\n" +
                        "                </div>\n" +
                        "            </a>")
                })
            });
    }

})
