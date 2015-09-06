<?php
  namespace thatoneduderob\Mail;

  class Mailer {
    protected $mailer;
    protected $view;

    public function __construct($mailer, $view) {
      $this->mailer = $mailer;
      $this->view = $view;
    }

    public function send($template, $data, $callback) {
      $message = new Message($this->mailer);

      $this->view->appendData($data);

      $message->body($this->view->render($template));

      call_user_func($callback, $message);

      $this->mailer->Send();
    }
  }