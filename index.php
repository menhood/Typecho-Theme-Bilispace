<?php
/**
 * 这是根据 Typecho 0.9 系统的默认皮肤魔改的皮肤
 * 
 * @package Typecho Bilisapce Theme 
 * @author Menhood
 * @version 1
 * @link http://menhood.wang
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>


<?php if(!isMobile()):?>
<div class="main" id="main" role="main" style="background-color:#f4f5f7">
	<?php while($this->next()): ?>
	    
        <article class="index-card" itemscope itemtype="http://schema.org/BlogPosting">
            <a href="<?php $this->permalink() ?>">
            <div class="thumb">
            <div class="imgmask"></div>
	        <img src="
	        <?php if ($this->fields->thumb): ?>
	        <?php $this->fields->thumb();?>
	        <?php else:?>
	        https://img.menhood.wang/i/2020/02/11/krwtlq.jpg
	        <?php endif;?>" />
	        </div>
	        </a>
	        <div class="index-post">
	            <!--<a class="more" href="<?php $this->permalink() ?>">更多 ></a>-->
			<h2 class="index-post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
			<ul class="post-meta">
				<li itemprop="author" itemscope itemtype="http://schema.org/Person"><?php _e('作者: '); ?><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></li>
				<li><?php _e('时间: '); ?><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
				<li><?php _e('分类: '); ?><?php $this->category(','); ?></li>
				<li itemprop="interactionCount">
				    <a itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments">
				        <?php $this->commentsNum('评论', '1 条评论', '%d 条评论'); ?>
				        
				    </a>
				</li>
			</ul>
			
            <div class="post-content" itemprop="articleBody">
    			<?php $this->excerpt(200,'....'); ?>
            </div>
            
            </div>
        </article>
	<?php endwhile; ?>

    <?php $this->pageNav('前一页', '后一页'); ?>
</div><!-- end #main-->
<?php endif; ?>

<?php if(isMobile()):?>
<?php while($this->next()): ?>
    <article class="card" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="card-head">
            <img src="<?php _e('https://gravatar.loli.net/avatar/'.md5($this->author->mail))?>" />
        </div>
        <div class="card-name">
            <span><?php $this->author(); ?></span>
        </div>
        <div class="card-title">
            <a href="<?php $this->permalink() ?>"><span><?php $this->title() ?></span></a>
        </div>
        <a href="<?php $this->permalink() ?>">
        <div class="card-thumb">
            <img src="<?php if ($this->fields->thumb): ?>
	        <?php $this->fields->thumb();?>
	        <?php else:?>
	        https://img.menhood.wang/i/2020/02/11/krwtlq.jpg
	        <?php endif;?>" />
        </div>
        </a>
        <div class="card-desc">
            <?php $this->excerpt(30,'....'); ?>
        </div>
            <ul class="card-meta">
                <li class="card-time" ><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
				<li class="card-category" >&nbsp;·&nbsp;<?php $this->category(','); ?></li>
				<li class="card-comment" itemprop="interactionCount">
				    <a itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments">
				        <i class="fa fa-comment-o"></i><?php $this->commentsNum(' ', '  1 ', '  %d '); ?>
				    </a>
				</li>
            </ul>
    </article>
<?php endwhile; ?>
<?php endif; ?>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
