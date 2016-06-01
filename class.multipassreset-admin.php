<?php
/*==========================================================================================
= Felelős az Admin kezelő oldal funkciójairól és szükséges kódok regisztrációjáról         =
============================================================================================*/
	class MPR_OPTIONS{
		/*----------  Menűpont és ajax hivás regisztrációja  ----------*/
		function __construct(){
			if(is_multisite()){
				add_action('network_admin_menu', array($this, 'init_sub_menu_network'));
			} else {
				add_action('admin_menu', array($this, 'init_sub_menu'));
				add_action( 'wp_ajax_mpr_reset_all_pass', array($this,'mpr_reset_all_pass_cb'));
			}
		}
		/*----------  Js file regisztráció funkciója  ----------*/
		public function add_admin_scripts(){
			wp_enqueue_script( 'mpr_global', plugins_url( 'js/global.js' , __FILE__ ),'',  false, false);
		}
		/*----------  Menüpont regisztráció funkciója  ----------*/
		public function init_sub_menu(){
			add_submenu_page( 'options-general.php', 'Multipass Reset Settings', 'Multipass Reset Settings', 'administrator', 'mpreset', array($this, 'settings'));
		}
		/*----------  Menüpont Multisite regisztráció funkciója  ----------*/
		public function init_sub_menu_network(){
			add_submenu_page( 'settings.php', 'Multipass Reset Settings', 'Multipass Reset Settings', 'administrator', 'mpreset', array($this, 'settings'));
		}
		/*----------  Menüpont tartalmai  ----------*/		
		public function settings(){
			?>
			<div class='wrap'>
		          <h2>Settings</h2>
		          <form method='post' action='options.php'>
		          	   <div class="success-message-wrapper">
		          	   	<img style="display: none;margin: 47px;height: 42px;" src="<?php echo plugins_url('imgs/preloader.gif', __FILE__); ?>" id="mprpreloader" alt="">
		          	   </div>
		               <p class='submit'>
		                    <input name='submit' type='submit' id='submit-mpr' class='button-primary' value='<?php _e("Reset All Passwords"); ?>' />
		               </p>
		          </form>
		     </div>
		     <?php
		}
		/*----------  Ajax Funkció kezelője  ----------*/
		public function mpr_reset_all_pass_cb(){
			$passreset = new MULTIPASSRESET();
			$passreset->reset_all_users_password();
			die();
		}

	}
?>