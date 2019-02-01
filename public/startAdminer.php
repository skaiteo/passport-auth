<?php
function adminer_object() {
    // required to run any plugin
    include_once "./plugins/plugin.php";
    
    // autoloader
    foreach (glob("plugins/*.php") as $filename) {
        include_once "./$filename";
    }
    
    $credentials = parse_url(getenv("DATABASE_URL"));
    $system = "pgsql";  
    $server = $credentials["host"];
    $name = $credentials["user"];
    $pass = $credentials["pass"];
    $database = ltrim($credentials["path"], "/");
    
    $plugins = array(
        // specify enabled plugins here
        // new AdminerDumpXml,
        // new AdminerTinymce,
        // new AdminerFileUpload("data/"),
        // new AdminerSlugify,
        // new AdminerTranslation,
        // new AdminerForeignSystem,
        new FillLoginForm($system, $server, $name, $pass, $database)
    );
    
    /* It is possible to combine customization and plugins:
    class AdminerCustomization extends AdminerPlugin {
    }
    return new AdminerCustomization($plugins);
    */
    
    return new AdminerPlugin($plugins);
}

// include original Adminer or Adminer Editor
include "./adminer-4.7.1.php";
?>