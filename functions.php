<?php
function cg_cf_cookie_bar(){
    $text = get_option('cg_cf_text');
    ?>
        <div id="cg_cookie_bar" class="<?php echo cg_cf_is_exception() ? 'exception' : '' ?>" data-timeout="<?php cg_cf_timeout();?>" data-scrollout="<?php cg_cf_scrollout();?>">
            <span class="close">&times;</span>
            <?php echo $text; ?>
        </div>
        <style>
            <?php echo file_get_contents(dirname(__FILE__).'/style.css')?>
        </style>
    <?php
}

function cg_cf_code_templates(){
    $replace = array(
        'from'  => array('/*',  '*/',   '</script'),
        'to'    => array('/!*', '*!/',  '<!/script')
    );

    echo '<script type="text/template" id="cg_cf_head_template_accepted">/*!* ';
        echo str_replace($replace['from'],$replace['to'],cg_cf_get_head_accepted());
    echo ' *!*/</script>';
    echo '<script type="text/template" id="cg_cf_head_template_denied">/*!* ';
        echo str_replace($replace['from'],$replace['to'],cg_cf_get_head_denied());
    echo ' *!*/</script>';
    echo '<script type="text/template" id="cg_cf_foot_template_accepted">/*!* ';
        echo str_replace($replace['from'],$replace['to'],cg_cf_get_foot_accepted());
    echo ' *!*/</script>';
    echo '<script type="text/template" id="cg_cf_foot_template_denied">/*!* ';
        echo str_replace($replace['from'],$replace['to'],cg_cf_get_foot_denied());
    echo ' *!*/</script>';
}

function cg_cf_get_head_accepted(){
    $code = get_option('cg_cf_head_accepted_code');
    return $code;
}

function cg_cf_get_head_denied(){
    $code = get_option('cg_cf_head_denied_code');
    return $code;
}

function cg_cf_get_foot_accepted(){
    $code = get_option('cg_cf_foot_accepted_code');
    return $code;
}

function cg_cf_get_foot_denied(){
    $code = get_option('cg_cf_foot_denied_code');
    return $code;
}

function cg_cf_get_timeout(){
    $timeout = (int)get_option('cg_cf_accept_timeout');
    return $timeout;
}
function cg_cf_timeout(){
    echo cg_cf_get_timeout();
}

function cg_cf_get_scrollout(){
    $scrollout = (int)get_option('cg_cf_accept_scrollout');
    return $scrollout;
}
function cg_cf_scrollout(){
    echo cg_cf_get_scrollout();
}

function cg_cf_get_exceptions(){
    $items = explode(',',get_option('cg_cf_exception_pages'));
    for ($i = 0; $i < count($items); $i++){
        $items[$i] = trim($items[$i]);
    }
    return $items;
}

function cg_cf_is_exception(){
    $return = false;

    $exceptions = cg_cf_get_exceptions();
    $obj = get_queried_object();
    if ($obj && (
            (isset($obj->post_name) && in_array($obj->post_name,$exceptions))
            ||
            (isset($obj->ID) && in_array($obj->ID,$exceptions))
            ||
            (isset($obj->post_title) && in_array($obj->post_title,$exceptions))
        )
    ){
        $return = true;
    }
    return $return;
}

?>
