<?php
/**
 * 
 */

function load_credentials_from_file()
{
    // Get OAuth 2.0 credentials from auth_credentials.json file.
    $credentials = file_get_contents(dirname(__FILE__) . '/auth_credentials.json');
    if ($credentials===false) {
        die ("Couldn't read OAuth credentials from auth_credentials.json. Make sure " .
             "the file exists (if not, copy from auth_credentials.json.dist).");
    }

    $credentials = json_decode($credentials, true);
    if (!is_array($credentials)) {
        die ("Invalid auth credentials\n");    
    }

    // Try to read access_token.json and merge it with the rest of credentials.
    if (is_readable(dirname(__FILE__) . '/access_token.json')) {
        $accessToken = file_get_contents(dirname(__FILE__) . '/access_token.json');

        $accessToken = json_decode($accessToken, true);
        if (!is_array($accessToken)) {
            die ("Invalid access token format\n");    
        }

        $credentials = array_merge($credentials, $accessToken);
    }
    
    return $credentials;
}
