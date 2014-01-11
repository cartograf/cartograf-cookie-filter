<?php

	add_action('admin_menu', 'cg_cf_admin_menu');

	function cg_cf_admin_menu() {
		add_options_page('Cartograf Cookie-filter', 'Cartograf Cookie-filter Settings', 'manage_options', 'cg_cookie_filter', 'cg_cf_settings_page');
	}

	function cg_cf_settings_page(){
	?>
		<form method="POST" action="options.php">
		<?php
			settings_fields('cg_cf_options');
			do_settings_sections('cg_cf_options_form');
			submit_button();
		?>
		</form>
		<style>
			.radio-group {
				margin:0px;
			}
			textarea {
				width:450px;
				height:100px;
			}
			.form-table {
				clear:left;
				width:auto;
			}
                        .tip {
                            font-size:9px;
                            color:#999;
                        }
                </style>
	<?php
	}

	add_action( 'admin_init', 'cg_cf_admin_init' );

	function cg_cf_admin_init() {
		add_settings_section('cg_cf_main_config',
			'Cartograf Cookie-filter settings',
			'cg_cf_main_config_render',
			'cg_cf_options_form'
		);

		add_settings_field('cg_cf_text',
			'Text',
			'cg_cf_text',
			'cg_cf_options_form',
			'cg_cf_main_config'
		);

		add_settings_field('cg_cf_head_accepted_code',
			'Code to insert in head on accept COOKIES (Analytics code)',
			'cg_cf_head_accepted_code',
			'cg_cf_options_form',
			'cg_cf_main_config'
		);
		add_settings_field('cg_cf_foot_accepted_code',
			'Code to insert in foot on accept COOKIES (Analytics code)',
			'cg_cf_foot_accepted_code',
			'cg_cf_options_form',
			'cg_cf_main_config'
		);

		add_settings_field('cg_cf_head_denied_code',
			'Code to insert in head on deny',
			'cg_cf_head_denied_code',
			'cg_cf_options_form',
			'cg_cf_main_config'
		);
		add_settings_field('cg_cf_foot_denied_code',
			'Code to insert in foot on deny',
			'cg_cf_foot_denied_code',
			'cg_cf_options_form',
			'cg_cf_main_config'
		);

		add_settings_field('cg_cf_accept_timeout',
			'Timeout',
			'cg_cf_accept_timeout',
			'cg_cf_options_form',
			'cg_cf_main_config'
		);

		add_settings_field('cg_cf_accept_scrollout',
			'Scroll limit',
			'cg_cf_accept_scrollout',
			'cg_cf_options_form',
			'cg_cf_main_config'
		);

		add_settings_field('cg_cf_exception_pages',
			'Exception',
			'cg_cf_exception_pages',
			'cg_cf_options_form',
			'cg_cf_main_config'
		);

		register_setting( 'cg_cf_options', 'cg_cf_text');
		register_setting( 'cg_cf_options', 'cg_cf_head_accepted_code');
		register_setting( 'cg_cf_options', 'cg_cf_foot_accepted_code');
		register_setting( 'cg_cf_options', 'cg_cf_head_denied_code');
		register_setting( 'cg_cf_options', 'cg_cf_foot_denied_code');
		register_setting( 'cg_cf_options', 'cg_cf_accept_timeout');
		register_setting( 'cg_cf_options', 'cg_cf_accept_scrollout');
		register_setting( 'cg_cf_options', 'cg_cf_exception_pages');
	}

	function cg_cf_main_config_render($attr){
                _e('Cartograf Cookie-filter plugin\'s configuration. <br />Remember, click on any link on the page will accept COOKIES automatically. To avoid it on some links add "<strong>no-cookie-accept</strong>" class to the tag.');
	}


	function cg_cf_text(){
		$text = get_option('cg_cf_text');
		?>
			<textarea name="cg_cf_text"><?php echo $text?></textarea>
		<?php
	}
	function cg_cf_head_accepted_code(){
		$code = get_option('cg_cf_head_accepted_code');
		?>
			<textarea name="cg_cf_head_accepted_code"><?php echo $code?></textarea>
		<?php
	}
	function cg_cf_foot_accepted_code(){
		$code = get_option('cg_cf_foot_accepted_code');
		?>
			<textarea name="cg_cf_foot_accepted_code"><?php echo $code?></textarea>
		<?php
	}
	function cg_cf_head_denied_code(){
		$code = get_option('cg_cf_head_denied_code');
		?>
			<textarea name="cg_cf_head_denied_code"><?php echo $code?></textarea>
		<?php
	}
	function cg_cf_foot_denied_code(){
		$code = get_option('cg_cf_foot_denied_code');
		?>
			<textarea name="cg_cf_foot_denied_code"><?php echo $code?></textarea>
		<?php
	}


	function cg_cf_accept_timeout(){
		$timeout = cg_cf_get_timeout();
		?>
			<input type="number" name="cg_cf_accept_timeout" value="<?php echo $timeout?>" />
                        <div class="tip"><?php _e('SECONDS TO WAIT before accept COOKIES automatically')?></div>
		<?php
	}

	function cg_cf_accept_scrollout(){
		$scrollout = cg_cf_get_scrollout();
		?>
			<input type="number" name="cg_cf_accept_scrollout" value="<?php echo $scrollout?>" />
                        <div class="tip"><?php _e('PIXELS TO SCROLL before accept COOKIES automatically')?></div>
		<?php
	}

	function cg_cf_exception_pages(){
		$exceptions = get_option('cg_cf_exception_pages');
		?>
			<textarea name="cg_cf_exception_pages"><?php echo $exceptions?></textarea>
                        <div class="tip"><?php _e('Comma separated list of IDs, slugs or titles of pages or posts on which COOKIES won\'t be accepted on scroll or timeout')?></div>
		<?php
	}
?>
