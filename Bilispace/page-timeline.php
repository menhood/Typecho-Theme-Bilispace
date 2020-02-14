<?php
/**
* Template Page of Timeline Archives
*
* @package custom
*/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;?>
<?php $this->need('header.php'); ?>

<div class="main" id="main" role="main" >
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <h1 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <div class="post-content" itemprop="articleBody">
                                              <article class="post">
                                                <?php
    $stat = Typecho_Widget::widget('Widget_Stat');
    $this->widget('Widget_Contents_Post_Recent', 'pageSize='.$stat->publishedPostsNum)->to($archives);
    $year=0; $mon=0; $i=0; $j=0;
    $output = '<div class="categorys-item">';
    while($archives->next()){
        $year_tmp = date('Y',$archives->created);
        $mon_tmp = date('m',$archives->created);
        $y=$year; $m=$mon;
        if ($year > $year_tmp || $mon > $mon_tmp) {
            $output .= '</div></div>';
        }
        if ($year != $year_tmp || $mon != $mon_tmp) {
			 $year = $year_tmp;
			 $mon = $mon_tmp;
			 $output .= '<div class="categorys-title"  onclick="pltoggle(\'pl'.$archives->cid.'\')"><strong style="color:#00a1d6">[ </strong>'.date('Y年m月',$archives->created).'<strong style="color:#00a1d6"> ] </strong></div><div class="post-lists" id="pl'.$archives->cid.'"><div class="post-lists-body">';
        }
        $output .= '<div class="post-list-item" ><div class="post-list-item-container"><div class="item-label"><div class="item-title"><a href="'.$archives->permalink .'">'. $archives->title .'</a></div><div class="item-meta clearfix"><div class="item-meta-date"> '.date('Y-m-j',$archives->created).' </div></div></div></div></div>';
    }
    $output .= '</div></div></div>';
    echo $output;
    ?>
                                            
                                    </article>  
        </div>
    </article>
    <?php $this->need('comments.php'); ?>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>