<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link id="tabico" rel="icon" href="<?php $this->options->favicon(); ?>" />
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
        
    <script src="<?php $this->options->themeUrl('/static/jquery.min.js');?>"></script> 
    <!-- 使用url函数转换相关路径 -->
    <?php if(!isMobile()): ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/static/style.css'); ?>">
    <?php else: ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/static/style-Mobile.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/static/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/static/swiper.min.css'); ?>">
    <?php endif; ?>
    
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/static/jquery.fancybox.min.css'); ?>">
    <script src="<?php $this->options->themeUrl('/static/jquery.fancybox.min.js');?>"></script>
    <script src="<?php $this->options->themeUrl('/static/jquery.lazyload.min.js');?>"></script>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/static/prism.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/static/OwO.min.css'); ?>">  
    
    <!--[if lt IE 9]>
    <script src="<?php $this->options->themeUrl('/static/html5shiv.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('/static/respond.js'); ?>"></script>
    <![endif]-->

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
</head>

<body>
<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->
<div id="widtherror"><h1>|ω・) 屏幕太小了，换个大点的吧</h1></div>
<header id="header" class="header">
    <?php if(!isMobile()):?><script>var isMobile=false;</script>
    <div class="banner">
        <div class="navbox">
                
                <nav id="nav-menu" class="nav" role="navigation">
                    <a href="http://menhood.wang" title="导航页" ><img class="smalllogo" src="<?php $this->options->logoUrl() ?>" /></a>
                    <a<?php if($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                    <a<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                    <?php endwhile; ?>
                </nav>
                <?php if($this->user->hasLogin()): ?>
				<a class="loginbtn" href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a>
                <?php else: ?>
                <a class="loginbtn" href="<?php $this->options->adminUrl('login.php'); ?>" target="_blank"><?php _e('登录'); ?></a>
                <?php endif; ?>
            </div>
        <div class="logobox" <?php if($this->options->bannerUrl): ?>style="background-image: url('<?php $this->options->bannerUrl() ?>');"<?php endif; ?>>
            <img class="h-avatar" src="<?php if($this->options->avatarUrl): ?><?php $this->options->avatarUrl(); ?><?php else: _e('https://cdn.v2ex.com/gravatar/'.md5($this->author->mail));?>  <?php endif; ?>" />
            
            <div class="site-name">
                <a id="logo" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a>
        	    <p class="description"><?php $this->options->description() ?></p>
            </div>
            
        </div><!-- end .row -->
    </div>
    <?php endif; ?>
    <?php if(isMobile()):?>
        <div class="h-box">
            <span class="h-title"><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></span>
            <i class="fa fa-search search" id="searchbtn" ></i>
            <div class="searchbox" id="searchbox" >
                <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                    <input type="text" id="s" name="s" class="text" placeholder="<?php _e(' 输入关键字搜索'); ?>" />
                    <button type="submit" class="submit btn"><?php _e('搜索'); ?></button>
                </form>
                <!--标签云-->
                <?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=30')->to($tags); ?>
                <div class="tags-list">
                <?php while($tags->next()): ?>
                    <a href="<?php $tags->permalink(); ?>" title='<?php $tags->name(); ?>'><?php $tags->name(); ?></a>
                <?php endwhile; ?>
                </div>  
            </div>
        </div>
        <nav class="nav">
            <a<?php if($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                <?php while($pages->next()): ?>
            <a<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                    <?php endwhile; ?>
        </nav>
        <div class="banner">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php while($this->next()): ?>
                    <div class="swiper-slide">
                        <a href="<?php $this->permalink() ?>">
                        <img src="
	                    <?php if ($this->fields->thumb): ?>
	                    <?php $this->fields->thumb();?>
	                    <?php else:?>
	                    https://img.menhood.wang/i/2020/02/11/krwtlq.jpg
	                    <?php endif;?>" /> </a>   
                    </div>
                    <?php endwhile;?>  
                </div>
                <!-- 分页器 -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="notice">
            <i class="fa fa-volume-up"></i>
            <span id="noticetext">
                <?php if ($this->options->noticetext): ?>
                <?php $this->options->noticetext();?>
                <?php else: ?>
                <script src="https://v1.hitokoto.cn/?encode=js&select=%23noticetext" defer></script>
                <?php endif; ?>
            </span>
        </div>
    <?php endif; ?>
</header><!-- end #header -->
<div id="body">
    <div class="container">
        <?php if(!isMobile()):?>
        <div class="Breadcrumbs">
            <div class="Breadcrumbs-title">当前位置：<a href="<?php $this->options->siteUrl(); ?>" >主页</a> &raquo;</li>
	                  <?php if ($this->is('index')): ?><!-- 页面为首页时 -->
		              最近文章
	                  <?php elseif ($this->is('post')): ?><!-- 页面为文章单页时 -->
		              <?php $this->category(); ?> &raquo; <?php $this->title() ?>
	                  <?php else: ?><!-- 页面为其他页时 -->
		              <?php $this->archiveTitle(' &raquo; ','',''); ?>
                      <?php endif; ?>
            </div>
            <div class="Breadcrumbs-notice">
                <span style="color:pink" >》</span><span style="color:#00a1d6" >》</span>
                <span class="noticetext" id="noticetext" >
                <?php if ($this->options->noticetext): ?>
                <?php $this->options->noticetext();?>
                <?php else: ?>
                <script src="https://v1.hitokoto.cn/?encode=js&select=%23noticetext" defer></script>
                <?php endif; ?>
                </span>
            </div>
        </div>
        <?php endif; ?>
        <div class="mainbox" >

    
    
