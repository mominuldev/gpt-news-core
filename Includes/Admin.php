<?php

namespace GpTheme\GptNewsCore;

use GpTheme\GptNewsCore\Admin\Menu;
use GpTheme\GptNewsCore\Admin\PostType\Footer;


class Admin {


	public function __construct() {

		if ( is_admin() ) {
//			new Menu();
		}
	}
}