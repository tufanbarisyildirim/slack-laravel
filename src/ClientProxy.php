<?php

namespace Javfres\Slack;


use Nexy\Slack\Client;
use Nexy\Slack\Attachment;
use Nexy\Slack\AttachmentField;


final class ClientProxy {


    /**
     * The real client
     */
    private $client;


    /**
     * The constructor
     */
    function __construct($app){

        $this->client = new Client(
            $app['config']->get('slack.endpoint'),
            [
                'channel' => $app['config']->get('slack.channel'),
                'username' => $app['config']->get('slack.username'),
                'icon' => $app['config']->get('slack.icon'),
                'link_names' => $app['config']->get('slack.link_names'),
                'unfurl_links' => $app['config']->get('slack.unfurl_links'),
                'unfurl_media' => $app['config']->get('slack.unfurl_media'),
                'allow_markdown' => $app['config']->get('slack.allow_markdown'),
                'markdown_in_attachments' => $app['config']->get('slack.markdown_in_attachments'),
            ]
        );

    }


    /**
     * Pass any unhandled methods through the client instance
     *
     * @param string $name      The name of the method
     * @param array  $arguments The method arguments
     *
     */
    public function __call(string $name, array $arguments) {
        return \call_user_func_array([$this->client, $name], $arguments);
    }


    public function array2attach(array $arr){
        $attach = new Attachment();

        foreach($arr as $item => $value){

            switch($item){
                case 'title':
                    $attach->setTitle($value);
                    continue 2;
                case 'color':
                    $attach->setColor($value);
                    continue 2;
                case 'text':
                    $attach->setText($value);
                    continue 2;
                case 'fields':
                    $attach->setFields($this->array2fields($value));
                    continue 2;

            }

            throw new \RuntimeException("Not supported '$item' in array2attach");

        }

        return $attach;
    }


    public function array2fields(array $arr){

        $res = [];

        foreach($arr as $field_arr){

            $title = '';
            $value = '';
            $short = false;

            
            foreach($field_arr as $item => $v){

                switch($item){
                    case 'title':
                        $title = $v;
                        continue 2;
                    case 'value':
                        $value = $v;
                        continue 2;
                    case 'short':
                        $short = $v;
                        continue 2;
    
                }
    
                throw new \RuntimeException("Not supported '$item' in array2fields");
    
            }

            $res[] = new AttachmentField($title, $value, $short);

        }


        return $res;


    }


}

