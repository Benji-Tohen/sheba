<?php
//$fbAction=new FacebookActions();
//echo $fbAction->doWallPost("130685270331125", 'CAACEdEose0cBAGLV7XRvSFv9dmYVOl1lGILwfZAMyp7JNZCO94FRvSBN1OseYZA2zwad3VpC0OIrZAVhPnULSyFCy0s55MPF0iCeipkdOufVnZC7FzQkwwGDJ2cmTMddl1ZCiLoaZBLBpUihL91gHzWLyFcwZCfQgzIIud8gkzZBmeeHkW0t30WccqsFyFLq7TGIZD', 'The Name','The Message','http://www.tohen-media.com','The Caption','The Description');

class FacebookActions{
	//	TODO: Change the number 130685270331125 with the number of your page
	//	current test page: https://www.facebook.com/pages/דף-נחיתה-לפייסבוק/130685270331125
	//var $FB_PAGE_ID='130685270331125';

	//TODO:	Get this from here (Change the number 130685270331125 with the number of your page): https://developers.facebook.com/tools/explorer/?method=GET&path=130685270331125%3Ffields%3Daccess_token&
	//	1. get token/get access token on the right
	//	2. go to Extended Permissions tab
	//	3. choose: manage_pages,publish_actions 
	//	4. press Get Access Token
	//	5. press Okay on the opened window
	//	6. Choose Public
	//	7. press Okay
	//	8. press Okay
	//	9. press Submit
	//	10. take the access_token from the gray window below (not the one on top) and put it here
	//	11. Pray!
	//var $FB_ACCESS_TOKEN="CAACEdEose0cBAJ4zqQ5eIibT2MZANSpy2XZCO1KHEVjXtKBa3weK97yOm3FsX2UqqTuYBptjMjuWKvzYOeRDWsZBTOyQ0UNlZC9wdKosDsV6uegMQNpMDlZCuawGY9gOcOOZAHermvb4FKqqhTdSgMdeZCRg52jKXUIObR7o8k2wUj5G62nR5PUxEpSkGJqlO8ZD";
	
	function doWallPost($FB_PAGE_ID='', $FB_ACCESS_TOKEN='', $postName='',$postMessage='',$postLink='',$postCaption='',$postDescription=''){
		$url = "https://graph.facebook.com/".$FB_PAGE_ID."/feed";
		$attachment =  array(   'access_token'  => $FB_ACCESS_TOKEN,                        
			    'name'          => $postName,
			    'link'          => $postLink,
			    'description'   => $postDescription,
			    'message'       => $postMessage,
			    'caption'       => $postCaption,
			);
                //print_r($attachment);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,2);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
		$result=curl_exec($ch);
		header('Content-type:text/html');
		curl_close($ch);

		return $result;
	}
	
}
?>
