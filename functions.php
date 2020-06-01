<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
    $themeUrl = $options->rootUrl.'/usr/themes/Bilispace';
function themeConfig($form) {
        $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, 'https://i.loli.net/2018/10/26/5bd270b485abb.png', _t('站标'), _t('在这里填入一个图片 URL 地址, 以显示网站图标'));
    $bannerUrl = new Typecho_Widget_Helper_Form_Element_Text('bannerUrl', NULL, 'https://img.menhood.wang/images/201902/bbd0b247711acec3.png', _t('站点 banner 地址'), _t('在这里填入一个图片 URL 地址, 以修改banner,1280x200'));
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, $options->rootUrl."/usr/themes/Bilispace/static/images/logo-tv.png" , _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $avatarUrl = new Typecho_Widget_Helper_Form_Element_Text('avatarUrl', NULL, NULL, _t('头像地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 头像,不填为系统邮箱头像'));
    $noticetext = new Typecho_Widget_Helper_Form_Element_Text('noticetext', NULL, NULL, _t('头部公告'), _t('在这里填入公告,不填写默认为一言,建议不超过36个字'));
    $default_thumb = new Typecho_Widget_Helper_Form_Element_Text('default_thumb', NULL, 'https://img.menhood.wang/i/2020/02/13/maapxg.gif', _t('默认封面'), _t('无封面图时首页显示的图片'));
    $beian = new Typecho_Widget_Helper_Form_Element_Text('beian', NULL, '', _t('备案号'), _t('备案号，没有可不填'));
    
    $form->addInput($favicon);
    $form->addInput($bannerUrl);
    $form->addInput($logoUrl);
    $form->addInput($avatarUrl);
    $form->addInput($noticetext);
    $form->addInput($default_thumb);
    $form->addInput($beian);	
    
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('ShowRecentPosts' => _t('显示最新文章'),
    'ShowRecentComments' => _t('显示最近回复'),
    'ShowCategory' => _t('显示分类'),
    'ShowArchive' => _t('显示归档'),
    'ShowTOC' => _t('显示文章目录')
    ),
    array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowTOC'), _t('侧边栏显示'));
    
    $form->addInput($sidebarBlock->multiMode());
}
//缩略图字段以及部分样式调整
function themeFields($layout) {
    $thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('自定义缩略图'), _t('封面图地址<style>.wmd-button-row {height:auto;}.OwO span{background:#fff0!important;width:auto!important;height:auto!important;}.OwO .OwO-body{top: 23px!important;width:480px!important;}input[type=text]{width:100%;}</style>'));
    $layout->addItem($thumb);
}
/* 编辑器自定义按钮 */

