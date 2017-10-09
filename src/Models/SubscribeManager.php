<?php

namespace Vis\SubscribeManager;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use \App;

class SubscribeManager
{
    public function subscribeToEntity(array $data, $change = false)
    {
        //todo add validation
        $entity = (array)$data['entity_id'];
        $email  = trim($data['email']);

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $subscriber = Subscriber::updateOrCreate(['email' => $email],['lang' => App::getLocale(),'is_active' => 1]);

        if ($change) {
            $subscriber->entities()->sync($entity);
        } else {
            $subscriber->entities()->syncWithoutDetaching($entity);
        }

        return true;
    }

    //todo unsubscribe
    public function getUnsubscribeUrl()
    {

    }

    public function getEncryptedEmail()
    {
        return Crypt::encryptString($this->email);
    }

    public function unSubscribe($email)
    {
/*        try {
            $email = Crypt::decryptString($email);

            $subscriber = Subscriber::where('email', $email)->first();

            if (!$subscriber) {
                return false;
            }

            $subscriber->setActive(0)->save();

        } catch (DecryptExceptionn $e) {
            return false;
        }

        return true;*/
    }

}
