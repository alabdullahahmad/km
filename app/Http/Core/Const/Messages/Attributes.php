<?php
namespace App\Http\Core\Const\Messages;

enum Attributes : string{

   case User    = "user";
   case Admin   = 'admin';
   case Driver  = 'driver';
   case Discount = 'Discount';
   case Coache = 'coache';
   case Branch = 'branch';
   case Fund = 'fund';
   case Bill = 'bill';
   case Staf = 'staf';
   case Room = 'room';
   case Category= 'category';
   case Tag= 'tag';
   case Subscription = 'subscription';
   case SubscriptionCoach = 'subscriptionCoach';
   case FundLog = 'fund_log';
   case None    = "none" ;


}
