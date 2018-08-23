<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/23/18
 * Time: 2:16 PM
 */
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PHPUnit\Framework\TestCase;
class RabbitMQTest extends TestCase
{
    public function testConnectionRabbitMQ(){
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        $msg = new AMQPMessage('Hello World!');
        $channel->basic_publish($msg, '', 'hello');

        echo " [x] Sent 'Hello World!'\n";
        $this->assertTrue(true);
    }
}