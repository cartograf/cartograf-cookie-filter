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
			'Here you can introduce the message you want to show to your visitors to inform about cookie usage.',
			'cg_cf_text',
			'cg_cf_options_form',
			'cg_cf_main_config'
		);

		add_settings_field('cg_cf_head_accepted_code',
			'Code to insert in head when the user has accepted cookies (Analytics code)',
			'cg_cf_head_accepted_code',
			'cg_cf_options_form',
			'cg_cf_main_config'
		);
		add_settings_field('cg_cf_foot_accepted_code',
			'Code to insert in foot when the user has accepted cookies (Analytics code)',
			'cg_cf_foot_accepted_code',
			'cg_cf_options_form',
			'cg_cf_main_config'
		);

		add_settings_field('cg_cf_head_denied_code',
			'Code to insert in head when the user has not accepted cookies yet',
			'cg_cf_head_denied_code',
			'cg_cf_options_form',
			'cg_cf_main_config'
		);
		add_settings_field('cg_cf_foot_denied_code',
			'Code to insert in foot when the user has not accepted cookies yet',
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
		echo '<div style="display: block; float: right; max-width: 20%; width: 350px; padding: 10px; position: fixed; right: 0; background: #fff; text-align: center;" class="options right"><img src="' . plugins_url('cartograf-cookie-filter') . '/logo-cartograf.png' . '" /><p>';
		_e('The development of <a href="http://www.cartograf.net/plugin-wordpress-cumplir-ley-de-cookies-espana?utm_source=opcionesplugin&utm_medium=pluginwordpress&utm_campaign=cookiefilter">this plugin</a> is sponsored by <a target="_blank" href="http://www.cartograf.net/?utm_source=opcionesplugin&utm_medium=pluginwordpress&utm_campaign=cookiefilter">Cartograf</a>');
		echo '</p></div>
				<div class="options left">';
		_e('Remember, clicking on any link on the page will ACCEPT cookies automatically.<br />
			To avoid this behaviour on some links add "<strong>no-cookie-accept</strong>" class to any desired link tag so the plugin can make an exception of them.');
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
                        <div class="tip"><?php _e('SECONDS TO WAIT before accept COOKIES automatically. Set to a very huge value to prevent cookie acceptance by letting the tab open.')?></div>
		<?php
	}

	function cg_cf_accept_scrollout(){
		$scrollout = cg_cf_get_scrollout();
		?>
			<input type="number" name="cg_cf_accept_scrollout" value="<?php echo $scrollout?>" />
                        <div class="tip"><?php _e('PIXELS TO SCROLL before accept COOKIES automatically. Set to a very huge value to prevent cookie acceptance by scrolling.')?></div>
		<?php
	}

	function cg_cf_exception_pages(){
		$exceptions = get_option('cg_cf_exception_pages');
		?>
			<textarea name="cg_cf_exception_pages"><?php echo $exceptions?></textarea>
                        <div class="tip"><?php _e('Comma separated list of IDs, slugs or titles of pages or posts on which COOKIES won\'t be accepted on scroll or timeout')?></div>
                        
                        
         </div>
		<?php //this last div is needed to close the container
	}
?>
