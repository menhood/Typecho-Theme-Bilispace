<?php
/**
* Template Page of Links
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;?>
<?php $this->need('header.php'); ?>
<?php $linksarray=array(
    "menhood"=>array(
        "name"=>"援军",
        "img"=>"https://cdn.v2ex.com/gravatar/17842af77c9727c64e6468ad6d9d3f96",
        "url"=>"http://menhood.wang/",
        "desc"=>"入门级bug制造者"
        ),
    "github"=>array(
        "name"=>"xxxhub",
        "img"=>"https://github.com/fluidicon.png",
        "url"=>"https://github.com",
        "desc"=>"全球最大同性交友网站之一"
        )
    );
?>
<div class="main" id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <h1 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <div class="post-content" itemprop="articleBody">
            <article class="post" >
                <?php foreach($linksarray as $v){
echo <<<EOF
			                    <a href="{$v['url']}" target="_blank">
			                    <div class="links">
			                        <div class="links-head">
				                            <img src=" {$v['img']}" />
				                    </div>
				                    
				                    <div class="links-info" >
				                        <p class="links-title">{$v['name']}</p>
                                        <span class="links-dedsc">{$v['desc']}</span>
				                    </div>
				                    
				                </div>
				                </a>
EOF;
} ?>
                <div class="post-content" itemprop="articleBody">
                    <?php $this->content(); ?>
                </div>
            </article>  
        </div>
    </article>
    <?php $this->need('comments-links.php'); ?>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>