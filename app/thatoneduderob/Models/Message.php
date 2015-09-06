<?php
  namespace thatoneduderob\Models;

  use Illuminate\Database\Eloquent\Model as Eloquent;

  class Message extends Eloquent {
    protected $table = 'messages';
    protected $fillable = [
      'from_id',
      'to_id',
      'title',
      'body',
      'did_to_delete',
      'did_from_delete',
      'read'
    ];

    public function deleteMessage($messageId, $whoIsDeleting) {
      switch ($whoIsDeleting) {
        case 'to':
          $this->where('id', $messageId)->update([
            'did_to_delete' => true
          ]);
          break;
        case 'from':
          $this->where('id', $messageId)->update([
            'did_from_delete' => true
          ]);
          break;
        default:
          // if $whoIsDeleting != 'to' or 'from'
          break;
      }
    }

    public function markRead($messageId) {
      $this->where('id', $messageId)->update([
          'read' => true
      ]);
    }

    public function getUnreadCount($app) {
      $userId = $app->auth->id;
      $messages = $this->where(['from_id' => $userId, 'read' => false])->get()->count();
      return $messages;
    }

    public function getMonthDay($timestamp) {
      $parsedDate = date_parse($timestamp);

      return $this->getMonthName($parsedDate['month'])."&nbsp;".$parsedDate['day'];
    }

    public function getMonthName($monNum) {
      switch ($monNum) {
        case 1:
          return "January";
          break;
        case 2:
          return "February";
          break;
        case 3:
          return "March";
          break;
        case 4:
          return "April";
          break;
        case 5:
          return "May";
          break;
        case 6:
          return "June";
          break;
        case 7:
          return "July";
          break;
        case 8:
          return "August";
          break;
        case 9:
          return "September";
          break;
        case 10:
          return "October";
          break;
        case 11:
          return "November";
          break;
        case 12:
          return "December";
          break;
      }
    }
  }