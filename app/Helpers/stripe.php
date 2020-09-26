<?php


namespace App\Helpers;
use App\User;
use Exception;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\SubscriptionItem;
use Stripe\Invoice;
use Stripe\Charge;
use Stripe\InvoiceItem;
use Stripe\Plan as pln;
use Stripe\Coupon;


class stripeHelper
{

    private $key;
    private $stripe;

    public function __construct()
    {
        $this->key = env("STRIPE_KEY","sk_test_zsMm2WUvxTSsB5F9mZ3FG20S00hb1XFUiF");

        $this->stripe = Stripe::setApiKey($this->key);
        // $this->stripe->setApiKey($this->key);
    }


    public function addCustomer($user)
    {

        $res = Customer::create([
            'name' => $user->name.' '.$user->last_name,
            'email' => $user->email,
            'description' => 'Customer for ctc',
            //'currency' => $user->currency,
        ]);


        $user->stripe_id = $res->id;
        $user->save();


        return $user;

    }

    public function addCard($user, $token)
    {

        try {
            $res = Customer::createSource(
                $user->stripe_id,
                [
                    'source' => $token
                ]
            );


            return $res;
        } catch(Exception $e)
        {
            return $e;
        }
    }


    public function addSubscription($user, $plans, $promo = null )
    {
        $res ='';
        $ins =null;
        $adv =null;
        try {

                if($promo != null){
                    $res =  Subscription::create([
                        'customer' => $user->stripe_id,
                        'metadata' => [
                            'name' => 'clinique chomedy',
                        ],
                        'items' => $plans,
                        'coupon' => $promo,
                        // 'collection_method' => 'send_invoice',
                        // 'days_until_due' => 30,
                        //  $ins != null ?? 'add_invoice_items' => [ $ins->id,]



                    ]);
                }else{
                    $res =  Subscription::create([
                        'customer' => $user->stripe_id,
                        'metadata' => [
                            'name' => 'clinique chomedy',
                        ],
                        'items' => $plans,
                        // 'collection_method' => 'send_invoice',
                        // 'days_until_due' => 30,
                        //  $ins != null ?? 'add_invoice_items' => [ $ins->id,]



                    ]);
                }






            return $res;
        } catch(Exception $e)
        {
            return $e;
        }

    }


    public function cancelSubscription($subscription)
    {
        /*
        Subscription::update(
            $subscription
          /*  [
                'cancel_at_period_end' => true,
            ]
        ); */
        try {
        $sub = Subscription::retrieve($subscription);
        $sub->cancel();

        return true;
        } catch(Exception $e)
        {
            return false;
        }
    }

    public function upgrade($subscription)
    {
      /*   $res = SubscriptionItem::all(
           [
              'subscription' => $subscription->stripe_id,
           ]
        ); */
        $res= '';
      try{
          $old_sub = Subscription::retrieve($subscription->stripe_id);
          $res = Subscription::update(
              $subscription->stripe_id,
              [
                  //'cancel_at_period_end' => false,
                  'proration_behavior' => 'always_invoice',
                  'items' => [
                      // waiting room
                      [
                          'id' => $old_sub->items->data[0]->id,
                          'quantity' => $subscription->waiting_room_limit
                      ],
                      // operation rom
                      [
                          'id' => $old_sub->items->data[1]->id,
                          'quantity' => $subscription->operation_room_limit
                      ],
                      // patients
                      [
                          'id' => $old_sub->items->data[2]->id,
                          'quantity' => $subscription->patients_limit
                      ],
                      // capsule
                      [
                          'id' => $old_sub->items->data[3]->id,
                          'quantity' => $subscription->video_capsule_limit
                      ]
                  ]
              ]
          );

          return $res;
      }catch(Exception $e)
      {
          return $e;
      }

    }

    public function updateSubscription($subscription, $plans, $promo){
        $res ='';
        try {
            if($promo != null){
                $res =  Subscription::update($subscription,[

                    'metadata' => [
                        'name' => 'clinique chomedy',
                    ],
                    'items' => $plans,
                    'coupon' => $promo,
                ]);
            }else
            {
                $res =  Subscription::update($subscription,[

                    'metadata' => [
                        'name' => 'clinique chomedy',
                    ],
                    'items' => $plans,
                    'coupon' => $promo,
                ]);
            }




            return $res;
        } catch(Exception $e)
        {
            return $e;
        }
    }


    public function cardsList($user)
    {
        try {
            $res =  Customer::allSources(
                $user->stripe_id

            );


            return $res;
        } catch(Exception $e)
        {
            return $e;
        }

    }

    public function promoStatus($promo)
    {
        try{
            $res = Coupon::retrieve($promo);

            return $res;

        }catch (Exception $e){
           return $e;
        }
    }

    public function getAllInvoices($user)
    {

        try{
            $res = Invoice::all([
                "customer" => $user->stripe_id,
            ]);

            return $res;

        }catch (Exception $e){
            return $e;
        }
    }


    public function addPlan($item)
    {
        $usd = "";
        $cad = "";
        $res = pln::create([
            'billing_scheme' => 'tiered',
            'usage_type' => 'licensed',
            'tiers_mode' => 'volume',
            'currency' => 'cad',
            'interval' => 'month',
            'product' => ['name' => $item->name],
            'tiers' =>[
                [
                    'unit_amount' => $item->unit_cad * 100,
                    'up_to' => $item->condition - 1 ,
                ],
                [
                    'unit_amount' => ($item->unit_cad - (($item->unit_cad * $item->reduction ) / 100)) * 100,
                    'up_to' => 'inf' ,
                ],


            ],
        ]);

        $cad = $res->id;

        //usd
        $res = pln::create([
            'billing_scheme' => 'tiered',
            'usage_type' => 'licensed',
            'tiers_mode' => 'volume',
            'currency' => 'usd',
            'interval' => 'month',
            'product' => ['name' => $item->name],
            'tiers' =>[
                [
                    'unit_amount' => $item->unit_usd * 100,
                    'up_to' => $item->condition - 1 ,
                ],
                [
                    'unit_amount' => ($item->unit_usd - (($item->unit_usd * $item->reduction ) / 100)) * 100,
                    'up_to' => 'inf' ,
                ],


            ],
        ]);
        $usd = $res->id;

        return [
            'cad' => $cad,
            'usd' => $usd
        ];
    }

    public function charge($user, $request, $token)
    {


        try

            {Customer::update($user->stripe_id, [
                'source' => $token,
            ]);
            $res = Charge::create([
                'customer' => $user->stripe_id,
                'amount' => $request->price * 100,
                'currency' => 'eur',
                'description' => 'paiement de envoi courrier ()',
            ]);

            return $res;

        }catch (Exception $e){
            return $e;
        }
    }

    public function getSubscription($id)
    {
        try

        {

            $res = Subscription::retrieve(
                $id
            );

            return $res;

        }catch (Exception $e){
            return $e;
        }
    }
}