//图片上传
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('Utils', 'addButton');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('Utils', 'addButton');
class Utils {
    public static function addButton(){
         echo <<<EOF
<script>
function closepanl(){
$('#upimgpanel').remove();
}
$(function() {
    var wmdf = $('#wmd-fullscreen-button');

    if (wmdf.length > 0) {
        wmdf.after(
            '<li class="wmd-button" id="wmd-ddns-image-button" style="padding-top:5px;" title="上传图片到图床">上传图片</li>');
    };
    $('#wmd-ddns-image-button').click(function() {
        $('body').append('<div id="upimgpanel">' +
            '<div class="wmd-prompt-background" style="position:absolute;z-index:1000;opacity:0.5;top:0px;left:0px;width:100%;height:954px;"></div>' +
            '<div class="wmd-prompt-dialog" style="top:150px;width:500px"><div><p><b>上传图片</b> <a href="https://img.menhood.wang/" target="_blank" >上传失败点这里</a><button onclick="closepanl()" style="float:right;">关闭</button></p></div>' +
            '<iframe width=500 height=600 src="https://img.menhood.wang/" style="border: 1px black;"></iframe></div></div>');
    });
    
});
</script>
EOF;
}
}
//添加网易云音乐
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('addaplayer', 'addButton');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('addaplayer', 'addButton');
class addaplayer {
    public static function addButton(){
         echo <<<EOF
<script>
function addaplayerinfo(){
    var id = document.getElementById("wyyid").value;
    var type = document.getElementById("datatype").value;
    var code = '\\n!!!\\n<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aplayer/dist/APlayer.min.css"><div id="haplayer"><\/div><script src="https://cdn.jsdelivr.net/npm/aplayer/dist/APlayer.min.js"><\/script><script>$.get("https://api.fczbl.vip/163/?server=netease&type='+type+'&id='+id+'",function(data){const hap = new APlayer({container: document.getElementById("haplayer"),listFolded: false,listMaxHeight: 90,lrcType: 3,audio: data});})<\/script>\\n!!!';
    insert(code);
    closeaddaplayer();
}
function insert(str){
    var tc = document.getElementById("text");
    var tclen = tc.value.length;
    tc.focus();
    if(typeof document.selection != "undefined")
    {
        document.selection.createRange().text = str;  
    }
    else
    {
        tc.value = tc.value.substr(0,tc.selectionStart)+str+tc.value.substring(tc.selectionStart,tclen);
    }
}
function closeaddaplayer(){
$('#addaplayer').remove();
}
$(function() {
    var wmdf = $('#wmd-ddns-image-button');
    if (wmdf.length > 0) {
        wmdf.after(
            '<li class="wmd-button" id="wmd-addaplayer-button" style="padding-top:5px;" title="插入网易云音乐"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAQAAABKfvVzAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAA6mAAAOpgAYTJ3nYAAAAHdElNRQfjAQkEIipnbIKcAAABy0lEQVQ4y43Tu2tTcRjG8c9Jgom9WGtvXjqkmqJTwcG/QKk4OdgWEUEQHRwcpaiDLhFEBAcH8YaD1EFc3CwODuLoVkQbtEIvSGkL9mJr0xyHnMY0F/Rdzvv78j6/97zPeQ//H4GkIPhnWYNWu6UdcMicG4maNzVotUdaRsZ+3TrtAO/FKgUZQ3r16NYRFbFm3hfb9NmgUnBEFqyaN25CTs5Xk2YMekK1AL677ZMps5bkSzTKagmmPPOriob1BUEVjUtpry8I5RHXpF23Hr0y0nrqC9qct09G2l5tUhFdrycoOOh+lC+aMembcZ8ddrW2ILDio5ycnAnT5q0IkazXITBmwI8qHi8+YjVmyFveco5JYqO6Q0whwn9XstlJ/TpMbw5fFKQc1a/LtIYKv+45s/UtEmiWdbFkX3lccNaCEWP6nLZzE19SsGzENc/9FPqgGWz3VuhmVHVL6J2mhKQTAg8My4vLGi774mHJnUAci9YT0eYsy2PDElaizVz1xjGXdRnTZxCj1uCK0Jy7zrljVuh6qccuT60LhUK/PdRSxO1eKEQ49FJn2diNhjz22iMDRQeLjrc45bhOs0a9slDlVqLsRyqDjTV3tyL+AOxCe+HCKfjPAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDE5LTAxLTA5VDA0OjM0OjQyKzA4OjAwWFoIWAAAACV0RVh0ZGF0ZTptb2RpZnkAMjAxOS0wMS0wOVQwNDozNDo0MiswODowMCkHsOQAAABDdEVYdHNvZnR3YXJlAC91c3IvbG9jYWwvaW1hZ2VtYWdpY2svc2hhcmUvZG9jL0ltYWdlTWFnaWNrLTcvL2luZGV4Lmh0bWy9tXkKAAAAGHRFWHRUaHVtYjo6RG9jdW1lbnQ6OlBhZ2VzADGn/7svAAAAGHRFWHRUaHVtYjo6SW1hZ2U6OkhlaWdodAAxNDliIdaQAAAAF3RFWHRUaHVtYjo6SW1hZ2U6OldpZHRoADE0OIbXtlsAAAAZdEVYdFRodW1iOjpNaW1ldHlwZQBpbWFnZS9wbmc/slZOAAAAF3RFWHRUaHVtYjo6TVRpbWUAMTU0Njk3OTY4MhZlLaIAAAARdEVYdFRodW1iOjpTaXplADIyMDZCJTfZHQAAAGJ0RVh0VGh1bWI6OlVSSQBmaWxlOi8vL2hvbWUvd3d3cm9vdC9uZXdzaXRlL3d3dy5lYXN5aWNvbi5uZXQvY2RuLWltZy5lYXN5aWNvbi5jbi9maWxlcy8xMjIvMTIyMjYzNy5wbmdQaBQPAAAAAElFTkSuQmCC" width=20 height=20 /></li>');
    };
    $('#wmd-addaplayer-button').click(function() {
        $('body').append('<div id="addaplayer">' +
            '<div class="wmd-prompt-background" style="position:absolute;z-index:1000;opacity:0.5;top:0px;left:0px;width:100%;height:954px;"></div>' +
            '<div class="wmd-prompt-dialog"><div><p><b>添加音乐</b> <button onclick="closeaddaplayer()" style="float:right;">关闭</button></p></div>' +
            '歌曲/歌单id：<input type="text" id="wyyid" >type：<select id="datatype"><option value ="single">单首</option><option value ="playlist">歌单</option></select><input type="button" value="插入" onclick="addaplayerinfo()" ></div></div>');
    });
    
});
</script>
EOF;
    }
}
//添加视频
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('adddplayer', 'addButton');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('adddplayer', 'addButton');
class adddplayer {
    public static function addButton(){
         echo <<<EOF
<script>
function adddplayerinfo(){
    var url = document.getElementById("dpurl").value;
    var api = document.getElementById("dpapi").value;
    var dm = document.getElementById("dpdm").checked;
    var autoplay = document.getElementById("dpautoplay").checked;
    var loop = document.getElementById("dploop").checked;
    var code='';
    if(!dm){
     code = '\\n!!!\\n<link href="https://cdnjs.loli.net/ajax/libs/dplayer/1.25.0/DPlayer.min.css" rel="stylesheet"><div id="dplayer"><\/div><script src="https://cdnjs.loli.net/ajax/libs/dplayer/1.25.0/DPlayer.min.js"><\/script><script>const dp = new DPlayer({container: document.getElementById("dplayer"),loop:'+loop+',autoplay:'+autoplay+',video: {url: "'+url+'"}});<\/script>\\n!!!';
    }else{
     code = '\\n!!!\\n<link href="https://cdnjs.loli.net/ajax/libs/dplayer/1.25.0/DPlayer.min.css" rel="stylesheet"><div id="dplayer"><\/div><script src="https://cdnjs.loli.net/ajax/libs/dplayer/1.25.0/DPlayer.min.js"><\/script><script src="https://cdnjs.loli.net/ajax/libs/blueimp-md5/2.10.0/js/md5.min.js"><\/script><script>var url="'+url
        +'";const dp = new DPlayer({container: document.getElementById("dplayer"),loop:'+loop
        +',autoplay:'+autoplay
        +',video: {url: url},danmaku: {id: md5(url),api: "'+api
        +'",token: "tokendemo",bottom: "15%"}});<\/script>\\n!!!';
    }
    insert(code);
    closeadddplayer();
}
function insert(str){
    var tc = document.getElementById("text");
    var tclen = tc.value.length;
    tc.focus();
    if(typeof document.selection != "undefined")
    {
        document.selection.createRange().text = str;  
    }
    else
    {
        tc.value = tc.value.substr(0,tc.selectionStart)+str+tc.value.substring(tc.selectionStart,tclen);
    }
}
function closeadddplayer(){
$('#adddplayer').remove();
}
$(function() {
    var wmdf = $('#wmd-addaplayer-button');
    if (wmdf.length > 0) {
        wmdf.after(
            '<li class="wmd-button" id="wmd-adddplayer-button" style="padding-top:5px;" title="插入视频"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAGpWlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDIgNzkuMTYwOTI0LCAyMDE3LzA3LzEzLTAxOjA2OjM5ICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgKFdpbmRvd3MpIiB4bXA6Q3JlYXRlRGF0ZT0iMjAxOS0wMi0xOVQxMzowMDoxNCswODowMCIgeG1wOk1vZGlmeURhdGU9IjIwMTktMDItMTlUMTM6MDE6MzIrMDg6MDAiIHhtcDpNZXRhZGF0YURhdGU9IjIwMTktMDItMTlUMTM6MDE6MzIrMDg6MDAiIGRjOmZvcm1hdD0iaW1hZ2UvcG5nIiBwaG90b3Nob3A6Q29sb3JNb2RlPSIzIiBwaG90b3Nob3A6SUNDUHJvZmlsZT0ic1JHQiBJRUM2MTk2Ni0yLjEiIHBob3Rvc2hvcDpIaXN0b3J5PSIyMDE5LTAyLTE5VDEzOjAxOjEyKzA4OjAwJiN4OTvmlofku7YgZHBsYXllci5wbmcg5bey5omT5byAJiN4QTsyMDE5LTAyLTE5VDEzOjAxOjMyKzA4OjAwJiN4OTvmlofku7YgRDpcUGljdHVyZXNcU2F2ZWQgUGljdHVyZXNc5Zu+5qCHXGRwbGF5ZXIyNF8yNC5wbmcg5bey5a2Y5YKoJiN4QTsiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6ZmIyOWMzOWUtMGY2MC0wZDQ5LTgxOTktNjIzY2MyZjc4NGUwIiB4bXBNTTpEb2N1bWVudElEPSJhZG9iZTpkb2NpZDpwaG90b3Nob3A6OTI5MWIxMTEtMTU3NC0yODRiLTg5MTgtMWYzMTIwMDk1OTFmIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6NWE0M2Q0MGUtOGY2Ni0yMDQ3LWJmZDktODM4OWExZmM3YmUwIj4gPHhtcE1NOkhpc3Rvcnk+IDxyZGY6U2VxPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY3JlYXRlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo1YTQzZDQwZS04ZjY2LTIwNDctYmZkOS04Mzg5YTFmYzdiZTAiIHN0RXZ0OndoZW49IjIwMTktMDItMTlUMTM6MDA6MTQrMDg6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCBDQyAoV2luZG93cykiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOmZiMjljMzllLTBmNjAtMGQ0OS04MTk5LTYyM2NjMmY3ODRlMCIgc3RFdnQ6d2hlbj0iMjAxOS0wMi0xOVQxMzowMTozMiswODowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8L3JkZjpTZXE+IDwveG1wTU06SGlzdG9yeT4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6qHOR3AAAEBklEQVRIx52WfUxVdRjHn0wN0t6GE002lugiBTTFYTlXWhg6zJqxoSt6UWQhzSwobc2WW7Pa2tBJXbhAwOXyOujey+QSIlACBijEqKFCo+giN7mE8qKAsk9/nEP3wL0i89l+O7895/y+3+ft9zxHZFqZJQEbIv1j47+MTjqZlJhv0BkLDDpj0smk43EJX8UEbdy1QmSO3JO8+s7n4dWVpgpsKeBIgO7t0BEM7cFgCwdHPNh0nK02VUXEfPHKjIHne63yLKpuyuNWPvy+BgoFsgXyRNkXqvtsdd8aBLdyKKn5tfgx73UPTQu+eOmmhZ39tnauRTtBzQKmOyyz+o1BwBGFbdD2p69/mI9b8Ae8AufY/u3ppGsDpLkB+0GgWH26I0sT6Ajm6lDPlfmLgj1dCErL6k0MR4BeY7VZoEAgSyBHtdaoWlwkYNEQWARSBa6HU1Xd9KPIbCd4aMThTZCnAGndzxIwPwytCdBjht5K+DsHzkdBvkpmmXImQ4BMdkQd3arCz5XmuooGOvwUK80a8Krn4aYdt9JXD+YFriS5Am1LuNh4ulXkQZFlwZFP0J/uTKhZtaxsGXeVGx1QMEupJq0XOQIDelY9t3elHPjkRCzDCZCpSWa2gKNqCliXe5K2w86zEytLYCiOj44kfiB6vV6HfZvimklNZLmPK9BpPygNgNG+yfrBS4oHRRqCPIHuF8hIT0mVolxdPu1BTjezBWo3uxKcWQmJAubZcPuGUz/WDyVzlWqbICgUuBTAmdKcUinO1RVMIjAKnF3vSmD1huMCPz8L4yNO/agDSjzcElRac0slVZ+STE+Y4tbES8s8GB+bTFAXBg1vuRKPXFUuYOGUENk2k/m9Pk0OfnoijuEPJycqQ+DyUWYk42NgXQzpmnLNEhiK5dBnifHyZMhuP66lOj0waRpaX83MSAbawLpCCdNEmQ+ksGZzTJCIeEprfUUTl32dlWRRL0yBQPtJ13C5k5udyhmjwG/etF8obxOZr9zlbbuPhIJhcpgsKoFBwLoEGl6D5r3QvA+aozVrH1x4E35ar9yhdAH07Nxz7GVNq7tfKirPW7m+XWlY2mZnEqXvGNTYulsG9Zt0gb5QautaqkU8JnfTeQvXePwzaO/mj7Xu27XpLnMhTeBiIP2j9t5HfZ5xP3h8/cN8uodsf+F4XbFsJgMnX5TQ2iPoHbFdWR64Y+m0U83r8ZBHTp1rMXHbCC1POdtyvmZkTujyBJqXw+1MyhtbTy3y3bhgxrN51/6vd/5SW1JDTzL07oeul+Dy03BpNXRtgd53wa6jsc5y7o0D30SK3Hcv/xaesu7Ft1e///GxOH1y8rdWU7a5zGw0p6Ykf3fw0LH3QrbsWft/Kd5B/gORZ1qaUwWnOQAAAABJRU5ErkJggg==" width=20 height=20 /></li>');
    };
    $('#wmd-adddplayer-button').click(function() {
        $('body').append('<div id="adddplayer">' +
            '<div class="wmd-prompt-background" style="position:absolute;z-index:1000;opacity:0.5;top:0px;left:0px;width:100%;height:954px;"></div>' +
            '<div class="wmd-prompt-dialog"><div><p><b>添加视频</b> <button onclick="closeadddplayer()" style="float:right;">关闭</button></p></div>' +
            '直链地址：<input type="text" id="dpurl" >api服务器地址：<input type="text" id="dpapi" value="https://dans.mdh.red/">弹幕：<input type="checkbox" id="dpdm">自动播放：<input type="checkbox" id="dpautoplay">循环：<input type="checkbox" id="dploop"><input type="button" value="插入" onclick="adddplayerinfo()" ></div></div>');
    });
    
});
</script>
EOF;
    }
}

