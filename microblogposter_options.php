<?php

add_action('admin_init', 'microblogposter_admin_init');
add_action('admin_menu', 'microblogposter_settings');

function microblogposter_admin_init()
{
    /* Register our script. */
    wp_register_script( 'microblogposter-fancybox-js-script', plugins_url('/fancybox/jquery.fancybox-1.3.4.pack.js', __FILE__) );
    wp_register_style( 'microblogposter-fancybox-css-script', plugins_url('/fancybox/jquery.fancybox-1.3.4.css', __FILE__) );
}

function microblogposter_settings()
{
    
    add_submenu_page('options-general.php', 'MicroblogPoster Options', 'MicroblogPoster', 'administrator', 'microblogposter.php', 'microblogposter_settings_output');
    
}

function microblogposter_settings_output()
{
    global  $wpdb;

    $table_accounts = $wpdb->prefix . 'microblogposter_accounts';
    
    //Options names
    $bitly_api_user_name = "microblogposter_plg_bitly_api_user";
    $bitly_api_key_name = "microblogposter_plg_bitly_api_key";
    
    
    $bitly_api_user_value = get_option($bitly_api_user_name, "");
    $bitly_api_key_value = get_option($bitly_api_key_name, "");
    
    
    if(isset($_POST["update_options"]))
    {
        $bitly_api_user_value = $_POST[$bitly_api_user_name];
        $bitly_api_key_value = $_POST[$bitly_api_key_name];
        
        update_option($bitly_api_user_name, $bitly_api_user_value);
        update_option($bitly_api_key_name, $bitly_api_key_value);
        
        ?>
        <div class="updated"><p><strong>Options saved.</strong></p></div>
        <?php
        
    }
    
    if(isset($_POST["new_account_hidden"]))
    {
        
        
        if(isset($_POST['account_type']))
        {
            $account_type = trim($_POST['account_type']);
            $wpdb->escape_by_ref($account_type);
        }
        if(isset($_POST['consumer_key']))
        {
            $consumer_key = trim($_POST['consumer_key']);
            $wpdb->escape_by_ref($consumer_key);
        }
        if(isset($_POST['consumer_secret']))
        {
            $consumer_secret = trim($_POST['consumer_secret']);
            $wpdb->escape_by_ref($consumer_secret);
        }
        if(isset($_POST['access_token']))
        {
            $access_token = trim($_POST['access_token']);
            $wpdb->escape_by_ref($access_token);
        }
        if(isset($_POST['access_token_secret']))
        {
            $access_token_secret = trim($_POST['access_token_secret']);
            $wpdb->escape_by_ref($access_token_secret);
        }
        if(isset($_POST['username']))
        {
            $username = trim($_POST['username']);
            $wpdb->escape_by_ref($username);
        }
        if(isset($_POST['password']))
        {
            $password = trim($_POST['password']);
            $wpdb->escape_by_ref($password);
        }
        
        $sql = "INSERT IGNORE INTO {$table_accounts} 
            (username,password,consumer_key,consumer_secret,access_token,access_token_secret,type,message_format,extra)
            VALUES
            ('$username','$password','$consumer_key','$consumer_secret','$access_token','$access_token_secret','$account_type','$message_format','$extra')";
        
        $wpdb->query($sql);
        //var_dump($_POST);
        ?>
        <div class="updated"><p><strong>Account added successfully.</strong></p></div>
        <?php
    }
    
    if(isset($_POST["update_account_hidden"]))
    {
        
        
        if(isset($_POST['account_id']))
        {
            $account_id = trim($_POST['account_id']);
            $wpdb->escape_by_ref($account_id);
        }
        if(isset($_POST['account_type']))
        {
            $account_type = trim($_POST['account_type']);
            $wpdb->escape_by_ref($account_type);
        }
        if(isset($_POST['consumer_key']))
        {
            $consumer_key = trim($_POST['consumer_key']);
            $wpdb->escape_by_ref($consumer_key);
        }
        if(isset($_POST['consumer_secret']))
        {
            $consumer_secret = trim($_POST['consumer_secret']);
            $wpdb->escape_by_ref($consumer_secret);
        }
        if(isset($_POST['access_token']))
        {
            $access_token = trim($_POST['access_token']);
            $wpdb->escape_by_ref($access_token);
        }
        if(isset($_POST['access_token_secret']))
        {
            $access_token_secret = trim($_POST['access_token_secret']);
            $wpdb->escape_by_ref($access_token_secret);
        }
        if(isset($_POST['username']))
        {
            $username = trim($_POST['username']);
            $wpdb->escape_by_ref($username);
        }
        if(isset($_POST['password']))
        {
            $password = trim($_POST['password']);
            $wpdb->escape_by_ref($password);
        }
        
        $sql = "UPDATE {$table_accounts}
            SET username='{$username}',
            password='{$password}',
            consumer_key='{$consumer_key}',
            consumer_secret='{$consumer_secret}',
            access_token='{$access_token}',
            access_token_secret='{$access_token_secret}'
            
            WHERE account_id={$account_id}";
        
        $wpdb->query($sql);
        //var_dump($_POST);
        ?>
        <div class="updated"><p><strong>Account updated successfully.</strong></p></div>
        <?php
    }
    
    if(isset($_POST["delete_account_hidden"]))
    {
        if(isset($_POST['account_id']))
        {
            $account_id = trim($_POST['account_id']);
            $wpdb->escape_by_ref($account_id);
        }
        
        $sql = "DELETE FROM {$table_accounts}
            WHERE account_id={$account_id}";
        
        $wpdb->query($sql);
        
        ?>
        <div class="updated"><p><strong>Account deleted successfully.</strong></p></div>
        <?php
    }
    
    ?>
    
   
    
    <div class="wrap">
        <div id="icon-plugins" class="icon32"><br /></div>
        <h2><span class="microblogposter-name">MicroblogPoster</span> Settings</h2>
        
        <h3 id="general-header">General Section:</h3>
        <form name="options_form" method="post" action="">
            <table class="form-table">
                <tr>
                    <td colspan="2">
                        <h3>Your Bitly Credentials: <span class="description">Help: Search for 'bitly api key'</span></h3>

                    </td>
                </tr>
                <tr>
                    <td class="label-input">Bitly API User:</td>
                    <td><input type="text" id="<?php echo $bitly_api_user_name;?>" name="<?php echo $bitly_api_user_name;?>" value="<?php echo $bitly_api_user_value;?>" size="35" /></td>
                </tr>
                <tr>
                    <td class="label-input">Bitly API Key:</td>
                    <td><input type="text" id="<?php echo $bitly_api_key_name;?>" name="<?php echo $bitly_api_key_name;?>" value="<?php echo $bitly_api_key_value;?>" size="35" /></td>
                </tr>

            </table>
            <p class="submit">
                <input type="submit" name="update_options" class="update-options button" value="Update Options" />
            </p>
        </form>
        
        
        <h3 id="network-accounts-header">Social Network Accounts Section:</h3>
        
        <?php
        $sql="SELECT count(*) as count FROM $table_accounts";
        $rows = $wpdb->get_results($sql, ARRAY_A);
        if($rows[0]['count'] > 10)
        {
            ?>
            <div class="updated">
                <p><strong>Warning </strong>about inherent php script execution time limitation (max_execution_time PHP setting). 
                    Since <span class="microblogposter-name">MicroblogPoster</span> needs time to update all your social accounts when publishing a new blog post this limit might be reached and script execution stopped.
                    In order to avoid it, <strong>please limit the number of social accounts</strong> based on your environment script execution time limit.
                </p></div>
            <?php
        }
        ?>
        
        <span class="new-account button" >Add New Account</span>
            
        <?php 
        
        $update_accounts = array();
        ?>
        
        <div id="social-network-accounts">
        <h4>Your Twitter Accounts</h4>
        <?php
        $sql="SELECT * FROM $table_accounts WHERE type='twitter'";
        $rows = $wpdb->get_results($sql);
        foreach($rows as $row):
            $update_accounts[] = $row->account_id;
        ?>
            <div style="display:none">
                <div id="update_account<?php echo $row->account_id;?>">
                    <form id="update_account_form<?php echo $row->account_id;?>" method="post" action="" enctype="multipart/form-data" >
                        
                        <h3 class="new-account-header"><span class="microblogposter-name">MicroblogPoster</span> Plugin</h3>
                        <div class="delete-wrapper">
                            Twitter Account: <span class="delete-wrapper-user"><?php echo $row->username;?></span>
                        </div>
                        <div id="twitter-div" class="one-account">
                            <div class="input-div">
                                Username:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="username" name="username" value="<?php echo $row->username;?>"/>
                            </div>
                            <div class="input-div">
                                Consumer Key:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="consumer_key" value="<?php echo $row->consumer_key;?>" />
                                <span class="description">Your Twitter Application Consumer Key.</span>
                            </div>
                            <div class="input-div">
                                Consumer Secret:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="consumer_secret" value="<?php echo $row->consumer_secret;?>" />
                                <span class="description">Your Twitter Application Consumer Secret.</span>
                            </div>
                            <div class="input-div">
                                Access Token:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="access_token" value="<?php echo $row->access_token;?>" />
                                <span class="description">Your Twitter Account Access Token</span>
                            </div>
                            <div class="input-div">
                                Access Token Secret:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="access_token_secret" value="<?php echo $row->access_token_secret;?>" />
                                <span class="description">Your Twitter Account Access Token Secret</span>
                            </div>
                        </div>

                        <input type="hidden" name="account_id" value="<?php echo $row->account_id;?>" />
                        <input type="hidden" name="account_type" value="twitter" />
                        <input type="hidden" name="update_account_hidden" value="1" />
                        <div class="button-holder">
                            <button type="button" class="button cancel-account" >Cancel</button>
                            <button type="button" class="button-primary save-account<?php echo $row->account_id;?>" >Save</button>
                        </div>

                    </form>
                </div>
            </div>
            <div style="display:none">
                <div id="delete_account<?php echo $row->account_id;?>">
                    <form id="delete_account_form<?php echo $row->account_id;?>" method="post" action="" enctype="multipart/form-data" >
                        <div class="delete-wrapper">
                        Twitter Account: <span class="delete-wrapper-user"><?php echo $row->username;?></span><br />
                        <span class="delete-wrapper-del">Delete?</span>
                        </div>
                        <input type="hidden" name="account_id" value="<?php echo $row->account_id;?>" />
                        <input type="hidden" name="account_type" value="twitter" />
                        <input type="hidden" name="delete_account_hidden" value="1" />
                        <div class="button-holder-del">
                            <button type="button" class="button cancel-account" >Cancel</button>
                            <button type="button" class="del-account-fb button del-account<?php echo $row->account_id;?>" >Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="account-wrapper">
                <span><?php echo $row->username;?></span>
                <span class="edit-account button edit<?php echo $row->account_id;?>">Edit</span>
                <span class="del-account button del<?php echo $row->account_id;?>">Del</span>
            </div>
            
        <?php endforeach;?>
        
        <h4>Your Plurk Accounts</h4>
        <?php
        $sql="SELECT * FROM $table_accounts WHERE type='plurk'";
        $rows = $wpdb->get_results($sql);
        foreach($rows as $row):
            $update_accounts[] = $row->account_id;
        ?>
            <div style="display:none">
                <div id="update_account<?php echo $row->account_id;?>">
                    <form id="update_account_form<?php echo $row->account_id;?>" method="post" action="" enctype="multipart/form-data" >
                        <h3 class="new-account-header"><span class="microblogposter-name">MicroblogPoster</span> Plugin</h3>
                        <div class="delete-wrapper">
                            Plurk Account: <span class="delete-wrapper-user"><?php echo $row->username;?></span>
                        </div>
                        <div id="plurk-div" class="one-account">
                            <div class="input-div">
                                Username:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="username" name="username" value="<?php echo $row->username;?>"/>
                            </div>
                            <div class="input-div">
                                Consumer Key:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="consumer_key" value="<?php echo $row->consumer_key;?>" />
                                <span class="description">Your Plurk Application Consumer Key.</span>
                            </div>
                            <div class="input-div">
                                Consumer Secret:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="consumer_secret" value="<?php echo $row->consumer_secret;?>" />
                                <span class="description">Your Plurk Application Consumer Secret.</span>
                            </div>
                            <div class="input-div">
                                Access Token:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="access_token" value="<?php echo $row->access_token;?>" />
                                <span class="description">Your Plurk Account Access Token</span>
                            </div>
                            <div class="input-div">
                                Access Token Secret:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="access_token_secret" value="<?php echo $row->access_token_secret;?>" />
                                <span class="description">Your Plurk Account Access Token Secret</span>
                            </div>
                        </div>

                        <input type="hidden" name="account_id" value="<?php echo $row->account_id;?>" />
                        <input type="hidden" name="account_type" value="plurk" />
                        <input type="hidden" name="update_account_hidden" value="1" />
                        <div class="button-holder">
                            <button type="button" class="button cancel-account" >Cancel</button>
                            <button type="button" class="button-primary save-account<?php echo $row->account_id;?>" >Save</button>
                        </div>

                    </form>
                </div>
            </div>
            <div style="display:none">
                <div id="delete_account<?php echo $row->account_id;?>">
                    <form id="delete_account_form<?php echo $row->account_id;?>" method="post" action="" enctype="multipart/form-data" >
                        <div class="delete-wrapper">
                        Plurk Account: <span class="delete-wrapper-user"><?php echo $row->username;?></span><br />
                        <span class="delete-wrapper-del">Delete?</span>
                        </div>
                        <input type="hidden" name="account_id" value="<?php echo $row->account_id;?>" />
                        <input type="hidden" name="account_type" value="plurk" />
                        <input type="hidden" name="delete_account_hidden" value="1" />
                        <div class="button-holder-del">
                            <button type="button" class="button cancel-account" >Cancel</button>
                            <button type="button" class="del-account-fb button del-account<?php echo $row->account_id;?>" >Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="account-wrapper">
                <span><?php echo $row->username;?></span>
                <span class="edit-account button edit<?php echo $row->account_id;?>">Edit</span>
                <span class="del-account button del<?php echo $row->account_id;?>">Del</span>
            </div>
            
        <?php endforeach;?>
        
        <h4>Your Identica Accounts</h4>    
        <?php
        $sql="SELECT * FROM $table_accounts WHERE type='identica'";
        $rows = $wpdb->get_results($sql);
        foreach($rows as $row):
            $update_accounts[] = $row->account_id;
        ?>
            <div style="display:none">
                <div id="update_account<?php echo $row->account_id;?>">
                    <form id="update_account_form<?php echo $row->account_id;?>" method="post" action="" enctype="multipart/form-data" >
                        <h3 class="new-account-header"><span class="microblogposter-name">MicroblogPoster</span> Plugin</h3>
                        <div class="delete-wrapper">
                            Identica Account: <span class="delete-wrapper-user"><?php echo $row->username;?></span>
                        </div>
                        <div id="identica-div" class="one-account">
                            <div class="input-div">
                                Identi.ca Username:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="username" value="<?php echo $row->username;?>" />
                            </div>
                            <div class="input-div">
                                Identi.ca Password:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="password" value="<?php echo $row->password;?>" />
                            </div>
                        </div>

                        <input type="hidden" name="account_id" value="<?php echo $row->account_id;?>" />
                        <input type="hidden" name="account_type" value="identica" />
                        <input type="hidden" name="update_account_hidden" value="1" />
                        <div class="button-holder">
                            <button type="button" class="button cancel-account" >Cancel</button>
                            <button type="button" class="button-primary save-account<?php echo $row->account_id;?>" >Save</button>
                        </div>

                    </form>
                </div>
            </div>
            <div style="display:none">
                <div id="delete_account<?php echo $row->account_id;?>">
                    <form id="delete_account_form<?php echo $row->account_id;?>" method="post" action="" enctype="multipart/form-data" >
                        <div class="delete-wrapper">
                        Identica Account: <span class="delete-wrapper-user"><?php echo $row->username;?></span><br />
                        <span class="delete-wrapper-del">Delete?</span>
                        </div>
                        <input type="hidden" name="account_id" value="<?php echo $row->account_id;?>" />
                        <input type="hidden" name="account_type" value="identica" />
                        <input type="hidden" name="delete_account_hidden" value="1" />
                        <div class="button-holder-del">
                            <button type="button" class="button cancel-account" >Cancel</button>
                            <button type="button" class="del-account-fb button del-account<?php echo $row->account_id;?>" >Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="account-wrapper">
                <span><?php echo $row->username;?></span>
                <span class="edit-account button edit<?php echo $row->account_id;?>">Edit</span>
                <span class="del-account button del<?php echo $row->account_id;?>">Del</span>
            </div>
        <?php endforeach;?>
        
        <h4>Your FriendFeed Accounts</h4>    
        <?php
        $sql="SELECT * FROM $table_accounts WHERE type='friendfeed'";
        $rows = $wpdb->get_results($sql);
        foreach($rows as $row):
            $update_accounts[] = $row->account_id;
        ?>
            <div style="display:none">
                <div id="update_account<?php echo $row->account_id;?>">
                    <form id="update_account_form<?php echo $row->account_id;?>" method="post" action="" enctype="multipart/form-data" >
                        <h3 class="new-account-header"><span class="microblogposter-name">MicroblogPoster</span> Plugin</h3>
                        <div class="delete-wrapper">
                            FriendFeed Account: <span class="delete-wrapper-user"><?php echo $row->username;?></span>
                        </div>
                        <div id="friendfeed-div" class="one-account">
                            <div class="input-div">
                                FriendFeed Username:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="username" value="<?php echo $row->username;?>" />
                            </div>
                            <div class="input-div">
                                FriendFeed Password:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="password" value="<?php echo $row->password;?>" />
                            </div>
                        </div>

                        <input type="hidden" name="account_id" value="<?php echo $row->account_id;?>" />
                        <input type="hidden" name="account_type" value="friendfeed" />
                        <input type="hidden" name="update_account_hidden" value="1" />
                        <div class="button-holder">
                            <button type="button" class="button cancel-account" >Cancel</button>
                            <button type="button" class="button-primary save-account<?php echo $row->account_id;?>" >Save</button>
                        </div>

                    </form>
                </div>
            </div>
            <div style="display:none">
                <div id="delete_account<?php echo $row->account_id;?>">
                    <form id="delete_account_form<?php echo $row->account_id;?>" method="post" action="" enctype="multipart/form-data" >
                        <div class="delete-wrapper">
                        FriendFeed Account: <span class="delete-wrapper-user"><?php echo $row->username;?></span><br />
                        <span class="delete-wrapper-del">Delete?</span>
                        </div>
                        <input type="hidden" name="account_id" value="<?php echo $row->account_id;?>" />
                        <input type="hidden" name="account_type" value="friendfeed" />
                        <input type="hidden" name="delete_account_hidden" value="1" />
                        <div class="button-holder-del">
                            <button type="button" class="button cancel-account" >Cancel</button>
                            <button type="button" class="del-account-fb button del-account<?php echo $row->account_id;?>" >Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="account-wrapper">
                <span><?php echo $row->username;?></span>
                <span class="edit-account button edit<?php echo $row->account_id;?>">Edit</span>
                <span class="del-account button del<?php echo $row->account_id;?>">Del</span>
            </div>
        <?php endforeach;?>
        
        <h4>Your Delicious Accounts</h4>    
        <?php
        $sql="SELECT * FROM $table_accounts WHERE type='delicious'";
        $rows = $wpdb->get_results($sql);
        foreach($rows as $row):
            $update_accounts[] = $row->account_id;
        ?>
            <div style="display:none">
                <div id="update_account<?php echo $row->account_id;?>">
                    <form id="update_account_form<?php echo $row->account_id;?>" method="post" action="" enctype="multipart/form-data" >
                        <h3 class="new-account-header"><span class="microblogposter-name">MicroblogPoster</span> Plugin</h3>
                        <div class="delete-wrapper">
                            Delicious Account: <span class="delete-wrapper-user"><?php echo $row->username;?></span>
                        </div>
                        <div id="delicious-div" class="one-account">
                            <div class="input-div">
                                Delicious Username:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="username" value="<?php echo $row->username;?>" />
                            </div>
                            <div class="input-div">
                                Delicious Password:
                            </div>
                            <div class="input-div-large">
                                <input type="text" id="" name="password" value="<?php echo $row->password;?>" />
                            </div>
                        </div>

                        <input type="hidden" name="account_id" value="<?php echo $row->account_id;?>" />
                        <input type="hidden" name="account_type" value="delicious" />
                        <input type="hidden" name="update_account_hidden" value="1" />
                        <div class="button-holder">
                            <button type="button" class="button cancel-account" >Cancel</button>
                            <button type="button" class="button-primary save-account<?php echo $row->account_id;?>" >Save</button>
                        </div>

                    </form>
                </div>
            </div>
            <div style="display:none">
                <div id="delete_account<?php echo $row->account_id;?>">
                    <form id="delete_account_form<?php echo $row->account_id;?>" method="post" action="" enctype="multipart/form-data" >
                        <div class="delete-wrapper">
                        Delicious Account: <span class="delete-wrapper-user"><?php echo $row->username;?></span><br />
                        <span class="delete-wrapper-del">Delete?</span>
                        </div>
                        <input type="hidden" name="account_id" value="<?php echo $row->account_id;?>" />
                        <input type="hidden" name="account_type" value="delicious" />
                        <input type="hidden" name="delete_account_hidden" value="1" />
                        <div class="button-holder-del">
                            <button type="button" class="button cancel-account" >Cancel</button>
                            <button type="button" class="del-account-fb button del-account<?php echo $row->account_id;?>" >Delete</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="account-wrapper">
                <span><?php echo $row->username;?></span>
                <span class="edit-account button edit<?php echo $row->account_id;?>">Edit</span>
                <span class="del-account button del<?php echo $row->account_id;?>">Del</span>
            </div>
        <?php endforeach;?>
        </div>
    </div>
    
    
    <style>
        .microblogposter-name
        {
            color: #008100;
        }
        .form-table td
        {
            font-size: 10px;
            line-height: 1em;
            padding: 0 0 5px 0;
        }
        .form-table td.label-input
        {
            width: 100px;
        }
        .button-holder
        {
            margin-top: 20px;
        }
        .help-div
        {
            margin-left: 20px;
            margin-bottom: 25px;
        }
        .input-div
        {
            margin-left: 20px;
            margin-bottom: 5px;
            display: inline-block;
            width: 150px;
        }
        .input-div-large
        {
            margin-bottom: 5px;
            display: inline-block;
            width: 480px;
        }
        .input-div input
        {
            width: 200px;
        }
        .label-account-type
        {
            font-size: 14px;
            margin-left: 10px;
        }
        .new-account-header
        {
            text-align: center;
        }
        #account_type
        {
            width: 150px;
        }
        #account_type_wrapper
        {
            width: 275px;
            height: 30px;
            margin: 0 auto;
            padding-top: 5px;
            background-color: #f2f2f2;
            border-radius: 10px;
        }
        .one-account
        {
            margin-top: 20px;
            background-color: #F3F3F7;
            border-radius: 10px;
            padding-top: 20px;
            padding-bottom: 10px;
        }
        .button-holder
        {
            width: 120px;
            margin: 30px auto;
        }
        .button-holder-del
        {
            width: 130px;
            margin: 30px auto;
        }
        .edit-account
        {
            padding: 1px 8px;
            background: #0066FF;
            color: #FFFFFF;
        }
        .edit-account:hover
        {
            color: #CCCCCC;
            border-color: #BBBBBB;
        }
        .new-account
        {
            background: #00B800;
            color: #FFFFFF;
            margin-bottom: 20px;
        }
        .new-account:hover
        {
            color: #FFFF00;
            border-color: #BBBBBB;
        }
        .del-account
        {
            padding: 1px 8px;
            background: #FFFFFF;
            color: #FF0000;
            border-color: #FF0000;
        }
        .del-account:hover
        {
            color: #B20000;
            border-color: #FF0000;
        }
        .del-account-fb
        {
            background: #FFFFFF;
            color: #FF0000;
            border-color: #FF0000;
        }
        .del-account-fb:hover
        {
            color: #B20000;
            border-color: #FF0000;
        }
        .update-options
        {
            
        }
        .account-wrapper
        {
            margin-bottom: 20px;
        }
        #network-accounts-header
        {
            margin-top: 30px;
            margin-bottom: 20px;
            width: 275px;
            border-bottom: 3px solid #99E399;
        }
        #general-header
        {
            width: 140px;
            border-bottom: 3px solid #99E399;
        }
        #social-network-accounts
        {
            margin-top: 35px;
        }
        .delete-wrapper
        {
            text-align: center;
        }
        .delete-wrapper-del
        {
            color: #FF0000;
        }
        .delete-wrapper-user
        {
            color: #0066FF;
        }
    </style>
    <div style="display:none">
        <div id="new_account">
            <form id="new_account_form" method="post" action="" enctype="multipart/form-data" >
                
                <h3 class="new-account-header"><span class="microblogposter-name">MicroblogPoster</span> Plugin</h3>
                <div id="account_type_wrapper">
                <label for="account_type" class="label-account-type">Account type:</label>
                <select id="account_type" name="account_type">
                    <option value="twitter">Twitter</option>
                    <option value="plurk">Plurk</option>
                    <option value="identica">Identi.ca</option>
                    <option value="friendfeed">FriendFeed</option>
                    <option value="delicious">Delicious</option>
                </select> 
                </div>
                
                
                <div id="twitter-div" class="one-account">
                    <div class="help-div"><span class="description">Help: Search for 'create an application twitter api'</span></div>
                    <div class="input-div">
                        Username:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="username" name="username" />
                    </div>
                    <div class="input-div">
                        Consumer Key:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="" name="consumer_key" value="" />
                        <span class="description">Your Twitter Application Consumer Key.</span>
                    </div>
                    <div class="input-div">
                        Consumer Secret:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="" name="consumer_secret" value="" />
                        <span class="description">Your Twitter Application Consumer Secret.</span>
                    </div>
                    <div class="input-div">
                        Access Token:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="" name="access_token" value="" />
                        <span class="description">Your Twitter Account Access Token</span>
                    </div>
                    <div class="input-div">
                        Access Token Secret:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="" name="access_token_secret" value="" />
                        <span class="description">Your Twitter Account Access Token Secret</span>
                    </div>
                </div>
                <div id="plurk-div" class="one-account">
                    <div class="help-div"><span class="description">Help: Search for 'create an application plurk api'</span></div>
                    <div class="input-div">
                        Username:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="username" name="username" value="" />
                    </div>
                    <div class="input-div">
                        Consumer Key:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="" name="consumer_key" value="" />
                        <span class="description">Your Plurk Application Consumer Key.</span>
                    </div>
                    <div class="input-div">
                        Consumer Secret:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="" name="consumer_secret" value="" />
                        <span class="description">Your Plurk Application Consumer Secret.</span>
                    </div>
                    <div class="input-div">
                        Access Token:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="" name="access_token" value="" />
                        <span class="description">Your Plurk Account Access Token</span>
                    </div>
                    <div class="input-div">
                        Access Token Secret:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="" name="access_token_secret" value="" />
                        <span class="description">Your Plurk Account Access Token Secret</span>
                    </div>
                </div>
                <div id="identica-div" class="one-account">
                    <div class="input-div">
                        Identi.ca Username:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="username" name="username" value="" />
                    </div>
                    <div class="input-div">
                        Identi.ca Password:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="" name="password" value="" />
                    </div>
                </div>
                <div id="friendfeed-div" class="one-account">
                    <div class="input-div">
                        FriendFeed Username:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="username" name="username" value="" />
                    </div>
                    <div class="input-div">
                        FriendFeed Remote Key:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="" name="password" value="" />
                        <span class="description">Your FriendFeed Remote Key not password.</span>
                    </div>
                </div>
                <div id="delicious-div" class="one-account">
                    <div class="input-div">
                        Delicious Username:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="username" name="username" value="" />
                    </div>
                    <div class="input-div">
                        Delicious Password:
                    </div>
                    <div class="input-div-large">
                        <input type="text" id="" name="password" value="" />
                    </div>
                </div>
                
                <input type="hidden" name="new_account_hidden" value="1" />
                <div class="button-holder">
                    <button type="button" class="button cancel-account" >Cancel</button>
                    <button type="button" class="button-primary save-account" >Save</button>
                </div>
                
            </form>
        </div>
    </div>
    
    <?php
        wp_enqueue_script( 'microblogposter-fancybox-js-script' );
        wp_enqueue_style( 'microblogposter-fancybox-css-script' );
    ?>
    <script>
        jQuery(document).ready(function($) {
            // $() will work as an alias for jQuery() inside of this function
            $(".new-account").live("click", function(){
                $.fancybox({
                    'content'       : $('#new_account').html(),
                    'transitionIn'	: 'none',
                    'transitionOut'	: 'none',
                    'autoDimensions': false,
                    'width'		: 700,
                    'height'	: 400,
                    'scrolling'	: 'no',
                    'titleShow'	: false,
                    'onComplete'	: function() {
                        $('div#fancybox-content #plurk-div,div#fancybox-content #identica-div,div#fancybox-content #friendfeed-div,div#fancybox-content #delicious-div').hide().find('input').attr('disabled','disabled');
                    }
                });
                
            });
            
            $(".cancel-account").live("click", function(){
                $.fancybox.close();
            });
            
            $(".save-account").live("click", function(){
                
                var valid = 1;
                
                if(!$('div#fancybox-content #username').val())
                {
                    valid = 0;
                }
                
                if(valid == 1)
                {
                    $('div#fancybox-content #new_account_form').submit();
                    $.fancybox.close();
                }
                else
                {
                    alert('Please enter all required fields.');
                }
                
            });
            
            
            
            $("#account_type").live("change", function(){
                var type = $(this).val();
                //console.log(type);
                $('div#fancybox-content #twitter-div,div#fancybox-content #plurk-div,div#fancybox-content #identica-div,div#fancybox-content #friendfeed-div,div#fancybox-content #delicious-div').hide().find('input').attr('disabled','disabled');
                $('div#fancybox-content #'+type+'-div').show().find('input').removeAttr('disabled');
            });
            
            <?php foreach($update_accounts as $account_id):?>
                $(".edit<?php echo $account_id;?>").live("click", function(){
                    $.fancybox({
                        'content'       : $('#update_account<?php echo $account_id;?>').html(),
                        'transitionIn'	: 'none',
                        'transitionOut'	: 'none',
                        'autoDimensions': false,
                        'width'		: 700,
                        'height'	: 400,
                        'scrolling'	: 'no',
                        'titleShow'	: false
                    });
                });
                $(".save-account<?php echo $account_id;?>").live("click", function(){

                    
                    var valid = 1;

                    if(!$('div#fancybox-content #username').val())
                    {
                        valid = 0;
                    }

                    if(valid == 1)
                    {
                        $('div#fancybox-content #update_account_form<?php echo $account_id;?>').submit();
                        $.fancybox.close();
                    }
                    else
                    {
                        alert('Please enter all required fields.');
                    }
                });
                
                $(".del<?php echo $account_id;?>").live("click", function(){
                    $.fancybox({
                        'content'       : $('#delete_account<?php echo $account_id;?>').html(),
                        'transitionIn'	: 'none',
                        'transitionOut'	: 'none',
                        'autoDimensions': false,
                        'width'		: 400,
                        'height'	: 120,
                        'scrolling'	: 'no',
                        'titleShow'	: false
                    });
                });
                $(".del-account<?php echo $account_id;?>").live("click", function(){

                    $('div#fancybox-content #delete_account_form<?php echo $account_id;?>').submit();
                    $.fancybox.close();
                });
            <?php endforeach;?>
            
        });
        
        

    </script>
    
    <?php
    
}
?>