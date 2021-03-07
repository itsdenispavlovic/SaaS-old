<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\Payment;
use App\Models\User;
use App\Notifications\ChargeSuccessNotification;
use App\Services\InvoicesService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use Spatie\WebhookClient\Models\WebhookCall;

class ChargeSucceededJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    // @todo: need to be tested on server
    public function handle()
    {
        $charge = $this->webhookCall->payload['data']['object'];

        Log::info($this->webhookCall->payload);

        $user = User::where('stripe_id', $charge['customer'])->first();

//        Log::info($charge);

        if($user)
        {
            $payment = Payment::create([
                'user_id' => $user->id,
                'stripe_id' => $charge['id'],
                'subtotal' => $charge['amount'],
                'tax' => $charge['tax'],
                'total' => $charge['amount']
            ]);

            // Generate invoice
            (new InvoicesService())->generateInvoice($payment);

            $user->notify(new ChargeSuccessNotification($payment));
        }
        else
        {
            Log::critical('User not found, Stripe Webhooks. ' . $charge['customer']);
        }
    }
}