//owo
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('addowo', 'addButton');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('addowo', 'addButton');
class addowo {
    public static function addButton(){
         echo <<<EOF
<link rel="stylesheet" href="{$options->rootUrl}/usr/themes/Bilispace/static/OwO.min.css">
<script src="{$options->rootUrl}/usr/themes/Bilispace/static/OwO.min.js"></script>
<script>
function closepanl(){
$('#addowopanel').remove();
}
function loadowo(){
    var OwO_demo = new OwO({logo: "<img src=\'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQAgMAAABinRfyAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAxQTFRFAAAAm6Kpg4ySmKCoOQPxiAAAAAR0Uk5TACuS9QkrIZAAAABMSURBVHicY2DI/8nAwPT/fwMD/xPpDwz6Dow/GGoZgGiHjY0ewxcbG3mGDzY2/AwfHBj5Gb4s4JJn2FGhq8dQK/2kFqIYrA1sAMgoAA+HGngFiloFAAAAAElFTkSuQmCC\'>",container: document.getElementById("OwO"),target: document.getElementById("text"),api: "{$options->rootUrl}/usr/themes/Bilispace/static/OwO.json",position: "down",width: "100%",maxHeight: "250px"});
}
$(function() {
    var wmdf = $('#wmd-adddplayer-button');

    if (wmdf.length > 0) {
        wmdf.after('<div id="OwO" class="OwO" style="position: absolute;vertical-align: baseline;display: inline-block;margin: 0;margin-top: 3px;"></div><script>loadowo();<\/script>');
        
    };
});
</script>
EOF;
}
}

