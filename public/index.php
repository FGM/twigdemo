<?php
/**
 * @file Single index controller for Twig demo.
 */

// Define real paths for useful directories.
define('BASE', realpath(__DIR__ . '/..'));
define('CONFIG', realpath(BASE . '/config'));
define('CACHE', realpath(BASE . '/cache'));
define('PUBLIC', __DIR__);
define('TEMPLATES', realpath(BASE . '/templates'));

require_once __DIR__ . '/../vendor/autoload.php';

// @see http://twig.sensiolabs.org/doc/api.html
$environment_options = [
  // Settings you may want to play with.
  'auto_reload' => true,
  'debug' => true,
  'strict_variables' => true,

  // Settings you probably do not want to touch.

  // Possible values: true, false, js, html, css, url, html_attr, <some php callback>
  'autoescape' => true,

  // Possible value: false, or an absolute path. Better enable auto_reload than disable cache.
  'cache' => CACHE,

  // Default settings just listed here as a reminder.
  // 'base_template_class' => 'Twig_Template',
  // 'charset' => 'utf-8',
  // 'optimizations' => -1,
];

$loader = new Twig_Loader_Filesystem([TEMPLATES]);
$twig = new Twig_Environment($loader, $environment_options);

$variables = new \OSInet\TwigDemo\Variables();
$variables->load(CONFIG . '/vars.php');

$view = $twig->render('index.html.twig', $variables->hash());
echo $view;
