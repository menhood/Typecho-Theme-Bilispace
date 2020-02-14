<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if(!isMobile()):?>
<div class="secondary" id="secondary" role="complementary">
    
    <div class="searchbox">
        <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
            <input type="text" id="s" name="s" class="text" placeholder="<?php _e(' 输入关键字搜索'); ?>" />
            <button type="submit" class="submit btn"><?php _e('搜索'); ?></button>
        </form>
    </div>
    
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowTOC', $this->options->sidebarBlock ) ): ?>
        <?php if (!$this->is('index')):?>
    <section class="widget" id="toc" >
		<h3 class="widget-title"><?php _e('目录'); ?></h3>
	</section>	
        <script src="<?php $this->options->themeUrl('/static/md-toc.min.js'); ?>"></script>
        <script type="text/javascript">
        new Toc( 'postcontent',{
        'level':3,
        'top':200,
        'class':'toc',
        'targetId':'toc'
        } );
        // 滑动滚动条
        $(window).scroll(function(){
        var tocp=$('#toc').offset().top;
        // 滚动条距离顶部的距离 大于 tocp 时
        if($(window).scrollTop() > tocp){
            $('#toc>div').css('position','fixed')
        } else{
            $('#toc>div').css('position','relative')
        }
        }); 
        </script>
	    <?php endif; ?>
	    
    <?php endif; ?>
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)): ?>
    <section class="widget">
		<h3 class="widget-title"><?php _e('最新文章'); ?></h3>
        <ul class="widget-list">
            <?php $this->widget('Widget_Contents_Post_Recent')
            ->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
        </ul>
    </section>
    <?php endif; ?>

    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
    <section class="widget">
		<h3 class="widget-title"><?php _e('最近回复'); ?></h3>
        <ul class="widget-list">
        <?php $this->widget('Widget_Comments_Recent','ignoreAuthor=true')->to($comments); ?>
        <?php while($comments->next()): ?>
            <a href="<?php $comments->permalink(); ?>">
                <li>
                <img class="avatar-mini" src="https://cdn.v2ex.com/gravatar/<?php $mailstr=$comments->mail;echo md5($mailstr);?>" />
                <p class="widget-list-comment"><?php $comments->author(false); ?>: <?php $comments->excerpt(25, '...'); ?></p>
                </li>
            </a>
        <?php endwhile; ?>
        
        </ul>
    </section>
    <?php endif; ?>

    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)): ?>
    <!--
    <section class="widget">
		<h3 class="widget-title"><?php _e('分类'); ?></h3>
        <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
	</section>
    -->
    <?php endif; ?>
    
    

</div><!-- end #sidebar -->
<?php endif; ?>
<?php if(isMobile()):?>
<div class="secondary" id="secondary" role="complementary">
    <div class="nav-bottom" id="navbottom" >
        <div class="nav-bottom-box" id="ShowRecentPosts" >
            <button class="nav-bottom-btn">最近文章</button>
        </div>
        <div class="nav-bottom-box" id="ShowRecentComments" >
            <button class="nav-bottom-btn">最近评论</button>
        </div>
        <div class="nav-bottom-box" id="ShowTOC" >
            <button class="nav-bottom-btn">文章目录</button>
        </div>
        <div class="nav-bottom-box" id="totop">
            
            <button class="nav-bottom-btn"><div id="totopmsk"></div>返回顶部</button>
        </div>
        <script>var isMobile=true;</script>
    </div>
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)): ?>
    <section class="widget" id="RecentPosts" >
		<h3 class="widget-title"><?php _e('最新文章'); ?></h3>
        <ul class="widget-list">
            <?php $this->widget('Widget_Contents_Post_Recent')
            ->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
        </ul>
    </section>
    <?php endif; ?>

    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
    <section class="widget" id="RecentComments" >
		<h3 class="widget-title"><?php _e('最近回复'); ?></h3>
        <ul class="widget-list">
        <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
        <?php while($comments->next()): ?>
            <a href="<?php $comments->permalink(); ?>">
                <li>
                <img class="avatar-mini" src="https://gravatar.loli.net/avatar/<?php $mailstr=$comments->mail;echo md5($mailstr);?>" />
                <p class="widget-list-comment"><?php $comments->author(false); ?>: <?php $comments->excerpt(25, '...'); ?></p>
                </li>
            </a>
        <?php endwhile; ?>
        
        </ul>
    </section>
    <?php endif; ?>

    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)): ?>
    <section class="widget">
		<h3 class="widget-title" id="Category" ><?php _e('分类'); ?></h3>
        <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
	</section>
    <?php endif; ?>
    
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowTOC', $this->options->sidebarBlock ) ): ?>
        <?php if (!$this->is('index')):?>
    <section class="widget" id="toc" >
		<h3 class="widget-title"><?php _e('目录'); ?></h3>
	</section>	
        <script src="<?php $this->options->themeUrl('/static/md-toc.min.js'); ?>"></script>
        <script type="text/javascript">
        new Toc( 'postcontent',{
        'level':3,
        'top':200,
        'class':'toc',
        'targetId':'toc'
        });
        $("#toc").height($("#toclist>ul").height()+52);
        </script>
	    <?php endif; ?>
    <?php endif; ?>

</div><!-- end #sidebar -->
<?php endif; ?>