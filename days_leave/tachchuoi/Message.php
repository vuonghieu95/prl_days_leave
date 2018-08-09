<?php

/**
 * Class Message
 */
class Message
{
    protected $_prefix = '[Xin Nghỉ]';
    public function process()
    {
        $sender = 'Quy';
        $message ="[Xin Nghỉ]_20-4-5045_xin phep nghi om";
        if (strpos($message, $this->_prefix) === false) {
            return [];
        }
        $a = explode("_", $message);
        return [
            'sender' => $sender,
            'date' => $a[1],
            'reason' => $a[2]
        ];
    }
}
//bieu thuc chinh quy