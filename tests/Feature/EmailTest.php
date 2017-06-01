<?php

namespace Tests\Feature;

use Swift_Events_EventListener;
use Swift_Message;
use Swift_Mailer;
use Swift_SendmailTransport;
use Mail;
use Tests\MailTracking;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmailTest extends TestCase
{
    use MailTracking; // custom trait which defines custom email assertions

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEmailSending()
    {
        $email1 = (new Swift_Message())
            ->setBody('Hello World')
            ->setTo('bert@user.com')
            ->setFrom('staff@egblog.com');

        Mail::raw('Hello World', function($message) {
            $message->to('bert@user.com');
            $message->from('staff@egblog.com');
        });

        $email2 = (new Swift_Message())
            ->setBody('Hello Bert')
            ->setTo('bert@user.com')
            ->setFrom('staff@egblog.com');

        Mail::raw('Hello Bert', function($message) {
            $message->to('bert@user.com');
            $message->from('staff@egblog.com');
        });

        $this->assertEmailWasSent() //custom assertions
             ->assertEmailsSent(2)
             ->assertEmailTo('bert@user.com')
             ->assertEmailFrom('staff@egblog.com')
             ->assertEmailBodyContains('Hello')
             ->assertEmailBodyEquals('Hello Bert', $email2);

             // TODO: solve issue of passing specific message instances to the assert
             // methods to be found and asserted against in the MailTracking trait.
             // Separate Swift_Message instance are created above in order than the
             // desired info can be asserted against in the trait. Would be preferable
             // to find a simple way to send these Swift_Message instances
    }
}
