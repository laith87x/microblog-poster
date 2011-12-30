<?php

add_action('admin_menu', 'microblogposter_settings');

function microblogposter_settings()
{
    
    add_submenu_page('options-general.php', 'MicroblogPoster Options', 'MicroblogPoster', 'administrator', 'microblogposter.php', 'microblogposter_settings_output');
    
}

function microblogposter_settings_output()
{
    //Options names
    
    $bitly_api_user_name = "microblogposter_plg_bitly_api_user";
    $bitly_api_key_name = "microblogposter_plg_bitly_api_key";
    
    $twitter_consumer_key_name = "microblogposter_plg_twitter_consumer_key";
    $twitter_consumer_secret_name = "microblogposter_plg_twitter_consumer_secret";
    $twitter_access_token_name = "microblogposter_plg_twitter_access_token";
    $twitter_access_token_secret_name = "microblogposter_plg_twitter_access_token_secret";
    
    $plurk_consumer_key_name = "microblogposter_plg_plurk_consumer_key";
    $plurk_consumer_secret_name = "microblogposter_plg_plurk_consumer_secret";
    $plurk_access_token_name = "microblogposter_plg_plurk_access_token";
    $plurk_access_token_secret_name = "microblogposter_plg_plurk_access_token_secret";
    
    
    $bitly_api_user_value = get_option($bitly_api_user_name, "");
    $bitly_api_key_value = get_option($bitly_api_key_name, "");
    
    $twitter_consumer_key_value = get_option($twitter_consumer_key_name, "");
    $twitter_consumer_secret_value = get_option($twitter_consumer_secret_name, "");
    $twitter_access_token_value = get_option($twitter_access_token_name, "");
    $twitter_access_token_secret_value = get_option($twitter_access_token_secret_name, "");
    
    $plurk_consumer_key_value = get_option($plurk_consumer_key_name, "");
    $plurk_consumer_secret_value = get_option($plurk_consumer_secret_name, "");
    $plurk_access_token_value = get_option($plurk_access_token_name, "");
    $plurk_access_token_secret_value = get_option($plurk_access_token_secret_name, "");
    
    if(isset($_POST["update_options"]))
    {
        
        $bitly_api_user_value = $_POST[$bitly_api_user_name];
        $bitly_api_key_value = $_POST[$bitly_api_key_name];
        
        $twitter_consumer_key_value = $_POST[$twitter_consumer_key_name];
        $twitter_consumer_secret_value = $_POST[$twitter_consumer_secret_name];
        $twitter_access_token_value = $_POST[$twitter_access_token_name];
        $twitter_access_token_secret_value = $_POST[$twitter_access_token_secret_name];
        
        $plurk_consumer_key_value = $_POST[$plurk_consumer_key_name];
        $plurk_consumer_secret_value = $_POST[$plurk_consumer_secret_name];
        $plurk_access_token_value = $_POST[$plurk_access_token_name];
        $plurk_access_token_secret_value = $_POST[$plurk_access_token_secret_name];
        
        update_option($bitly_api_user_name, $bitly_api_user_value);
        update_option($bitly_api_key_name, $bitly_api_key_value);
        
        update_option($twitter_consumer_key_name, $twitter_consumer_key_value);
        update_option($twitter_consumer_secret_name, $twitter_consumer_secret_value);
        update_option($twitter_access_token_name, $twitter_access_token_value);
        update_option($twitter_access_token_secret_name, $twitter_access_token_secret_value);
        
        update_option($plurk_consumer_key_name, $plurk_consumer_key_value);
        update_option($plurk_consumer_secret_name, $plurk_consumer_secret_value);
        update_option($plurk_access_token_name, $plurk_access_token_value);
        update_option($plurk_access_token_secret_name, $plurk_access_token_secret_value);
        
        ?>
        <div class="updated"><p><strong>Options saved.</strong></p></div>
        <?php
        
    }
    
    ?>
    <div class="wrap">
    <div id="icon-plugins" class="icon32"><br /></div>
    <h2>MicroblogPoster Settings</h2>
    <form name="options_form" method="post" action="">
        <table class="form-table">
            <tr>
                <td colspan="2">
                    <h3>Your Bitly Credentials: <span class="description">Help: Search for 'bitly api key'</span></h3>
                    
                </td>
            </tr>
            <tr>
                <td>Bitly API User:</td>
                <td><input type="text" id="<?php echo $bitly_api_user_name;?>" name="<?php echo $bitly_api_user_name;?>" value="<?php echo $bitly_api_user_value;?>" size="30" /></td>
            </tr>
            <tr>
                <td>Bitly API Key:</td>
                <td><input type="text" id="<?php echo $bitly_api_key_name;?>" name="<?php echo $bitly_api_key_name;?>" value="<?php echo $bitly_api_key_value;?>" size="30" /></td>
            </tr>
            
            <tr>
                <td colspan="2"><h3>Your Twitter OAuth Credentials: <span class="description">Help: Search for 'create an application twitter api'</span></h3></td>
            </tr>
            <tr>
                <td>Consumer Key:</td>
                <td>
                    <input type="text" id="<?php echo $twitter_consumer_key_name;?>" name="<?php echo $twitter_consumer_key_name;?>" value="<?php echo $twitter_consumer_key_value;?>" size="45" />
                    <span class="description">Your Twitter Application Consumer Key.</span>
                </td>
            </tr>
            <tr>
                 <td>Consumer Secret:</td>
                <td>
                    <input type="text" id="<?php echo $twitter_consumer_secret_name;?>" name="<?php echo $twitter_consumer_secret_name;?>" value="<?php echo $twitter_consumer_secret_value;?>" size="45" />
                    <span class="description">Your Twitter Application Consumer Secret.</span>
                </td>
            </tr>
            <tr>
                 <td>Access Token:</td>
                <td>
                    <input type="text" id="<?php echo $twitter_access_token_name;?>" name="<?php echo $twitter_access_token_name;?>" value="<?php echo $twitter_access_token_value;?>" size="45" />
                    <span class="description">Your Twitter Account Access Token</span>
                </td>
            </tr>
            <tr>
                 <td>Access Token Secret:</td>
                <td>
                    <input type="text" id="<?php echo $twitter_access_token_secret_name;?>" name="<?php echo $twitter_access_token_secret_name;?>" value="<?php echo $twitter_access_token_secret_value;?>" size="45" />
                    <span class="description">Your Twitter Account Access Token Secret</span>
                </td>
            </tr>
            
            <tr>
                <td colspan="2"><h3>Your Plurk OAuth Credentials: <span class="description">Help: Search for 'create an application plurk api'</span></h3></td>
            </tr>
            <tr>
                <td>Consumer Key:</td>
                <td>
                    <input type="text" id="<?php echo $plurk_consumer_key_name;?>" name="<?php echo $plurk_consumer_key_name;?>" value="<?php echo $plurk_consumer_key_value;?>" size="45" />
                    <span class="description">Your Plurk Application Consumer Key.</span>
                </td>
            </tr>
            <tr>
                 <td>Consumer Secret:</td>
                <td>
                    <input type="text" id="<?php echo $plurk_consumer_secret_name;?>" name="<?php echo $plurk_consumer_secret_name;?>" value="<?php echo $plurk_consumer_secret_value;?>" size="45" />
                    <span class="description">Your Plurk Application Consumer Secret.</span>
                </td>
            </tr>
            <tr>
                 <td>Access Token:</td>
                <td>
                    <input type="text" id="<?php echo $plurk_access_token_name;?>" name="<?php echo $plurk_access_token_name;?>" value="<?php echo $plurk_access_token_value;?>" size="45" />
                    <span class="description">Your Plurk Account Access Token</span>
                </td>
            </tr>
            <tr>
                 <td>Access Token Secret:</td>
                <td>
                    <input type="text" id="<?php echo $plurk_access_token_secret_name;?>" name="<?php echo $plurk_access_token_secret_name;?>" value="<?php echo $plurk_access_token_secret_value;?>" size="45" />
                    <span class="description">Your Plurk Account Access Token Secret</span>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="update_options" class="button-primary" value="Update Options" />
        </p>
    </form>
    </div>
    <?php
    
}
?>