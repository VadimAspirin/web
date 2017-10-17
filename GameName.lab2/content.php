<?php

class Content
{
	private static $pages = [
							1=>'./assets/start.html',
							2=>'./assets/about.html',
							3=>'./assets/top_list.html'
							];
	public static function getPage($numberPage)
	{
		if(!array_key_exists($numberPage, Content::$pages))
			return false;
		
		if(!$page = file_get_contents(Content::$pages[$numberPage]))
			return false;
		return $page;	
	}
}

?>
