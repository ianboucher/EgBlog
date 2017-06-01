<?php

namespace Tests;

use Swift_Events_EventListener;
use Swift_Message;
use Mail;

/**
 *
 */
trait MailTracking
{
    protected $emails = [];
    /**
     * @before
     */
    public function setUpMailTracking()
    {
        Mail::getSwiftMailer()
            ->registerPlugin(new TestingMailEventListener($this));
    }

    public function addEmail(Swift_Message $email)
    {
        $this->emails[] = $email;
    }

    /**
     * return specific email instance, or the most recent email message
     */
    protected function getEmail(Swift_Message $message = null)
    {
        $this->assertEmailWasSent(); // check email was sent before trying to retrieve one

        return $email = $message ?: $this->lastEmail();
    }

    protected function lastEmail()
    {
        return end($this->emails);
    }

    protected function assertEmailWasSent()
    {
        $this->assertNotEmpty(
            $this->emails, "No emails have been sent"
        );

        return $this; // return instance for continued method chaining
    }

    protected function assertEmailWasNotSent()
    {
        $this->assertEmpty(
            $this->emails, "Failed asserting that no emails have been sent"
        );

        return $this; // return instance for continued method chaining
    }

    protected function assertEmailsSent($count)
    {
        $this->assertCount(
            $count, $this->emails,
            "Expected $count emails to have been sent. Received " . count($this->emails) . " emails"
        );

        return $this;
    }

    protected function assertEmailTo($recipient, Swift_Message $message = null)
    {
        $this->assertArrayHasKey(
            $recipient, $this->getEmail($message)->getTo(),
            "Email not sent to correct recipient: $recipient"
        );

        return $this;
    }

    protected function assertEmailFrom($sender, Swift_Message $message = null)
    {
        $this->assertArrayHasKey(
            $sender, $this->getEmail($message)->getFrom(),
            "Email not sent from correct sender: $sender"
        );

        return $this;
    }

    protected function assertEmailBodyEquals($body, Swift_Message $message = null)
    {
        $this->assertEquals(
            $body, $this->getEmail($message)->getBody(),
            "Email body does not match required body"
        );

        return $this;
    }

    protected function assertEmailBodyContains($excerpt, $message = null)
    {
        $this->assertContains(
            $excerpt, $this->getEmail($message)->getBody(),
            "Email body does not contain the required text: $excerpt"
        );

        return $this;
    }
}

class TestingMailEventListener implements Swift_Events_EventListener
{
    protected $test;

    public function __construct($test)
    {
        $this->test = $test;
    }

    public function beforeSendPerformed($event)
    {
        $message = $event->getMessage();

        $this->test->addEmail($event->getMessage());
    }
}
