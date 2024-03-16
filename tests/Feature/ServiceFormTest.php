<?php

use App\Livewire\ServiceForm;
use App\Models\Lead;
use App\Notifications\LeadReceived;

it('can be visited', function () {
    $this->get(route('services'))
        ->assertSuccessful();
});

it('sets up correctly', function () {
    Livewire::test(ServiceForm::class)
        ->assertSet('name', '')
        ->assertPropertyWired('name')
        ->assertSet('email', '')
        ->assertPropertyWired('email')
        ->assertSet('subject', '')
        ->assertPropertyWired('subject')
        ->assertSet('message', '')
        ->assertPropertyWired('message')
        ->assertSet('hp', '')
        ->assertPropertyWired('hp')
        ->assertSet('ts', now())
        ->assertMethodWiredToForm('submit');
});

it('can submit a lead', function () {
    Notification::fake();
    expect(Lead::count())->toBe(0);

    Livewire::test(ServiceForm::class)
        ->set('name', 'Nathan Hipps')
        ->set('email', 'nathan@gmail.com')
        ->set('subject', 'GPU-400')
        ->set('message', 'This is a lead')
        ->set('ts', now()->subSeconds(5))
        ->call('submit')
        ->assertDispatched('notify', title: 'Success', message: 'Your service request has been submitted')
        ->assertHasNoErrors()
        ->assertSet('name', '')
        ->assertSet('email', '')
        ->assertSet('subject', '')
        ->assertSet('message', '');

    expect(Lead::count())->toBe(1)
        ->and(Lead::first())
        ->name->toBe('Nathan Hipps')
        ->email->toBe('nathan@gmail.com')
        ->subject->toBe('GPU-400')
        ->message->toBe('This is a lead');

    Notification::assertSentTimes(LeadReceived::class, 1);
});

it('a name is required', function () {
    Notification::fake();
    expect(Lead::count())->toBe(0);

    Livewire::test(ServiceForm::class)
        ->set('name', '')
        ->set('email', 'nathan@gmail.com')
        ->set('subject', 'GPU-400')
        ->set('message', 'This is a lead')
        ->set('ts', now()->subSeconds(5))
        ->call('submit')
        ->assertNotDispatched('notify', title: 'Success', message: 'Your service request has been submitted')
        ->assertHasErrors(['name' => ['required']]);

    expect(Lead::count())->toBe(0);

    Notification::assertSentTimes(LeadReceived::class, 0);
});

it('a email is required', function () {
    Notification::fake();
    expect(Lead::count())->toBe(0);

    Livewire::test(ServiceForm::class)
        ->set('name', 'Nathan Hipps')
        ->set('email', '')
        ->set('subject', 'GPU-400')
        ->set('message', 'This is a lead')
        ->set('ts', now()->subSeconds(5))
        ->call('submit')
        ->assertNotDispatched('notify', title: 'Success', message: 'Your service request has been submitted')
        ->assertHasErrors(['email' => ['required']]);

    expect(Lead::count())->toBe(0);

    Notification::assertSentTimes(LeadReceived::class, 0);
});

it('a email must be valid', function () {
    Notification::fake();
    expect(Lead::count())->toBe(0);

    Livewire::test(ServiceForm::class)
        ->set('name', 'Nathan Hipps')
        ->set('email', 'nathanhipps')
        ->set('subject', 'GPU-400')
        ->set('message', 'This is a lead')
        ->set('ts', now()->subSeconds(5))
        ->call('submit')
        ->assertNotDispatched('notify', title: 'Success', message: 'Your service request has been submitted')
        ->assertHasErrors(['email' => ['email']]);

    expect(Lead::count())->toBe(0);

    Notification::assertSentTimes(LeadReceived::class, 0);
});

it('a subject is required', function () {
    Notification::fake();
    expect(Lead::count())->toBe(0);

    Livewire::test(ServiceForm::class)
        ->set('name', 'Nathan Hipps')
        ->set('email', 'nathan@gmail.com')
        ->set('subject', '')
        ->set('message', 'This is a lead')
        ->set('ts', now()->subSeconds(5))
        ->call('submit')
        ->assertNotDispatched('notify', title: 'Success', message: 'Your service request has been submitted')
        ->assertHasErrors(['subject' => ['required']]);

    expect(Lead::count())->toBe(0);

    Notification::assertSentTimes(LeadReceived::class, 0);
});

it('a message is required', function () {
    Notification::fake();
    expect(Lead::count())->toBe(0);

    Livewire::test(ServiceForm::class)
        ->set('name', 'Nathan Hipps')
        ->set('email', 'nathan@gmail.com')
        ->set('subject', 'Something')
        ->set('message', '')
        ->set('ts', now()->subSeconds(5))
        ->call('submit')
        ->assertNotDispatched('notify', title: 'Success', message: 'Your service request has been submitted')
        ->assertHasErrors(['message' => ['required']]);

    expect(Lead::count())->toBe(0);

    Notification::assertSentTimes(LeadReceived::class, 0);
});

it('checks the honey pot', function () {
    Notification::fake();
    expect(Lead::count())->toBe(0);

    Livewire::test(ServiceForm::class)
        ->set('hp', 'Whoops')
        ->set('name', 'Nathan Hipps')
        ->set('email', 'nathan@gmail.com')
        ->set('subject', 'Something')
        ->set('message', 'Here is a message')
        ->set('ts', now()->subSeconds(5))
        ->call('submit')
        ->assertNotDispatched('notify', title: 'Success', message: 'Your service request has been submitted')
        ->assertHasNoErrors();

    expect(Lead::count())->toBe(0);

    Notification::assertSentTimes(LeadReceived::class, 0);
});

it('must take longer than 3 seconds', function () {
    Notification::fake();
    expect(Lead::count())->toBe(0);

    Livewire::test(ServiceForm::class)
        ->set('hp', 'Whoops')
        ->set('name', 'Nathan Hipps')
        ->set('email', 'nathan@gmail.com')
        ->set('subject', 'Something')
        ->set('message', 'Here is a message')
        ->set('ts', now()->subSeconds(1))
        ->call('submit')
        ->assertNotDispatched('notify', title: 'Success', message: 'Your service request has been submitted')
        ->assertHasNoErrors();

    expect(Lead::count())->toBe(0);

    Notification::assertSentTimes(LeadReceived::class, 0);
});
