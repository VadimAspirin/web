<?php

class Menu
{
	private static $items = [
							1 => 'Start', 
							2 => 'About', 
							3 => 'Top List'
							];
	public static function renderMenu($numberItem)
	{
		if(!array_key_exists($numberItem, Menu::$items))
			return false;
		
		$menu = '<header class="main-menu">
					<ul>
						<li><a href="index.php?page=1"><img class="main-page" src="./img/logo.png"></a></li>
						<li><a href="index.php?page=1">Start</a></li>
						<li><a href="index.php?page=2">About</a></li>
						<li><a href="index.php?page=3">Top List</a></li>
					</ul>
				</header>';
		$itemPos = mb_stripos($menu, Menu::$items[$numberItem]);
		$substrBuf = mb_substr($menu, 0, mb_strripos(mb_substr($menu, 0, $itemPos), "href"));
		$menu = str_replace($substrBuf, $substrBuf . 'class="active" ', $menu);
		
		return $menu;
	}
}

?>