//添加tip
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('addtip', 'addButton');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('addtip', 'addButton');
class addtip {
    public static function addButton(){
         echo <<<EOF
<script>
function addtip(type){
    var code = '!!!\\n<p class="'+ type +'">\\n\\n<\/p>\\n!!!';
    insert(code);
    closeaddtip();
}
function insert(str){
    var tc = document.getElementById("text");
    var tclen = tc.value.length;
    tc.focus();
    if(typeof document.selection != "undefined")
    {
        document.selection.createRange().text = str;  
    }
    else
    {
        tc.value = tc.value.substr(0,tc.selectionStart)+str+tc.value.substring(tc.selectionStart,tclen);
    }
}
function closeaddtip(){
$('#addtip').remove();
}
$(function() {
    var wmdf = $('#wmd-editarea');
    if (wmdf.length > 0) {
        wmdf.after(
            '<style>p.tip{border-left-color:#3c763d;background-color:rgba(241,249,241,.83)}p.tip:before{background-color:#3c763d}p.warning{border-left-color:#f7d24c;background-color:#fefbed}p.warning:before{background-color:#f7d24c}p.danger{border-left-color:#f66;background-color:hsla(0,100%,70%,.06)}p.danger:before{background-color:#f66}p.danger:before,p.tip:before,p.warning:before{content:"!";position:absolute;top:14px;left:-12px;color:#fff;width:20px;height:20px;border-radius:100%;text-align:center;line-height:20px;font-weight:700;font-family:Dosis,Source Sans Pro,Helvetica Neue,Arial,sans-serif}p.danger,p.tip,p.warning{padding:12px 24px 12px 20px;margin:2em 0;border-left:4px solid;position:relative;border-bottom-right-radius:2px;border-top-right-radius:2px}<\/style><li style="float:left;list-style:none;cursor: pointer;"><p class="tip" style="width:50px;margin: 0;" onclick="addtip(\'tip\')" >正常<\/p><\/li><li style="float:left;list-style:none;cursor: pointer;"><p class="warning" style="width:50px;margin: 0;" onclick="addtip(\'warning\')" >警告<\/p><\/li><li style="float:left;list-style:none;cursor: pointer;"><p class="danger" style="width:50px;margin: 0;" onclick="addtip(\'danger\')" >危险<\/p><\/li><div style="clear: both;"><\/div>');
    };
    
});
</script>
EOF;
    }
}

