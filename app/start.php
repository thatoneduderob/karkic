<?php
  use Slim\Slim;
  use Slim\Views\Twig;
  use Slim\Views\TwigExtension;
  use Noodlehaus\Config;
  use RandomLib\Factory as RandomLib;
  use thatoneduderob\User\User;
  use thatoneduderob\Helpers\Hash;
  use thatoneduderob\Validation\Validator;
  use thatoneduderob\Middleware\BeforeMiddleware;
  use thatoneduderob\Middleware\CsrfMiddleware;
  use thatoneduderob\Mail\Mailer;

  session_cache_limiter(false);
  session_start();
  ini_set('display_errors', 'On');
  define('INC_ROOT', dirname(__DIR__));
  require(INC_ROOT."/vendor/autoload.php");

  $app = new Slim([
    'mode' => 'production',
    'view' => new Twig(),
    'templates.path' => INC_ROOT.'/app/views'
  ]);
  $app->add(new BeforeMiddleware);
  $app->add(new CsrfMiddleware);
  $app->configureMode($app->config('mode'), function() use ($app) {
    $app->config = Config::load(INC_ROOT."/app/config/config.php");
  });

  require 'filters.php';
  require 'database.php';
  require 'routes.php';

  $app->auth = false;
  $app->container->set('user', function() {
    return new User;
  });
  $app->container->singleton('hash', function() use ($app) {
    return new Hash($app->config);
  });
  $app->container->singleton('validation', function() use ($app) {
    return new Validator($app->user, $app->hash, $app->auth);
  });
  $app->container->singleton('mail', function() use ($app) {
    $mailer = new PHPMailer;

    $mailer->isSMTP();
    $mailer->Host = $app->config->get('mail.host');
    $mailer->SMTPAuth = $app->config->get('mail.smtp_auth');
    $mailer->SMTPSecure = $app->config->get('mail.smtp_secure');
    $mailer->Port = $app->config->get('mail.port');
    $mailer->Username = $app->config->get('mail.username');
    $mailer->Password = $app->config->get('mail.password');
    $mailer->isHTML($app->config->get('mail.html'));
    $mailer->From = 'mail@cutrategames.com';
  	$mailer->FromName = 'CutRateGames';
  	$mailer->addReplyTo('mail@cutrategames.com', 'CutRateGames');

    return new Mailer($mailer, $app->view);
  });
  $app->container->singleton('randomlib', function() use ($app) {
    $factory = new RandomLib;
    return $factory->getMediumStrengthGenerator();
  });

  $view = $app->view();
  $view->parserOptions = [
    'debug' => $app->config->get('twig.debug')
  ];
  $view->parserExtensions = [
    new TwigExtension
  ];

  if(!function_exists('hash_equals')) {
    function hash_equals($str1, $str2) {
      if(strlen($str1) != strlen($str2)) {
        return false;
      } else {
        $res = $str1 ^ $str2;
        $ret = 0;
        for($i = strlen($res) - 1;$i >= 0;$i--) $ret |= ord($res[$i]);
        return !$ret;
      }
    }
  }
