//留言板访客信息隐藏
$(document).ready(function() {
    $("#userface").click(function() {
        $("#guestinfo").slideToggle("slow");
    });
    $("#totop").click(function() {
        $('html,body').animate({
            scrollTop: '0px'
        }, 800);
    });
    $("#searchbtn").click(function() {
        $("#searchbox").slideToggle("slow");
        $("#s").focus();
    });
    $("#ShowRecentPosts").click(function() {
        $("#RecentComments").hide();
        $("#toc").hide();
        $("#RecentPosts").slideToggle("slow");
    });
    $("#ShowRecentComments").click(function() {
        $("#RecentPosts").hide();
        $("#toc").hide();
        $("#RecentComments").slideToggle("slow");
    });
    //如果是移动端
    if (isMobile) {
        $("#ShowTOC").click(function() {
            $("#RecentPosts").hide();
            $("#RecentComments").hide();
            $("#toc").slideToggle("slow");
        });

        $("#toc").click(function() {
            $("#toc").slideToggle();
        });
    }

    setTimeout(function() {
        if ($("#toclist").text() === "undefined") {
            $("#toc").hide();
        }
    }, 1000);
});
//底部以及边栏检测隐藏
$(window).scroll(function() {
    // 判断客户端样式
    if (isMobile) {
        // 页面总高
        var totalH = document.body.scrollHeight || document.documentElement.scrollHeight
        // 可视高
        var clientH = window.innerHeight || document.documentElement.clientHeight
        window.addEventListener('scroll', function(e) {
            // 计算有效高
            var validH = totalH - clientH
            // 滚动条卷去高度
            var scrollH = document.body.scrollTop || document.documentElement.scrollTop
            // 百分比
            var result = (scrollH / validH * 50 + 5).toFixed(0)
            var top = result + "px";
            $("#totopmsk").css("top", top)
        });
        //隐藏底部栏
        if ($(window).scrollTop() > 200) {
            $('#navbottom').fadeIn();
            $("#secondary").fadeIn();
            $(".post-near").fadeIn();
        } else {
            $('#secondary').fadeOut();
            $('.post-near').fadeOut();
        }
    } else {
        if ($(window).scrollTop() > 200) {
            $('#totop').fadeIn()
        } else {
            $('#totop').fadeOut()
        }
    }
});

//改变图标
var OriginTitile = document.title;
var titleTime;
var OriginIco = document.getElementById("tabico").href;
document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
        document.title = 'Σ(っ °Д °;)っ 哦豁！崩溃啦 ' + OriginTitile;
        clearTimeout(titleTime);
        document.getElementById("tabico").href = "https://i.loli.net/2019/04/03/5ca47188816c5.png";
    } else {
        document.title = '(/ω＼) 嘿嘿，没崩没崩 ' + OriginTitile;
        document.getElementById("tabico").href = OriginIco;
        titleTime = setTimeout(function() {
            document.title = OriginTitile;
        }, 2000);
    }
});

//评论区预览
$('#textarea').on('change', function () {
            var md = $('#textarea').val();
            var html = marked(md);
            $('#preview-box').html(html);
            if (!$('#preview-box').is(':visible')) {
                $('#preview-box').slideToggle();
            } 
        });
    
//noticetext点击跳转百度
$('#noticetext').click(function() {
    var noticetext = $('#noticetext').html();
    window.open('https://www.baidu.com/s?ie=UTF-8&wd=' + noticetext);
});

//懒加载 灯箱
var imgs = $(".post-content img:not(.smilies)");
for (i = 0; i < imgs.length; i++) {
    var imgs = $(".post-content img:not(.smilies)");
    imgs[i].outerHTML = '<a href="' + imgs[i].src + ' "data-fancybox="images" data-caption="' + imgs[i].alt + '" >' + '<div class="post-img"><img data-original="' + imgs[i].src + '" src="https://i.loli.net/2018/10/30/5bd8193caea80.gif" class="lazyload" alt="' + imgs[i].alt + '" title="' + imgs[i].title + '"></div>' + '<\/a>';
};
$('[data-fancybox="images"]').fancybox({
    'transitionIn': 'elastic', //窗口显示的方式 
    'transitionOut': 'elastic'
});
$("img.lazyload").lazyload({
    effect: 'fadeIn'
});

//点击标题展开收起评论
$("#comments-title").click(function(){$('.comment-children').slideToggle();});
