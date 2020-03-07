<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

        </div><!-- end .mainbox -->
    </div>
</div><!-- end #body -->

<footer id="footer" role="contentinfo">
    <script src="<?php $this->options->themeUrl('/static/prism.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('/static/script.js'); ?>"></script>
    <?php if(isMobile()): ?>
    <script src="<?php $this->options->themeUrl('/static/swiper.min.js'); ?>"></script>
    <script>
        var mySwiper = new Swiper ('.swiper-container', {
    direction: 'horizontal', // 垂直切换选项
    loop: true, // 循环模式选项
    autoplay:false,
    // 如果需要分页器
    pagination: {
      el: '.swiper-pagination',
    }
    })        
    </script>
    <?php endif; ?>
    <!--自定义脚本-->
    <?php if ($this->is('index')): ?><!-- 页面为首页时 -->
	<?php elseif ($this->is('post')): ?><!-- 页面为文章单页时 -->
    <script src="<?php $this->options->themeUrl('/static/OwO.min.js'); ?>"></script>
	
	<script>
	var OwO_demo = new OwO({
    logo: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;表情',
    container: document.getElementById('OwO'),
    target: document.getElementById('textarea'),
    api: "<?php $this->options->themeUrl('/static/OwO.json'); ?>",
    position: 'down',
    width: '100%',
    maxHeight: '250px'
    });
    </script>
	<?php else: ?><!-- 页面为其他页时 -->
    <script src="<?php $this->options->themeUrl('/static/OwO.min.js'); ?>"></script>
	<script>
	var OwO_demo = new OwO({
    logo: '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;表情',
    container: document.getElementById('OwO'),
    target: document.getElementById('textarea'),
    api: "<?php $this->options->themeUrl('/static/OwO.json'); ?>",
    position: 'down',
    width: '100%',
    maxHeight: '250px'
    });
    </script>
    <?php endif; ?>
    <div id="totop"><div class="totopl"></div><div class="totopr"></div></div>
    <?php if(isMobile()): ?>
    <a href="<?php $this->options->adminUrl('login.php'); ?>" >&copy; </a>2017-<?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
    <?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>. &emsp;
    <p><span id="bottom_links" style="font-size:12px">
    |&nbsp;<a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a>
    |&nbsp;<a href="<?php $this->options->commentsFeedUrl(); ?>"><?php _e('评论 RSS'); ?></a>
    |&nbsp;当前在线：<span id="online"></span>
    |
    <script src="https://api.menhood.wang/online/index.php?url=<?php echo $this->options->rootUrl;?>"></script>
    <script>document.getElementById('online').innerHTML=c_online;</script>
    </span></p>
    <?php else: ?>
        <a href="<?php $this->options->adminUrl('login.php'); ?>" >&copy; </a>2017-<?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
    <?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>. <a href="http://www.miitbeian.gov.cn/"><?php $this->options->beian();?></a>&emsp;
    <span id="bottom_links" style="font-size:12px">
    |&nbsp;<a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a>
    |&nbsp;<a href="<?php $this->options->commentsFeedUrl(); ?>"><?php _e('评论 RSS'); ?></a>
    |&nbsp;当前在线：<span id="online"></span>
    |
    <script src="https://api.menhood.wang/online/index.php?url=<?php echo $this->options->rootUrl;?>"></script>
    <script>document.getElementById('online').innerHTML=c_online;</script>
    </span>
    <?php endif;?>
</footer><!-- end #footer -->
<?php if(isMobile()): ?><div style="width:100%;height:80px"></div><?php endif;?>
<!--统计代码-->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?9d0d82652d72c7eac67ff1cec8e01247";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

<?php $this->footer(); ?>
</body>
</html>
