<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/26/18
 * Time: 3:59 PM
 */

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Rabbit_Controller
{



    /**
     * @param string $message
     */
    public function newTask($message)
    {
        $message = explode(",", $message);

        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->exchange_declare('logs', 'fanout', false, false, false);
        $data = implode(' ', $message);
        if (empty($data)) {
            $data = "Info: Hello World!";
        }

        $msg = new AMQPMessage($data, array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));

        $channel->basic_publish($msg, 'logs');

        echo ' [x] Sent ', $data, "\n";

        $channel->close();
        $connection->close();
    }

    public function worker()
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->exchange_declare('logs', 'fanout', false, false, false);

        list($queue_name, ,) = $channel->queue_declare("", false, true, true, false);

        $channel->queue_bind($queue_name, 'logs');

        echo " [*] Waiting for logs. To exit press CTRL+C\n";

        $callback = function ($msg) {
            exec('php /var/www/html/web/command/command.php rabbit/test/'.$msg->body.' > /dev/null &');
//            echo ' [x] ', $msg->body, "\n";
           $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        $callback1 = function ($msg) {
            echo ' [x1] ', $msg->body, "\n";
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            var_dump($msg->delivery_info['delivery_tag']);
            var_dump($msg->delivery_info['channel']);

        };
        $channel->basic_qos(null, 3, null);

        $channel->basic_consume($queue_name, '', false, false, false, false, $callback);

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

    public function test_process($msg)
    {

        file_put_contents(ROOT . 'app.log', date('Y-m-d H:i:s') . 'test '. $msg  . PHP_EOL, FILE_APPEND);
        sleep(3);
        file_put_contents(ROOT . 'app.log', date('Y-m-d H:i:s') . 'finish' . $msg . PHP_EOL, FILE_APPEND);

    }
}