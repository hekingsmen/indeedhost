<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\EmailTemplate;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mailer extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $content = EmailTemplate::find($this->data['id']);
        $address = 'janeexampexample@example.com';
        $subject = $content->template_subject;
        $name = 'Jane Doe';
        $content = str_replace('[projectTitle]','Porject Title Here',$content->template_content);
        $content = str_replace('[projectManagerName]','Project Manager Name',$content);
        
        return $this->view('emails.test')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'test_message' => $content ]);
    }
}