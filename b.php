<?php

set_error_handler('b_errorHandler');

require_once('includes/common.inc');
require_once('includes/command.inc');
require_once('includes/render.inc');
require_once('includes/output.inc');
require_once('includes/filesystem.inc');

//Global variables.
$elements = array();

b_init();

if(drush_mode()){
  require_once('includes/drush_wrapper.inc');
  drush_process_command();
}
else{
  b_process_command();
}

b_print_messages();
b_render($elements);

function b_errorHandler($errno, $message, $filename, $line, $context){
  echo $message."\n";
  echo "\t". $filename . ":" . $line ."\n";
}
exit();


function b_init() {
  $arguments = array();
  $options = array();
  $command = array(
   'options' => array(
     'root' => 'Backdrop root folder',
     'drush' => 'Use .drush.inc files instead. Drupal 7 drush commands compatibility.',
     'y' => 'Force Yes to all Yes/No questions',
     'yes' => 'Force Yes to all Yes/No questions',
     'd' => 'Debug mode',
     'debug' => 'Debug mode on',
    ),
  );
  b_get_command_args_options($arguments, $options, $command);
  if(isset($options['root'])) {
    if(file_exists($options['root'] . '/settings.php')) {
      define('BACKDROP_ROOT', $options['root']);
    }
  }
  else{
    $path = getcwd();
    if(file_exists($path . '/settings.php')) {
      define('BACKDROP_ROOT', $path);
    }
  }
  
  if(defined('BACKDROP_ROOT')){
    chdir(BACKDROP_ROOT);
  }
  
  if(isset($options['drush'])) {
    drush_mode(TRUE);
    b_set_message('Drush mode on');
  }
  
  if(isset($options['y']) or isset($options['yes'])) {
    b_yes_mode(TRUE);
    b_set_message('Yes mode on');
  }
  if(isset($options['d']) or isset($options['debug'])) {
    b_is_debug(TRUE);
    b_set_message('Debug mode on');
  }
  
  

  $host = 'localhost';
  $path = '';

  $_SERVER['HTTP_HOST'] = $host;
  $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
  $_SERVER['SERVER_ADDR'] = '127.0.0.1';
  $_SERVER['SERVER_SOFTWARE'] = '';
  $_SERVER['SERVER_NAME'] = 'localhost';
  $_SERVER['REQUEST_URI'] = $path .'/';
  $_SERVER['REQUEST_METHOD'] = 'GET';
  $_SERVER['SCRIPT_NAME'] = $path .'/index.php';
  $_SERVER['PHP_SELF'] = $path .'/index.php';
  $_SERVER['HTTP_USER_AGENT'] = 'Backdrop command line';

  if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    // Ensure that any and all environment variables are changed to https://.
    foreach ($_SERVER as $key => $value) {
      $_SERVER[$key] = str_replace('http://', 'https://', $_SERVER[$key]);
    }
  }

}
