<?php

Class UrlInfo {
    public $url;
    public $isValid;

    function validateUrl()
	{
	    $this->url = $_POST['url'];
	    if (!preg_match('/http(s?)\:\/\//i', $this->url)) {
	        $this->url = "http://" . $this->url;
	    }

	    if(preg_match('/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i', $this->url)) {
	        $url_array = parse_url($this->url );
	        $this->url = $url_array["scheme"] . "://" . $url_array["host"];
	        $this->isValid = true;
	    } else {
	        $this->isValid = false;
	    }

	    return $this;
	}
}