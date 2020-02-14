<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php function threadedComments($comments, $options) {
    $commentClass = '';
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    $depth = $comments->levels +1;
    ?>
    <li id="li-<?php $comments->theId();?>" class="comment-body<?php
        if ($depth == 2) {echo ' comment-child';$comments->levelsAlt(' comment-level-2', ' comment-level-even');
        } else {echo ' comment-parent';}
        $comments->alt(' comment-odd', ' comment-even');
        echo $commentClass;
        ?>">
            <div class="comment-item" id="<?php $comments->theId();?>">
                    <div class="comment-avatar" >
                        <?php $comments->gravatar('40', 'https://i.loli.net/2018/10/28/5bd55579d2d72.png');?>
                    </div>
                    <div class="comment-container">
                            <span class="comment-name" >
                                    <?php if ($comments->authorId == $comments->ownerId) {echo "<span class='author-after-text'>站长</span>";}?>
                                    <?php $comments->author();?>
                                    <?php if ($comments->authorId) {
                                            if ($comments->authorId == $comments->ownerId) {echo "<span style='display: inline-block;width: 19px;height: 9px;vertical-align: middle;margin: 0 8px;background:url(https://i.loli.net/2019/04/10/5cad67f8157f8.png) no-repeat -23px -604px'></span>";}
                                          }else{
                                            dengji($comments->mail);
                                        }
                                        
                                        ?>
                            </span>
                            <div class=" comment-content">
                                <?php get_comment_at($comments->coid);$comments->content();
                                ?>
                            </div>
                            <div class="comment-meta">
                                <a href="<?php $comments->permalink();?>">
                                    <span class="comment-floor">#&nbsp;<?php $comments->sequence();?>&nbsp;</span>
                                    <?php echo timesince($comments->created);?>
                                </a>
                                <span class="comment-reply"><?php $comments->reply();?></span>
                            </div>
                    </div>

                <?php if ($comments->children) { ?>
                    <div class="comment-children">
                        <?php $comments->threadedComments($options);?>
                    </div>
                    <?php } ?>
            </div>
    </li>
    <?php } ?>

<div id="comments">
    <?php $this->comments()->to($comments);
    ?>
    <?php if ($comments->have()): ?>
    <h3 id="comments-title" ><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论'));
        ?></h3>

    <?php $comments->listComments();
    ?>

    <?php $comments->pageNav(' 前一页', '后一页 ');
    ?>

    <?php endif;
    ?>

    <?php if ($this->allow('comment')): ?>
    <div id="<?php $this->respondId();
        ?>" class="respond">
        <div class="cancel-comment-reply">
            <?php $comments->cancelReply();
            ?>
        </div>

        <h3 id="response"><?php _e('添加新评论');
            ?><small>(点击头像可修改/隐藏信息框)</small></h3>
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if ($this->remember('author',true)): ?><?php $guestinfo = "display:none"?><?php else :?><?php $guestinfo = "display:block";
            ?><?php endif;
            ?>
            <?php if ($this->user->hasLogin()): ?>
            <p>
                <?php _e('登录身份: ');
                ?><a href="<?php $this->options->profileUrl();
                    ?>"><?php $this->user->screenName();
                    ?></a>. <a href="<?php $this->options->logoutUrl();
                    ?>" title="Logout"><?php _e('退出');
                    ?> &raquo;</a>
            </p>
            <?php else : ?>
            <div id="guestinfo" class="guest-info" style="<?php echo $guestinfo ?>">
                <script src="https://cdnjs.loli.net/ajax/libs/marked/0.6.2/marked.min.js"></script>
                <script>var rendererMD = new marked.Renderer();//预览</script>    
                    <input type="text" name="author" id="author" class="text" style="width:275px;margin:10px 0" placeholder="昵称*" value="<?php $this->remember('author');
                    ?>" required />
                
                    
                    <input type="email" name="mail" id="mail" class="text" style="width:275px;margin:10px <?php if (!isMobile()): ?>10px<?php else :?>0px<?php endif;?>" placeholder="邮箱*" value="<?php $this->remember('mail');
                    ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif;
                    ?> />
                
                    <br>
                    <input type="url" name="url" id="url" class="text" style="width:275px;margin:10px 0" placeholder="<?php _e('http://');
                    ?>" value="<?php $this->remember('url');
                    ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif;
                    ?> />
                    <div id="preview-box" class="preview-box" ></div>
            </div>
            <?php endif;
            ?>
                <div class="user-face">
                    <img id="userface" src="<?php if ($this->user->hasLogin()): ?><?php _e('https://gravatar.loli.net/avatar/'.md5($this->author->mail))?><?php elseif ($this->remember('mail',true)): _e('https://gravatar.loli.net/avatar/'.md5($this->remember('mail',true)));
                    else :_e('https://i.loli.net/2018/10/28/5bd55579d2d72.png')?><?php endif;
                    ?>">
                </div>
                
                <textarea rows="8" cols="50" name="text" id="textarea" class="textarea" required><?php $this->remember('text');
                    ?></textarea>
                    
                <button type="submit" class="comment-submit"><?php _e('提交评论');
                    ?></button>
                <div id="OwO" class="OwO"></div>
        </form>
    </div>
    <?php else : ?>
    <!--<h3><?php _e('评论已关闭');
    ?></h3>--><div id="OwO" style="display:none"></div>
    <?php endif;
    ?>
</div>