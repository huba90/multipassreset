<?php 
/*==========================================================================================
= Felelős a felhasználó nevek ID megszerzéséről és új jelszó meghatározásáról              =
============================================================================================*/
	
class MULTIPASSRESET{

	/*----------  Wordpress Multisite Felhasználó ID'k beszerzés  ----------*/

	public function get_all_user_ids(){
		global $wpdb;
		
		$allusers = $wpdb->get_results("SELECT ID FROM $wpdb->users");
		$user_ids = array();
		foreach ( $allusers as $u ) {
			$user_ids[] = $u->ID;
		}
		return $user_ids;
	}

	/*---------- Felelős a jelszavak újrairásáról  ----------*/

	public function reset_all_users_password(){
		//ID'k megszerzése 
		$array_of_user_ids = $this->get_all_user_ids();

		foreach ($array_of_user_ids as $user_id) {
			//A fő tulajdonos filterezése
			if(!is_super_admin($user_id)){
				//Új jelszó generálása minden felhasználónak
				$password = wp_generate_password();
				//Jelszavak cseréje az új jelszóra
				wp_set_password($password, $user_id);
			}
		}
		print('All done!');
	}

}