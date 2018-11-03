<?php

require_once ('../vendor/autoload.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
$exchange = 'router';
$queue = 'msg';

$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');
$channel = $connection->channel();
/*
/*
The following code is the same both in the consumer and the producer.
In this way we are sure we always have a queue to consume from and an
exchange where to publish messages.
*/
/*
name: $queue
passive: false
durable: true // the queue will survive server restarts
exclusive: false // the queue can be accessed in other channels
auto_delete: false //the queue won't be deleted once the channel is closed.
*/
$channel->queue_declare($queue, false, true, false, false);
/*
name: $exchange
type: direct
passive: false
durable: true // the exchange will survive server restarts
auto_delete: false //the exchange won't be deleted once the channel is closed.
*/
$channel->exchange_declare($exchange, 'direct', false, true, false);
$channel->queue_bind($queue, $exchange);
/**
* @param \PhpAmqpLib\Message\AMQPMessage $message
*/
function process_message(\PhpAmqpLib\Message\AMQPMessage $message)
{
    $msg = json_decode($message->body);
    file_put_contents('data/' .$msg->name. '.json', $message->body);
    $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
}
/*
queue: Queue from where to get the messages
consumer_tag: Consumer identifier
no_local: Don't receive messages published by this consumer.
no_ack: Tells the server if the consumer will acknowledge the messages.
exclusive: Request exclusive consumer access, meaning only this consumer can access the queue
nowait:
callback: A PHP Callback
*/
$consumerTag = 'grzegorz Queue';
$channel->basic_consume($queue, $consumerTag, false, false, false, false, 'process_message');

/**
* @param \PhpAmqpLib\Channel\AMQPChannel $channel
* @param \PhpAmqpLib\Connection\AbstractConnection $connection
*/
function shutdown($channel, $connection)
{
    $channel->close();
    $connection->close();
}

register_shutdown_function('shutdown', $channel, $connection);
// Loop as long as the channel has callbacks registered
while (count($channel->callbacks)) {
    $channel->wait();
}
