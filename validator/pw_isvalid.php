<?php//FIXME Create an class Validator... No globals!//TODO Write test cases!$PW_REGEXP['URL'] = array('URL1', 'URL2', 'URL_MAILTO', 'URL_IPv6');$validchars = '[a-zA-Z0-9-\._~:/\?\#@!%$&\'\(\)\*\+\,\;\=]';$PW_REGEXP['URL1'] = "#(^|[\n ])((https?|ftp)?://" . $validchars . "+$)#is";$PW_REGEXP['URL2'] = '#(^|[\n ])((www|ftp)\.' . $validchars . '+\.[\w\-.\~]+$)#is';$PW_REGEXP['URL_MAILTO'] = "#(^|[\n ])(mailto:[a-zA-Z0-9_]" . $validchars . "+$)#is";$PW_REGEXP['URL_IPv6'] = '#(^|[\n ])((https?|ftp)?://\[[a-fA-F0-9:\.]*\]' . $validchars . "*$)#is";$PW_REGEXP['EMAIL'] = '#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i';//TODO Write a test with several inputs that can be extended...$PW_REGEXP['FILENAME'] = '#^[^/?*:<>\\\n\t\r]+$#i';	function pw_isvalid($data, $for) {    global $PW_REGEXP;    $regexp = $PW_REGEXP[$for];    if (!isset($regexp)) {        throw new Exception("pw_regexp_check: $for is not set in the global PW_REGEXP-array!");    }    if (is_array($regexp)) {        foreach ($regexp as $k => $r) {            if (!isset($PW_REGEXP[$r])) {                throw new Exception("pw_regexp_check: $r is not set in the global PW_REGEXP-array!");            }            // Names in the array are connected with "OR", so if one matches the result is true!            if (preg_match($PW_REGEXP[$r], $data)) {                return true;            }        }        return false;    }    if (preg_match($regexp, $data)) {        return true;    }    return false;}function pw_isvalid_url($url) {    return pw_isvalid($url, 'URL');}function pw_isvalid_mail($adress) {    return pw_isvalid($adress, 'EMAIL');}function pw_isvalid_filename($filename) {	return pw_isvalid($filename, 'FILENAME');}?>