//检测移动端
function isMobile(){
	    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
	    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
	    {
	        return true;
	    } 
	    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
	    if (isset ($_SERVER['HTTP_VIA']))
	    { 
	        // 找不到为flase,否则为true
	        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
	    } 
	    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
	    if (isset ($_SERVER['HTTP_USER_AGENT']))
	    {
	        $clientkeywords = array ('nokia',
	            'sony',
	            'ericsson',
	            'mot',
	            'samsung',
	            'htc',
	            'sgh',
	            'lg',
	            'sharp',
	            'sie-',
	            'philips',
	            'panasonic',
	            'alcatel',
	            'lenovo',
	            'iphone',
	            'ipod',
	            'blackberry',
	            'meizu',
	            'android',
	            'netfront',
	            'symbian',
	            'ucweb',
	            'windowsce',
	            'palm',
	            'operamini',
	            'operamobi',
	            'openwave',
	            'nexusone',
	            'cldc',
	            'midp',
	            'wap',
	            'mobile'
	            ); 
	        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
	        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
	        {
	            return true;
	        } 
	    } 
	    // 协议法，因为有可能不准确，放到最后判断
	    if (isset ($_SERVER['HTTP_ACCEPT']))
	    { 
	        // 如果只支持wml并且不支持html那一定是移动设备
	        // 如果支持wml和html但是wml在html之前则是移动设备
	        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
	        {
	            return true;
	        } 
	    } 
	    return false;
	}
