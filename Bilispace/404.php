<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

    <div class="error404">

        <div class="error-page">
            <h2 class="post-title">404 - <?php _e('页面没找到'); ?></h2>
            <p><?php _e('你想查看的页面已被转移或删除了, 要不要搜索看看: '); ?></p>
            <form method="post">
                <p><input type="text" name="s" class="text" autofocus />
                <button type="submit" class="submit btn"><?php _e('搜索'); ?></button></p>
                <!--标签云-->
                <?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=30')->to($tags); ?>
                <div class="tags-list">
                <?php while($tags->next()): ?>
                    <a href="<?php $tags->permalink(); ?>" title='<?php $tags->name(); ?>'><?php $tags->name(); ?></a>
                <?php endwhile; ?>
                </div>  
            </form>
        </div>

    </div><!-- end #content-->
	<?php $this->need('footer.php'); ?>
