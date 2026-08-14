<?php

namespace Tests\Feature;

use App\Events\HelloWorld;
use App\Listeners\LogHelloWorld;
use Illuminate\Events\CallQueuedListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class HelloWorldQueueTest extends TestCase
{
    public function test_button_dispatches_hello_world_event(): void
    {
        Event::fake([HelloWorld::class]);

        $this->from('/')
            ->post(route('hello.store'))
            ->assertRedirect('/');

        Event::assertDispatched(HelloWorld::class);
    }

    public function test_hello_world_listener_is_queued(): void
    {
        Queue::fake();

        HelloWorld::dispatch();

        Queue::assertPushed(CallQueuedListener::class, function (CallQueuedListener $job): bool {
            return $job->class === LogHelloWorld::class;
        });
    }
}
