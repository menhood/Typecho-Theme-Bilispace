<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>


<div id="comments">
    <style>
        .linktext:focus{width:200px;}.post-content{clear: both;}
    </style>
    <h3 id="response"><?php _e('申请友链');
        ?></h3>
    <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
        <div id="guestinfo" class="guest-info" style="<?php echo $guestinfo ?>">
            <p>
                <label for="author" class="required"><?php _e('称呼');
                    ?></label>
                <input type="text" name="author" id="author" class="linktext" placeholder=" 显示的名字" value="<?php $this->remember('author');
                ?>" required />
            </p>
            <p>
                <label for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif;
                    ?>><?php _e('邮箱');
                    ?></label>
                <input type="email" name="mail" id="mail" class="linktext" placeholder=" 头像将使用Gravatar" value="<?php $this->remember('mail');
                ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif;
                ?> />
            </p>
            <p>
                <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif;
                    ?>><?php _e('网站');
                    ?></label>
                <input type="url" name="url" id="url" class="linktext" placeholder="<?php _e(' http://orhttps:// 点击后访问的链接');
                ?>" value="<?php $this->remember('url');
                ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif;
                ?> />
            </p>
        </div>
            <div class="user-face">
                <img id="userface" src="<?php if ($this->user->hasLogin()): ?><?php _e('https://gravatar.loli.net/avatar/'.md5($this->author->mail))?><?php elseif ($this->remember('mail',true)): _e('https://gravatar.loli.net/avatar/'.md5($this->remember('mail',true)));
                else :_e('https://i.loli.net/2018/10/28/5bd55579d2d72.png')?><?php endif;
                ?>" />
            </div>
            <textarea rows="8" cols="50" name="text" id="textarea" class="textarea" placeholder=" 请填写站点的简介，如果使用另外的图像请在此备注" required><?php $this->remember('text');
                ?></textarea>
                <div id="OwO" class="OwO" style="display:none"></div>
            <button type="submit" class="comment-submit"><?php _e('提交申请');
                ?></button>
    </form>
</div>