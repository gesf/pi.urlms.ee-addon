<?php

/*
========================================================
URL Shortening Plugin
--------------------------------------------------------
Copyright: Gonçalo Fontoura
License:   Freeware
http://gesf.org
--------------------------------------------------------
This addon may be used free of charge
========================================================
File: pi.urlms.php
--------------------------------------------------------
Purpose: Short long URLs
========================================================
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF
ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT 
LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO 
EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE
FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN
AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE 
OR OTHER DEALINGS IN THE SOFTWARE.
========================================================
*/

$plugin_info = array(
	'pi_name'		=> 'URL Made Simple',
	'pi_version'		=> '1.0',
	'pi_author'		=> 'Gonçalo Fontoura',
	'pi_author_url'		=> 'http://gesf.org',
	'pi_description'	=> 'Short long URLs',
	'pi_usage'		=> URLMS::usage()
);

class URLMS {
	
	var $return_data;
	
	// ----------------------------------------
	//  Plugin Usage
	// ----------------------------------------
	
	function URLMS($url = '') {

		global $TMPL;
		if($url == '') { $url = $TMPL->tagdata; }
		$url = str_replace(SLASH, '/', $url);
		$url = trim($url);
		
		$custom = ($TMPL->fetch_param('pointer'));
		$preview = ($TMPL->fetch_param('preview'));
		
		$post  = "url=" . rawurlencode($url);
		$post .= ($custom) ? "&pointer=" . rawurlencode($custom) : '';
		$post .= ($preview) ? "&preview=" . $preview : '';
		$post .= "&result=plain";
		
		$api = "http://api.urlms.com/";
		
		$session = curl_init($api);
		curl_setopt($session, CURLOPT_URL, $api);
		curl_setopt($session, CURLOPT_HEADER, 0);
		curl_setopt($session, CURLOPT_POST, 1);
		curl_setopt($session, CURLOPT_POSTFIELDS, $post);
		curl_setopt($session, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($session);
		curl_close($session);
		$this->return_data = $data;
		
	}
    
	// ----------------------------------------
	//  Plugin Usage
	// ----------------------------------------

	function usage() {
		ob_start(); 
?>
Returns a short version of a given URL using urlms.com service API.

Tag:
-----------

{exp:urlms}{/exp:urlms}

Parameters:
-----------

pointer="foo"
You can use a custom pointer, instead of the ones automatically generate by urlms.com. E.g: http://urlms.com/foo

preview="yes|no"
You can choose whether or not your short URL will instantly redirect to its destination, or a page with information about the destination URL will be shown before redirecting.

Example:
----------------

{exp:urlms}www.expressionengine.com{/exp:urlms}

Returns: http://urlms.com/SdH

{exp:urlms preview="yes"}www.expressionengine.com{/exp:urlms}

Returns: http://urlms.com/mOX

{exp:urlms pointer="ellislab"}http://ellislab.com/{/exp:urlms}

Returns: http://urlms.com/ellislab

{exp:urlms pointer="enginehosting" preview="yes"}http://www.enginehosting.com/{/exp:urlms}

Returns: http://urlms.com/enginehosting
<?php

	$buffer = ob_get_contents();
	ob_end_clean(); 
	return $buffer;
	
	}
}
// END CLASS

?>