//时间转换，距离当前时间
function timesince($older_date,$comment_date = false) {
$chunks = array(
array(86400 , '天'),
array(3600 , '小时'),
array(60 , '分'),
array(1 , '秒'),
);
$newer_date = time();
$since = abs($newer_date - $older_date);
if($since < 2592000){
for ($i = 0, $j = count($chunks); $i < $j; $i++){
$seconds = $chunks[$i][0];
$name = $chunks[$i][1];
if (($count = floor($since / $seconds)) != 0) break;
}
$output = $count.$name.' 前';
}else{
$output = !$comment_date ? (date('Y-m-j G:i', $older_date)) : (date('Y-m-j', $older_date));
}
return $output;
}
//评论等级
function dengji($i){
    $themeUrl = $options->rootUrl.'/usr/themes/Bilispace';
    $lvhtml = "<span style='display: inline-block;width: 19px;height: 9px;vertical-align: middle;margin: 0 8px;background:url(".$themeUrl."/static/images/comment-icons.png) no-repeat -23px";
$db=Typecho_Db::get();
$mail=$db->fetchAll($db->select(array('COUNT(cid)'=>'rbq'))->from('table.comments')->where('mail = ?', $i)->where('authorId = ?','0'));
foreach ($mail as $sl){
$rbq=$sl['rbq'];}
if($rbq<1){
echo $lvhtml.' -604px\'></span>';
}elseif ($rbq<10 && $rbq>0) {
echo $lvhtml.' -28px\'></span>';
}elseif ($rbq<20 && $rbq>=10) {
echo $lvhtml.' -92px\'></span>';
}elseif ($rbq<30 && $rbq>=20) {
echo $lvhtml.' -156px\'></span>';
}elseif ($rbq<40 && $rbq>=30) {
echo $lvhtml.' -220px\'></span>';
}elseif ($rbq<50 && $rbq>=40) {
echo $lvhtml.' -284px\'></span>';
}elseif ($rbq<60 && $rbq>=50) {
echo $lvhtml.' -348px\'></span>';
}elseif ($rbq<70 && $rbq>=60) {
echo $lvhtml.' -412px\'></span>';
}elseif ($rbq<80 && $rbq>=70) {
echo $lvhtml.' -476px\'></span>';
}elseif ($rbq>=80) {
echo $lvhtml.' -540px\'></span>';
}
}

