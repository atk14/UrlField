<?php
class TcUrlField extends TcBase {

	function test(){
		$this->field = new UrlField();

		foreach(array(
			"https://www.atk14.net" => "https://www.atk14.net/",
			"www.atk14.net/about" => "http://www.atk14.net/about",
			"www.atk14.net" => "http://www.atk14.net/",
			
			"https://username:password@www.atk14.net/" => "https://username:password@www.atk14.net/",
			"username:password@www.atk14.net/" => "http://username:password@www.atk14.net/",
		) as $url => $expected_url){
			$cleaned_url = $this->assertValid($url);
			$this->assertEquals($expected_url,$cleaned_url);
		}

		foreach(array(
			"###",
			"::@www.atk14.net",
		) as $url){
			$err_msg = $this->assertInvalid($url);
			$this->assertEquals("This doesn't look like an URL",$err_msg);
		}
	}
}
