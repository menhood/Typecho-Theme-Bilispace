<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="main" id="main" role="main" >
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <h1 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <ul class="post-meta">
            <li itemprop="author" itemscope itemtype="http://schema.org/Person"><?php _e('作者: '); ?><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
            <li><?php _e('时间: '); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
            <li><?php _e('分类: '); ?><?php $this->category(','); ?></li>
            <li><?php if($this->user->hasLogin()):?>
                <a href="/admin/write-post.php?cid=<?php echo $this->cid;?>" target="_blank"><b>编辑文章</b></a>
                <?php endif;?>
            </li> 
        </ul>
        <div class="post-content" id="postcontent" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
        <p itemprop="keywords" class="tags">
            <?php $this->tags('  ', true, 'none'); ?>
        </p>
    </article>
    <ul class="post-near">
        <li class="prev" ><?php $this->thePrev('%s','木有更久的文章了'); ?></li>
        <li class="next" > <?php $this->theNext('%s','木有更新的文章了'); ?> </li>
        
    </ul>
    <div style="clear:both"></div>
    <?php $this->need('comments.php'); ?>

    
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