//替换表情
function rowo($content) {
    $jsonadr = Helper::options()->themeUrl.'/static/OwO.json';
    $json = file_get_contents($jsonadr);
    $owoarr = json_decode($json,true);
    $emdata = [];
    foreach ($owoarr as $v1) {
        foreach ($v1 as $v2) {
            foreach ($v2 as $v3) {
                array_push($emdata,$v3);
            }
        }
    }

    //截取指定两个字符之间的字符串
    function cut($begin,$end,$str) {
        $b = mb_strpos($str,$begin) + mb_strlen($begin);
        $e = mb_strpos($str,$end) - $b;
        return mb_substr($str,$b,$e);
    }
    //匹配占位符
    preg_match_all("/:[a-z,A-Z,0-9]+:/", $content, $match);

    foreach ($match[0] as $mkey => $mvalue) {
        $text = cut(":",":",$mvalue);
        foreach ($emdata as $key => $value) {
            if ($text === $value['text']) {
                $content = str_replace($mvalue,$value['icon'],$content) ;
            }
        }
    }
    echo $content;
}

//评论加@
function get_comment_at($coid)
{
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')->from('table.comments')->where('coid = ? AND status = ?', $coid, 'approved'));
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')->from('table.comments')->where('coid = ? AND status = ?', $parent, 'approved'));
        $author = $arow['author'];
        $href   = '<a  href="#comment-' . $parent . '">@' . $author . '</a>';
        echo $href;
    } else {
        echo '';
    }
}
